<?php

namespace App\Http\Controllers;

use App\Models\Level;
use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\RedirectResponse;

class LevelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $levels = Level::orderBy('id', 'ASC')->get();
        $users = User::with('level')->orderBy('level_id', 'ASC')->get();
        return view('levels.index', compact('levels', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('levels.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:levels,name|max:255',
        ]);

        Level::create([
            'name' => $request->name,
        ]);

        Alert::success('Success', 'Level Successfully Added!');
        return redirect()->route('levels.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Level $level)
    {
        return view('levels.edit', compact('level'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Level $level): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:levels,name,' . $level->id,
        ]);

        $level->update([
            'name' => $request->name,
        ]);

        Alert::success('Success', 'Level Successfully Updated!');
        return redirect()->route('levels.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Level $level): RedirectResponse
    {
        if ($level->users()->count() > 0) {
            Alert::error('Failed', 'This level is still assigned to users and cannot be deleted.');
            return redirect()->back();
        }

        $level->delete();

        Alert::success('Success', 'Level Successfully Deleted!');
        return redirect()->route('levels.index');
    }
}
