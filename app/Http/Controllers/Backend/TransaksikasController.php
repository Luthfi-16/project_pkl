<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Transaksikas;
use App\Models\User;
use Illuminate\Http\Request;

class TransaksikasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transaksi = Transaksikas::all();
        $users     = User::where('isAdmin', '!=', 1)->get();
        return view('backend.transaksi.index', compact('transaksi', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        return view('backend.transaksi.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'user_id'     => 'required',
            'jenis'    => 'required|in:pemasukkan,pengeluaran',
            'jumlah' => 'required|numeric',
            'keterangan' => 'nullable',
            'tanggal' => 'required|date',
        ]);

        $transaksi = new Transaksikas();
        $transaksi->user_id = $request->user_id;
        $transaksi->jenis = $request->jenis;
        $transaksi->jumlah = $request->jumlah;
        $transaksi->keterangan = $request->keterangan;
        $transaksi->tanggal = $request->tanggal;

        toast('Data berhasil diedit', 'success');
return redirect()->route('backend.siswa.index');


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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
