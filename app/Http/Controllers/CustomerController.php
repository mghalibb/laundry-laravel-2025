<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::all();
        return view('customers.index', compact('customers'));
    }

    public function create()
    {
        return view('customers.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'tlp' => 'required|numeric',
            'jk' => 'required|in:L,P',
        ]);

        Customer::create([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'tlp' => $request->tlp,
            'jk' => $request->jk,
        ]);

        Alert::success('Success', 'Data Pelanggan berhasil ditambahkan!');
        return redirect()->route('customers.index');
    }

    public function edit($id)
    {
        $customer = Customer::findOrFail($id);
        return view('customers.edit', compact('customer'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'tlp' => 'required|numeric',
            'jk' => 'required|in:L,P',
        ]);

        $customer = Customer::findOrFail($id);

        $customer->update([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'tlp' => $request->tlp,
            'jk' => $request->jk,
        ]);

        Alert::success('Success', 'Data Pelanggan berhasil diupdate!');
        return redirect()->route('customers.index');
    }

    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();

        Alert::success('Deleted', 'Data Pelanggan berhasil dihapus!');
        return redirect()->route('customers.index');
    }
}
