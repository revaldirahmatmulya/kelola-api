<?php

namespace App\Http\Controllers;

use App\Models\Warga;
use App\Http\Requests\StoreWargaRequest;
use App\Http\Requests\UpdateWargaRequest;
use Illuminate\Http\Request;

class WargaController extends Controller
{

     public function index()
     {
         return response()->json(Warga::all(), 200);
     }
 

     public function show($id)
     {
         $warga = Warga::find($id);
         if($warga){
            return response()->json([
                'code' => 200,
                'message' => 'success',
                'data' => Warga::all()
            ], 200);
        } else {
            return response()->json([
                'code' => 404,
                'message' => 'Warga not found',
                'data' => []
            ], 404);
        }
     }
 

     public function store(Request $request)
     {
         $validated = $request->validate([
             'nama' => 'required|string',
             'foto' => 'nullable|string',
             'status' => 'required|in:Tetap,Kontrak',
             'no_telp' => 'required|string',
             'status_menikah' => 'required|in:Sudah,Belum',
             'tgl_bergabung' => 'required|date',
         ]);
 
         $warga = Warga::create($validated);
         if ($warga) {
            return response()->json([
                'code' => 201,
                'message' => 'warga successfully added',
                'data' => $warga
            ], 201);
        } else {
            return response()->json([
                'code' => 404,
                'message' => 'warga not found',
                'data' => []
            ], 404);
        }
     }
 

     public function update(Request $request, $id)
     {
         $warga = Warga::find($id);
         $validated = $request->validate([
        'nama' => 'nullable|string',
         'ktp' => 'nullable|string',
         'status' => 'nullable|in:tetap,kontrak',
         'no_telp' => 'nullable|string',
         'status_menikah' => 'nullable|in:Sudah,Belum',
         'tgl_bergabung' => 'nullable|date',
         ]);
         
        $warga->update($validated);
            
         if ($warga) {
            return response()->json([
                'code' => 200,
                'message' => 'warga successfully updated',
                'data' => $warga
            ], 200);
        } else {
            return response()->json([
                'code' => 404,
                'message' => 'warga unsuccessfully updated',
                'data' => []
            ], 404);
        }
     }

     public function updateWarga(Request $request, $id)
     {
         $warga = Warga::find($id);
         $validated = $request->validate([
        'nama' => 'nullable|string',
         'ktp' => 'nullable|string',
         'status' => 'nullable|in:tetap,kontrak',
         'no_telp' => 'nullable|string',
         'status_menikah' => 'nullable|in:Sudah,Belum',
         ]);
         
        $warga->nama = $request->nama;
        $warga->ktp = $request->ktp;
        $warga->status = $request->status;
        $warga->no_telp = $request->no_telp;
        $warga->status_menikah = $request->status_menikah;
        $warga->save();
            
         if ($warga) {
            return response()->json([
                'code' => 200,
                'message' => 'warga successfully updated',
                'data' => $warga
            ], 200);
        } else {
            return response()->json([
                'code' => 404,
                'message' => 'warga unsuccessfully updated',
                'data' => []
            ], 404);
        }
     }
 
     public function destroy($id)
     {
         $warga = Warga::find($id);
            if ($warga) {
                $warga->delete();
                return response()->json([
                    'code' => 200,
                    'message' => 'warga deleted successfully',
                    'data' => []
                ], 200);
            } else {
                return response()->json([
                    'code' => 404,
                    'message' => 'warga not found',
                    'data' => []
                ], 404);
            }
     }


    public function totalWarga()
    {
        $warga = Warga::all();
        $totalWarga = count($warga);
        if ($warga) {
            return response()->json([
                'code' => 200,
                'message' => 'success',
                'data' => $totalWarga
            ], 200);
        } else {
            return response()->json([
                'code' => 404,
                'message' => 'warga not found',
                'data' => []
            ], 404);
        }
    }
    
    
}
