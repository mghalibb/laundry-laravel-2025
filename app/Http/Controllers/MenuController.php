<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Level;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menus = Menu::orderBy('order', 'ASC')->get();
        $levels = Level::all();

        $categories = Menu::select('category')->distinct()->pluck('category');

        return view('menus.index', compact('menus', 'levels', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'url' => 'required',
            'category' => 'required',
            'roles' => 'required|array',
            'order' => 'required|numeric',
        ]);

        $data = $request->all();

        if($request->has('roles')) {
            $roleNames = Level::whereIn('id', $request->roles)->pluck('nama_level')->toArray();
            $data['roles'] = implode(',', $roleNames);
        }

        $menu = Menu::create($data);
        if($request->has('roles')) {
            $menu->levels()->attach($request->roles);
        }

        Alert::success('Success', 'Menu berhasil ditambahkan!');
        return redirect()->route('menus.index');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required',
            'url' => 'required',
            'category' => 'required',
            'roles' => 'required|array',
            'order' => 'required|numeric',
        ]);

        $menu = Menu::findOrFail($id);
        $data = $request->except(['_token', '_method']);

        if (isset($request->roles)) {
            $roleNames = Level::whereIn('id', $request->roles)->pluck('nama_level')->toArray();
            $data['roles'] = implode(',', $roleNames);
        } else {
            $data['roles'] = '';
        }

        $menu->update($data);
        $menu->levels()->sync($request->roles ?? []);

        Alert::success('Success', 'Menu berhasil diperbarui!');
        return redirect()->route('menus.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $menu = Menu::findOrFail($id);
        $menu->delete();

        Alert::success('Success', 'Menu berhasil dihapus!');
        return redirect()->route('menus.index');
    }
}
