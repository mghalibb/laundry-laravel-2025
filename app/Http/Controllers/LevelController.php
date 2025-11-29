<?php

namespace App\Http\Controllers;

use App\Models\Level;
use App\Models\Menu;
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
        $users = User::with('level')->orderBy('id_level', 'ASC')->get();
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
            'nama_level' => 'required|string|max:255|unique:levels,nama_level',
            'description' => 'nullable|string|max:255',
            'status' => 'required|in:Active,Inactive',
        ]);

        Level::create([
            'nama_level' => $request->nama_level,
            'description' => $request->description,
            'status' => $request->status,
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
            'nama_level' => 'required|string|max:255|unique:levels,nama_level,' . $level->id,
            'description' => 'nullable|string|max:255',
            'status' => 'required|in:Active,Inactive',
        ]);

        $oldName = $level->nama_level;
        $newName = $request->nama_level;

        $level->update([
            'nama_level' => $newName,
            'description' => $request->description,
            'status' => $request->status,
        ]);

        if ($oldName !== $newName) {
            $menus = Menu::where('roles', 'like', "%$oldName%")->get();
            foreach($menus as $menu) {
                $updatedRoles = str_replace($oldName, $newName, $menu->roles);
                $menu->update(['roles' => $updatedRoles]);
            }
        }

        Alert::success('Success', 'Level Successfully Updated!');
        return redirect()->route('levels.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Level $level): RedirectResponse
    {
        if (in_array($level->id, [1, 2, 3, 4])) { 
            return redirect()->back()->with('error', 'Level inti sistem tidak boleh dihapus!');
        }

        $level->delete();

        Alert::success('Success', 'Level Successfully Deleted!');
        return redirect()->route('levels.index');
    }

    public function assignLevel(Request $request, User $user)
    {
        $request->validate([
            'id_level' => 'required|exists:levels,id',
        ]);

        $user->id_level = $request->id_level;
        $user->save();

        Alert::success('Success', 'Level Assigned Successfully To ' . $user->name);
        return redirect()->route('levels.index');
    }
}
