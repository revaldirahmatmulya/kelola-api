<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengeluaran;
use Illuminate\Support\Facades\DB;

class PengeluaranController extends Controller
{

     public function index()
     {
         if(Pengeluaran::all()){
             return response()->json([
                 'code' => 200,
                 'message' => 'success',
                 'data' => Pengeluaran::all()
             ], 200);
         } else {
             return response()->json([
                 'code' => 404,
                 'message' => 'pengeluaran not found',
                 'data' => []
             ], 404);
         }
     }
 

     public function store(Request $request)
     {
         $validated = $request->validate([
             'tgl_pengeluaran' => 'required|date',
             'keterangan' => 'required|string',
             'jenis_pengeluaran' => 'required|string',
             'jumlah_pengeluaran' => 'required|numeric',
         ]);
 
         $pengeluaran = Pengeluaran::create($validated);
            if ($pengeluaran) {
                return response()->json([
                    'code' => 201,
                    'message' => 'pengeluaran successfully added',
                    'data' => $pengeluaran
                ], 201);
            } else {
                return response()->json([
                    'code' => 404,
                    'message' => 'pengeluaran not found',
                    'data' => []
                ], 404);
            }
     }
 

     public function update(Request $request, $id)
     {
         $pengeluaran = Pengeluaran::find($id);
         if ($pengeluaran) {
             $validated = $request->validate([
                'tgl_pengeluaran' => 'required|date',
             'keterangan' => 'required|string',
             'jenis_pengeluaran' => 'required|string',
             'jumlah_pengeluaran' => 'required|numeric',
             ]);
 
             $pengeluaran->update($validated);
                 
                    return response()->json([
                        'code' => 200,
                        'message' => 'pengeluaran updated successfully',
                        'data' => $pengeluaran
                    ], 200);
         } else {
                return response()->json([
                    'code' => 404,
                    'message' => 'pengeluaran not found',
                    'data' => []
                ], 404);
         }
     }
 

     public function destroy($id)
     {
         $pengeluaran = Pengeluaran::find($id);
         if ($pengeluaran) {
             $pengeluaran->delete();
                return response()->json([
                    'code' => 200,
                    'message' => 'pengeluaran deleted successfully',
                    'data' => []
                ], 200);
         } else {
                return response()->json([
                    'code' => 404,
                    'message' => 'pengeluaran not found',
                    'data' => []
                ], 404);
         }
     }

     public function getPengeluaraByDateIn1Year(Request $request,$tahun)
     {
        $pengeluaranPerBulan = Pengeluaran::select(
            DB::raw('MONTH(tgl_pengeluaran) as bulan'),
            DB::raw('SUM(jumlah_pengeluaran) as total_pengeluaran_per_bulan')
        )
        ->whereYear('tgl_pengeluaran', $tahun)
        ->groupBy(DB::raw('MONTH(tgl_pengeluaran)'))
        ->orderBy('bulan')
        ->get()
        ->keyBy('bulan');

        $bulanArray = [];
    for ($bulan = 1; $bulan <= 12; $bulan++) {
        $bulanArray[] = $pengeluaranPerBulan->get($bulan)->total_pengeluaran_per_bulan ?? 0;
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

     public function totalPengeluaranIn1Year($year){
        $pengeluaran = Pengeluaran::whereYear('tgl_pengeluaran', $year)->sum('jumlah_pengeluaran');
        if ($pengeluaran) {
            return response()->json([
                'code' => 200,
                'message' => 'success',
                'data' => $pengeluaran
            ], 200);
        } else {
            return response()->json([
                'code' => 404,
                'message' => 'pengeluaran not found',
                'data' => []
            ], 404);
        }
     }

     public function getPengeluaranByYear($year){
        $pengeluaran = Pengeluaran::whereYear('tgl_pengeluaran', $year)->get();
        if ($pengeluaran) {
            return response()->json([
                'code' => 200,
                'message' => 'success',
                'data' => $pengeluaran
            ], 200);
        } else {
            return response()->json([
                'code' => 404,
                'message' => 'pengeluaran not found',
                'data' => [
            ], 404);
        }
     }
        
}
