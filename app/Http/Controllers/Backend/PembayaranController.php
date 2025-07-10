<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use App\Models\User;
use App\Models\KasMingguan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pembayaran = Pembayaran::all();
        $users      = User::all();
        $title      = 'Hapus Data Bayar!';
        $text       = "Apakah Anda Yakin??";
        confirmDelete($title, $text);

        return view('backend.pembayaran.index', compact('pembayaran', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        return view('backend.pembayaran.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'jumlah'  => 'required|numeric',
            'tanggal' => 'required|date',
        ]);

        $pembayaran          = new Pembayaran();
        $pembayaran->user_id = $request->user_id;
        $pembayaran->jumlah  = $request->jumlah;
        $pembayaran->tanggal = $request->tanggal;
        $pembayaran->save();

        $tanggal  = Carbon::parse($request->tanggal);
        $mingguKe = ceil($tanggal->day / 7);
        $bulan    = $tanggal->month;
        
        // Cek apakah kas mingguan untuk user, minggu, bulan sudah ada
        $kasMingguan = KasMingguan::where('user_id', $request->user_id)
            ->where('minggu_ke', $mingguKe)
            ->where('bulan', $bulan)
            ->first();
        
        if ($kasMingguan) {
            // Update jumlah
            $kasMingguan->jumlah += $request->jumlah;
        
            // Update status jika total sudah 10.000 atau lebih
            $kasMingguan->status = $kasMingguan->jumlah >= 10000 ? 'lunas' : 'belum';
        
            // Update tanggal bayar terakhir
            $kasMingguan->tanggal_bayar = $tanggal;
        
            $kasMingguan->save();
        } else {
            // Belum ada, buat baru
            $status = $request->jumlah >= 10000 ? 'lunas' : 'belum';
        
            KasMingguan::create([
                'user_id'       => $request->user_id,
                'status'        => $status,
                'minggu_ke'     => $mingguKe,
                'bulan'         => $bulan,
                'jumlah'        => $request->jumlah,
                'tanggal_bayar' => $tanggal,
            ]);
        }

        toast('Data berhasil ditambah', 'success');
        return redirect()->route('backend.pembayaran.index');

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
        $pembayaran = Pembayaran::findOrFail($id);
        $users      = User::all();
        return view('backend.pembayaran.edit', compact('pembayaran', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'user_id' => 'required',
            'jumlah'  => 'required|numeric',
            'tanggal' => 'required|date',
        ]);

        $pembayaran          = Pembayaran::findOrFail($id);
        $pembayaran->user_id = $request->user_id;
        $pembayaran->jumlah  = $request->jumlah;
        $pembayaran->tanggal = $request->tanggal;
        $pembayaran->save();
        toast('Data berhasil diedit', 'success');
        return redirect()->route('backend.pembayaran.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        $pembayaran->delete();
        toast('Data berhasil dihapus', 'success');
        return redirect()->route('backend.pembayaran.index');

    }
}
