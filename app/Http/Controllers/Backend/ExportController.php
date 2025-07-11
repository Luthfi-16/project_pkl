<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\KasMingguan;
use App\Models\Transaksikas;
use Illuminate\Http\Request;

class ExportController extends Controller
{
    public function index(Request $request)
    {
        $jenis = $request->jenis;
        $awal  = $request->awal;
        $akhir = $request->akhir;

        $kas       = collect();
        $transaksi = collect();

        if ($jenis === 'kas') {
            $kasQuery = KasMingguan::with('users');
            if ($awal && $akhir) {
                $kasQuery->whereBetween('tanggal_bayar', [$awal, $akhir]);
            }
            $kas = $kasQuery->get();

        } elseif (in_array($jenis, ['pemasukkan', 'pengeluaran'])) {
            $trxQuery = Transaksikas::where('jenis', $jenis);
            if ($awal && $akhir) {
                $trxQuery->whereBetween('tanggal', [$awal, $akhir]);
            }
            $transaksi = $trxQuery->get();
        }

        // Cek apakah export Excel
        if ($request->export == 'excel') {
            $filename = 'laporan_' . $jenis . '_' . now()->format('Ymd_His') . '.xls';

            return response()->view('backend.laporan.export_excel', compact('kas', 'jenis', 'transaksi'))
                ->header('Content-Type', 'application/vnd.ms-excel')
                ->header('Content-Disposition', 'attachment; filename=laporan_kas.xls');

        }

        return view('backend.laporan.index', compact('kas', 'transaksi', 'jenis'));
    }
}
