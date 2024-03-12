<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\State;

class StateController extends Controller
{
    public function index()
    {
        $states = State::all();
        return view('Admin.state.list', compact('states'));
       

    }

    public function create()
    {
        return view('Admin.state.add');

    }

    public function store(Request $request)
    {


        $request->validate([
            'state' => 'required',
            'stateDescription' => 'required',
            'postingDate' => 'required|date',
            'updationDate' => 'required|date',
        ]);

        State::create($request->all());
        return redirect()->route('user.states.index')
            ->with('success', 'State created successfully.');
    }

    public function edit(State $state)
    {
        return view('Admin.states.edit', compact('state'));
    }

    public function update(Request $request, State $state)
    {
        $request->validate([
            'state' => 'required',
            'stateDescription' => 'required',
            'postingDate' => 'required|date',
            'updationDate' => 'required|date',
        ]);

        $state->update($request->all());

        return redirect()->route('user.states.index')
            ->with('success', 'State updated successfully');
    }

    public function destroy(State $state)
    {
        $state->delete();

        return redirect()->route('user.states.index')
            ->with('success', 'State deleted successfully');
    }

}
