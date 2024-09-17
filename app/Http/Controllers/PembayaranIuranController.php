<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PembayaranIuran;
use Illuminate\Support\Facades\DB;

class PembayaranIuranController extends Controller
{

     public function index()
     {
         if(PembayaranIuran::all()){
             return response()->json([
                 'code' => 200,
                 'message' => 'success',
                 'data' => PembayaranIuran::all()
             ], 200);
         } else {
             return response()->json([
                 'code' => 404,
                 'message' => 'pembayaran iuran not found',
                 'data' => []
             ], 404);
         }
     }
 

     public function store(Request $request)
     {
         $validated = $request->validate([
             'PenghuniRumah_id' => 'required',
             'tgl_pembayaran' => 'required|date',
             'jenis_iuran' => 'required|in:satpam,kebersihan',
             'periode_bayar' => 'required|in:bulan,tahun',
             'jumlah_iuran' => 'required',
             'status_pembayaran' => 'required|in:lunas,belum',
         ]);
 
         $pembayaran = PembayaranIuran::create($validated);
         
         if($pembayaran){
             return response()->json([
                 'code' => 201,
                 'message' => 'pembayaran iuran successfully added',
                 'data' => $pembayaran
             ], 201);
         } else {
             return response()->json([
                 'code' => 404,
                 'message' => 'pembayaran iuran not found',
                 'data' => []
             ], 404);
         }
     }
 

     public function update(Request $request, $id)
     {
         $pembayaran = PembayaranIuran::find($id);
         if ($pembayaran) {
             $validated = $request->validate([
                'PenghuniRumah_id' => 'required|exists:penghuni_rumahs,PenghuniRumah_id',
                'tgl_pembayaran' => 'required|date',
                'jenis_iuran' => 'required|in:Satpam,Kebersihan',
                'periode_bayar' => 'required|in:Bulan,Tahun',
                'jumlah_iuran' => 'required|numeric',
                'status_pembayaran' => 'required|in:Lunas,Belum',
             ]);
 
             $pembayaran->update($validated);
            
                    return response()->json([
                        'code' => 200,
                        'message' => 'pembayaran iuran updated successfully',
                        'data' => $pembayaran
                    ], 200);
         } else {
                return response()->json([
                    'code' => 404,
                    'message' => 'pembayaran iuran not found',
                    'data' => []
                ], 404);
         }
     }
 

     public function destroy($id)
     {
         $pembayaran = PembayaranIuran::find($id);
            if ($pembayaran) {
                $pembayaran->delete();
                    return response()->json([
                        'code' => 200,
                        'message' => 'pembayaran iuran deleted successfully',
                        'data' => $pembayaran
                    ], 200);
            } else {
                    return response()->json([
                        'code' => 404,
                        'message' => 'pembayaran iuran not found',
                        'data' => []
                    ], 404);
            }
     }

    public function getPembayaranIuranByRumahId($id)
    {
        $pembayaran = PembayaranIuran::with(['penghuniRumah.warga'])->whereHas('penghuniRumah', function($query) use ($id) {
            $query->where('rumah_id', $id);
        })->get();
        if ($pembayaran) {
            return response()->json([
                'code' => 200,
                'message' => 'success',
                'data' => $pembayaran
            ], 200);
        } else {
            return response()->json([
                'code' => 404,
                'message' => 'pembayaran iuran not found',
                'data' => []
            ], 404);
        }
    }

    public function getIuranPerBulanDalamTahun($tahun)
    {
        $iuranPerBulan = PembayaranIuran::select(
            DB::raw('MONTH(tgl_pembayaran) as bulan'),
            DB::raw('SUM(jumlah_iuran) as total_iuran_per_bulan')
        )
        ->whereYear('tgl_pembayaran', $tahun)
        ->groupBy(DB::raw('MONTH(tgl_pembayaran)'))
        ->orderBy('bulan')
        ->get()
        ->keyBy('bulan');
        $bulanArray = [];
    for ($bulan = 1; $bulan <= 12; $bulan++) {
        $bulanArray[] = $iuranPerBulan->get($bulan)->total_iuran_per_bulan ?? 0;
    }
        if ($bulanArray) {
            return response()->json([
                'code' => 200,
                'message' => 'success',
                'data' => $bulanArray
            ], 200);
        } else {
            return response()->json([
                'code' => 404,
                'message' => 'pembayaran iuran not found',
                'data' => []
            ], 404);
        }
    }

    public function totalIuranIn1Year($year){
        $iuran = PembayaranIuran::whereYear('tgl_pembayaran', $year)->sum('jumlah_iuran');
        if ($iuran) {
            return response()->json([
                'code' => 200,
                'message' => 'success',
                'data' => $iuran
            ], 200);
        } else {
            return response()->json([
                'code' => 404,
                'message' => 'iuran not found',
                'data' => []
            ], 404);
        }
     }
}
