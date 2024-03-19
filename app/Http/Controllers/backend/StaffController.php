<?php

namespace App\Http\Controllers\Backend;


use App\Models\User;
use App\Models\State;
use App\Models\Country;
use App\Models\Setting;
use App\Models\Staff;
use App\Exports\ExportUser;
use App\Imports\StaffUser;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

use App\Models\Role;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index(Request $request)
    {
        $limit =  config('constants.pagination_page_limit');
        $filter = $request->query();
        $thismodel = Staff::sortable(['user.created_at' => 'desc']);
        if (!joined($thismodel, 'users')) {
            $thismodel->leftJoin('users', function ($join) {
                $join->on('staffs.staff_uni_id', '=', 'users.user_uni_id');
            });
        }

        if (!joined($thismodel, 'roles')) {
            $thismodel->leftJoin('roles', function ($join) {
                $join->on('users.role_id', '=', 'roles.id');
            });
        }

        $thismodel->select([
            'staffs.*', 'users.created_at', 'users.phone', 'users.name', 'users.email', 'users.user_fcm_token', 'users.user_ios_token', 'users.status', 'roles.name as role_name'
        ]);


        $keyword = '';
        if (isset($filter['status']) && $filter['status'] != "") {
            $thismodel->where('status', $filter['status']);
        }
        if (!empty($filter['search'])) {
            $keyword    =   $filter['search'];
            $thismodel->where(function ($query) use ($keyword) {
                $query->where('users.user_uni_id', 'LIKE', '%' . $keyword . '%')->orwhere('users.name', 'LIKE', '%' . $keyword . '%')->orwhere('users.email', 'LIKE', '%' . $keyword . '%')->orwhere('users.phone', 'LIKE', '%' . $keyword . '%');
            });
        }

        if (!empty($filter['start_date']) ) {
            $start_date_format = mysqlDateFormat($filter['start_date']);
            $thismodel->whereDate('users.created_at', '>=', $start_date_format);
        }
        if (!empty($filter['end_date'])) {
            $end_date_format = mysqlDateFormat($filter['end_date']);
            $thismodel->whereDate('users.created_at', '<=', $end_date_format);
        }
        // dd(getQueryWithBindings($thismodel));

        $thismodel->where('users.trash', 0);
        $thismodel->where('roles.role_type', '=', config('constants.staff_role_type'));
        $thismodel->groupBy('users.user_uni_id');

        if (isset($filter['excel_export']) || isset($filter['pdf_export'])) {

            $headings = [
                "Staff Id", "Role id", "Name", "Email", "Phone",
                "Gender",  "country", "state",
                "city", "birth_date", "staff_img", "birth_place",
                "birth_time", "longitude", "latitude",
                "status", "created_at", "updated_at",
            ];
            $thismodel->select([
                'staffs.staff_uni_id', 'users.role_id', 'users.name', 'users.email', 'users.phone',
                'staffs.gender',  'staffs.country', 'staffs.state',
                'staffs.city', 'staffs.birth_date', 'staffs.staff_img', 'staffs.birth_place', 'staffs.birth_time', 'staffs.longitude', 'staffs.latitude',
                'users.status', 'users.created_at', 'users.updated_at',
            ]);

            $records = $thismodel->get();

            if (isset($filter['excel_export'])) {
                return Excel::download(new ExportUser($records, $headings), 'Staffs.xlsx');
            } else if (isset($filter['pdf_export'])) {
                $tabel_keys = [];
                if ($records->count() > 0) {
                    $tabel_keys = array_keys($records[0]->toArray());
                }

                $variabls = [
                    'top_heading' => 'Staff List',
                    'headings' => $headings,
                    'tabel_keys' => $tabel_keys,
                    'records' => $records,
                ];

                $file = 'Staffs.pdf';
                $pdf =  PDF::loadview('pdf', $variabls);
                if (count($headings) > 6) {
                    $pdf->setPaper('a4', 'landscape');
                }

                return $pdf->download($file);
            }
        }
        $staffs = $thismodel->paginate($limit);
        return view('backend.staff.index', compact('staffs', 'filter'))->with('i', (request()->input('page', 1) - 1) * $limit);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $country = Country::all();
        $state = State::where('country_id', config('constants.default_country'))->get();
        $role_list = Role::where('status', 1)->where('role_type', 'Staff')->get();
        return view('backend.staff.create', compact('country', 'state', 'role_list'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attributes = request()->validate([
            'role_id' => ['nullable'],
            'user_id' => ['nullable'],
            'name' => ['required', 'max:50'],
            'email' => ['required', 'email', 'max:50',
            Rule::unique('users')->where(function ($query){
                $query->join('roles', function ($join) {
                    return $join->on('roles.id', '=', 'users.role_id')->where('role_type', config('constants.staff_role_type'));
                });
            })->where('trash', 0)],
            'phone' => ['required', 'numeric',
            Rule::unique('users')->where(function ($query){
                    $query->join('roles', function ($join) {
                        return $join->on('roles.id', '=', 'users.role_id')->where('role_type', config('constants.staff_role_type'));
                    });
                })->where('trash', 0)],
            'birth_place' => ['required'],
            'city' => ['nullable'],
            'state' => ['nullable'],
            'country' => ['nullable'],
            'latitude' => ['nullable'],
            'longitude' => ['nullable'],
            'birth_time' => ['required'],
            'birth_date' => ['required'],
            'gender' => ['required'],
            'staff_img' => ['required'],
            'role_id' => ['required'],
            'password' => ['required'],
        ]);

        $staff_info['country'] = $attributes['country'];
        $staff_info['state'] = $attributes['state'];
        $staff_info['city'] = $attributes['city'];
        $staff_info['latitude'] = $attributes['latitude'];
        $staff_info['longitude'] = $attributes['longitude'];
        $staff_info['birth_date'] = $attributes['birth_date'];
        $staff_info['birth_place'] = $attributes['birth_place'];
        $staff_info['birth_time'] = $attributes['birth_time'];
        $staff_info['gender'] = $attributes['gender'];

        if (!empty($attributes['staff_img'])) {
            $imgKey     =   'staff_img';
            $imgPath    =   public_path(config('constants.staff_image_path'));
            $filename = UploadImage($request, $imgPath, $imgKey);
            if(!empty($filename)){
                $attributes['staff_img'] = $filename;
            }
        }

        $staff_info['staff_img'] = $attributes['staff_img'];

        // $attributes['role_id'] = config('constants.staff_role_id');

        $user_uni_id  = new_sequence_code('STF');
        $attributes['user_uni_id']  = $user_uni_id;
        $attributes['admin_id']  = Auth::user()->user_uni_id;
        $attributes['status']  = 1;

        if (!empty($attributes['password'])) {
            $attributes['pstr'] = $attributes['password'];
            $attributes['password'] = bcrypt($attributes['password']);
        } else {
            unset($attributes['password']);
        }

        $user =  User::create($attributes);

        $user_id = $user->id;
        $user_uni_id = $user->user_uni_id;

        $staff_info['staff_uni_id'] = $user_uni_id;
        $staff_info['user_id'] = $user_id;
        $user =  Staff::create($staff_info);

        // if(!empty($user_uni_id)){
        //     staffWelcomeBonus($user_uni_id);
        // }

        return redirect()->route('admin.staff_management.staff.index')
        ->with('success', 'Staff Created Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Staff $staff)
    {
        $staffdata = Staff::leftJoin('users', function($join) {
            $join->on('staffs.staff_uni_id', '=', 'users.user_uni_id');
        })->leftJoin('roles', function ($join) {
            $join->on('users.role_id', '=', 'roles.id');
        })->where('staff_uni_id', $staff->staff_uni_id)
        ->select([
            'staffs.*','staffs.staff_uni_id', 'users.name', 'users.email', 'users.phone', 'roles.name as role_name'
        ])->first();

        // dd($staffdata->name);
        return view('backend.staff.view', compact('staffdata'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Staff $staff)
    {
        // dd($staff);
        // dd('sdfd');
        //
        // $staff = Staff::with('user')->find($id);
        //    dd($staff);
        $country_list = Country::get();
        $state_list = State::where('status', 1)->where('country_id', $staff->country_id)->get();
        $city_list = City::where('status', 1)->where('state_id', $staff->state_id)->get();
        $role_list = Role::where('status', 1)->where('role_type', 'Staff')->get();
        return view('backend.staff.edit', compact('staff', 'role_list', 'country_list', 'state_list', 'city_list'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Staff $staff)
    {
        //+912222222221
        $attributes = request()->validate([

            'birth_time' => ['required'],
            'birth_place' => ['required'],
            'city' => ['nullable'],
            'state' => ['nullable'],
            'country' => ['nullable'],
            'latitude' => ['nullable'],
            'longitude' => ['nullable'],
            
            'email' => ['required', 'email', 'max:50',
            Rule::unique('users')->where(function ($query){
                $query->join('roles', function ($join) {
                    return $join->on('roles.id', '=', 'users.role_id')->where('role_type', config('constants.staff_role_type'));
                });
            })->where('trash', 0)->ignore($staff->user->id)],
            'phone' => ['required', 'numeric',
            Rule::unique('users')->where(function ($query){
                    $query->join('roles', function ($join) {
                        return $join->on('roles.id', '=', 'users.role_id')->where('role_type', config('constants.staff_role_type'));
                    });
                })->where('trash', 0)->ignore($staff->user->id)],

            'name' => ['required'],
            'birth_date' => ['required'],
            'gender' => ['required'],
            'staff_img' => ['nullable'],
            'password' => ['nullable'],
        ]);

        $stf['name']    =   $attributes['name'];
        $stf['email']    =   $attributes['email'];
        $stf['phone']    =   $attributes['phone'];

        unset($attributes['name'], $attributes['email'], $attributes['phone']);

        if (!empty($attributes['staff_img'])) {
            $img        =   'staff_img';
            $imgPath    =   public_path(config('constants.staff_image_path'));
            $img_path   =   $imgPath . $staff->staff_img;
            if (!empty($staff->staff_img) && file_exists($img_path)) {
                @unlink($img_path);
            };
            $filename   =   UploadImage($request, $imgPath, $img);
            $attributes['staff_img'] = $filename;
        }

        if (!empty($attributes['password'])) {
            $stf['pstr'] = $attributes['password'];
            $attributes['password'] = bcrypt($attributes['password']);
            $stf['password'] = $attributes['password'];
        }
        
        unset($attributes['password']);

        $staff->update($attributes);
        User::where('user_uni_id', $staff->staff_uni_id)->update($stf);
        //   Staff::where('id',$id)->update($attributes);
        return redirect()->route('admin.staff_management.staff.index')
            ->with('success', 'Staff Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user, $id)
    {
        Staff::where('id', $id)->delete();


        return redirect()->route('admin.staff_management.staff.index')
            ->with('success', 'Staff Deleted Successfully');
    }

    public function changeStatus(Request $request)
    {
        $user = User::where('user_uni_id', $request->id)->update(['status' => $request->status]);
        // $page = Staff::find($request->id)->update(['status' => $request->status]);
        return response()->json(['success' => 'Status Changed Successfully.']);
    }
    public function getState(Request $request)
    {
        $data['states'] = State::where("country_id", $request->country_id)->get(["state_name", "id"]);
        return response()->json($data);
    }
    public function getCity(Request $request)
    {
        $data['cities'] = getCitylist($request->state_id);
        return response()->json($data);
    }
    public function importView(Request $request)
    {
        return view('backend.staff.import');
    }
    public function import(Request $request)
    {
        $return =  Excel::import(new StaffUser, $request->file('file')->store('files'));
        // dd($return);
        return redirect()->route('admin.staff_management.staff.index')->with('success', 'Staff Import Successfully');
    }

    public function trash(Request $request)
    {
        $arry   =   array('trash' => 1, 'status' => 0);
        User::where('user_uni_id', $request->uni_id)->update($arry);
        return redirect()->route('admin.staff_management.staff.index')
            ->with('success', 'Staff deleted successfully');
    }
}
