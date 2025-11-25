<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Level;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with('level')->orderBy('id_level', 'ASC')->get();
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $levels = Level::all();
        return view('users.add', [
            'levels' => $levels
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|unique:users,username',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'id_level' => 'required|exists:levels,id',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $photoPath = null;
        if ($request->hasFile('photo')) {
            // Simpan file di 'storage/app/public/photos'
            $photoPath = $request->file('photo')->store('photos', 'public');
        }

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'id_level' => $request->id_level,
            'photo' => $photoPath
        ]);

        Alert::success('Success', 'User Successfully Added!');
        return redirect()->route('users.index');
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
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        $levels = Level::all();
        return view('users.edit', compact('user', 'levels'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|unique:users,username,'.$id,
            'email' => 'required|string|email|max:255|'.Rule::unique('users')->ignore($user->id),
            'id_level' => 'required|exists:levels,id',
            'password' => 'nullable|string|min:8',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->id_level = $request->id_level;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        if ($request->hasFile('photo')) {
            if ($user->photo) {
                Storage::disk('public')->delete($user->photo);
            }
            $user->photo = $request->file('photo')->store('photos', 'public');
        }

        $user->save();

        Alert::success('Success', 'User Data Successfully Updated!');
        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        if (Auth::id() == $user->id) {
            Alert::error('Failed', 'You cannot delete yourself!');
            return redirect()->back();
        }
        $user->delete();

        Alert::success('Deleted', 'User Successfully Deleted!');
        return redirect()->route('users.index');
    }

    /**
     * Display the Recycle Bin Page.
     */
    public function trash()
    {
        $users = User::onlyTrashed()->with('level')->orderBy('deleted_at', 'DESC')->get();
        return view('users.trash', compact('users'));
    }

    /**
     * Restore user from Recycle Bin.
     */
    public function restore(string $id)
    {
        $user = User::onlyTrashed()->findOrFail($id);
        $user->restore();

        Alert::success('Success', 'User Successfully Restored!');
        return redirect()->route('users.trash');
    }

    /**
     * Delete user permanently.
     */
    public function forceDelete(string $id)
    {
        $user = User::onlyTrashed()->findOrFail($id);
        if ($user->photo) {
            Storage::disk('public')->delete($user->photo);
        }
        $user->forceDelete();

        Alert::success('Success', 'User Successfully Deleted Permanently!');
        return redirect()->route('users.trash');
    }
}
