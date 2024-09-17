<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PenghuniRumah;
use App\Models\Warga;

class PenghuniRumahController extends Controller
{

     public function index()
     {

        $penghuniRumah = PenghuniRumah::with('warga', 'rumah')->get();
            if($penghuniRumah){
                return response()->json([
                    'code' => 200,
                    'message' => 'success',
                    'data' => $penghuniRumah
                ], 200);
            } else {
                return response()->json([
                    'code' => 404,
                    'message' => 'penghuni rumah not found',
                    'data' => []
                ], 404);
            }
     }
 

     public function store(Request $request)
     {
         $validated = $request->validate([
             'rumah_id' => 'required|exists:rumahs,rumah_id',
             'warga_id' => 'required|exists:wargas,warga_id',
             'tgl_masuk' => 'required|date',
             'tgl_keluar' => 'nullable|date',
         ]);
 
         $penghuniRumah = PenghuniRumah::create($validated);
         if ($penghuniRumah) {
             return response()->json([
                 'code' => 201,
                 'message' => 'penghuni rumah successfully added',
                 'data' => $penghuniRumah
             ], 201);
         } else {
             return response()->json([
                 'code' => 404,
                 'message' => 'penghuni rumah not found',
                 'data' => []
             ], 404);
         }
     }
 

     public function update(Request $request, $id)
     {
         $penghuniRumah = PenghuniRumah::find($id);
         if ($penghuniRumah) {
             $validated = $request->validate([
                'rumah_id' => 'required|exists:rumahs,rumah_id',
                'warga_id' => 'required|exists:wargas,warga_id',
                'tgl_masuk' => 'required|date',
                'tgl_keluar' => 'nullable|date',
             ]);
 
             $penghuniRumah->update($validated);
             
                return response()->json([
                    'code' => 200,
                    'message' => 'penghuni rumah updated successfully',
                    'data' => $penghuniRumah
                ], 200);
         } else {
                return response()->json([
                    'code' => 404,
                    'message' => 'penghuni rumah not found',
                    'data' => []
                ], 404);
         }
     }
 

     public function destroy($id)
     {
         $penghuniRumah = PenghuniRumah::find($id);
            if ($penghuniRumah) {
                $penghuniRumah->delete();
                return response()->json([
                    'code' => 200,
                    'message' => 'penghuni rumah deleted successfully',
                    'data' => $penghuniRumah
                ], 200);
            } else {
                return response()->json([
                    'code' => 404,
                    'message' => 'penghuni rumah not found',
                    'data' => []
                ], 404);
            }
     }


        public function show($id)
        {

            $penghuniRumah = PenghuniRumah::with('warga', 'rumah')->where('rumah_id', $id)->get();
            if ($penghuniRumah) {
                return response()->json([
                    'code' => 200,
                    'message' => 'success',
                    'data' => $penghuniRumah
                ], 200);
            } else {
                return response()->json([
                    'code' => 404,
                    'message' => 'penghuni rumah not found',
                    'data' => []
                ], 404);
            }
        }


        public function createWargaAndPenghuniRumah(Request $request)
        {
            $validated = $request->validate([
                'nama' => 'required|string',
                'ktp' => 'required|string',
                'status' => 'required|in:tetap,kontrak',
                'no_telp' => 'required|string',
                'rumah_id' => 'required|exists:rumahs,id',
                'tgl_bergabung' => 'required|date',
                'status_menikah' => 'required|in:Sudah,Belum',
            ]);

            $warga = Warga::create([
                'nama' => $validated['nama'],
                'ktp' => $validated['ktp'],
                'no_telp' => $validated['no_telp'],
                'tgl_bergabung' => $validated['tgl_bergabung'],
                'status' => $validated['status'],
                'status_menikah' => $validated['status_menikah'],
            ]);

            $penghuniRumah = PenghuniRumah::create([
                'rumah_id' => $validated['rumah_id'],
                'warga_id' => $warga->id,
                'tgl_masuk' => $validated['tgl_bergabung'],
            ]);

            if ($warga && $penghuniRumah) {
                return response()->json([
                    'code' => 201,
                    'message' => 'warga and penghuni rumah successfully added',
                    'data' => [
                        'warga' => $warga,
                        'penghuni_rumah' => $penghuniRumah
                    ]
                ], 201);
            } else {
                return response()->json([
                    'code' => 404,
                    'message' => 'warga and penghuni rumah unsuccessfully added',
                    'data' => []
                ], 404);
            }
        }

        public function getWargaByRumahIdinPenghunirumah($id){
            $penghuniRumah = PenghuniRumah::with('warga')
            ->where('rumah_id', $id)
            ->get();
            if($penghuniRumah){
                return response()->json([
                    'code' => 200,
                    'message' => 'success',
                    'data' => $penghuniRumah
                ], 200);
            } else {
                return response()->json([
                    'code' => 404,
                    'message' => 'penghuni rumah not found',
                    'data' => []
                ], 404);
            }
        }
}
