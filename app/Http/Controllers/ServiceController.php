<?php

namespace App\Http\Controllers;

use App\Models\TypeOfService;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ServiceController extends Controller
{
    public function index()
    {
        $services = TypeOfService::all();
        return view('services.index', compact('services'));
    }

    public function create()
    {
        return view('services.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'service_name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'required|string',
        ]);

        TypeOfService::create($request->all());

        Alert::success('Success', 'Layanan berhasil ditambahkan!');
        return redirect()->route('services.index');
    }

    public function edit($id)
    {
        $service = TypeOfService::findOrFail($id);
        return view('services.edit', compact('service'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'service_name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'required|string',
        ]);

        $service = TypeOfService::findOrFail($id);
        $service->update($request->all());

        Alert::success('Success', 'Layanan berhasil diupdate!');
        return redirect()->route('services.index');
    }

    public function destroy($id)
    {
        $service = TypeOfService::findOrFail($id);
        $service->delete();

        Alert::success('Deleted', 'Layanan berhasil dihapus!');
        return redirect()->route('services.index');
    }
}
