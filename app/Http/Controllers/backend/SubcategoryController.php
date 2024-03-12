<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\subcategory;
use App\Models\categories;
use App\Models\subcategories;
class subcategoryController extends Controller
{
    public function index()
    {
        
        $categories = categories::all();
        return view('Admin.sabcategoris.add', compact('categories'));
       
       
    }

    public function create()
    {
        $categories = categories::all();
        return view('Admin.sabcategoris.add', compact('categories'));
     

    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'subcategory' => 'required',
        ]);

        subcategories::create([
            'category_id' => $request->category_id,
            'subcategory' => $request->subcategory,
        ]);

        return redirect()->route('user.subcategories.index')->with('success', 'Subcategory created successfully!');
    }

    public function show(subcategories $subcategory)
    {
        return view('Admin.subcategories.show',compact('subcategory'));
    }

    public function edit(subcategories $subcategory)
    {
        return view('Admin.subcategories.edit',compact('subcategory'));
    }

    public function update(Request $request, subcategories $subcategory)
    {
        $request->validate([
            'category_id' => 'required',
            'subcategory' => 'required|string',
        ]);

        $subcategory->update($request->all());

        return redirect()->route('user.subcategories.index')
                         ->with('success','Subcategory updated successfully');
    }

    public function destroy(subcategories $subcategory)
    {
        $subcategory->delete();

        return redirect()->route('user.subcategories.index')
                         ->with('success','Subcategory deleted successfully');
    }
}
