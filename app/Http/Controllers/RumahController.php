<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rumah;


class RumahController extends Controller
{

     public function index()
     {
        if(Rumah::all()){
            return response()->json([
                'code' => 200,
                'message' => 'success',
                'data' => Rumah::all()
            ], 200);
        } else {
            return response()->json([
                'code' => 404,
                'message' => 'Rumah not found',
                'data' => []
            ], 404);
        }
     }
 

     public function show($id)
     {
         $rumah = Rumah::find($id);
         if($rumah){
            return response()->json([
                'code' => 200,
                'message' => 'success',
                'data' => $rumah
            ], 200);
        } else {
            return response()->json([
                'code' => 404,
                'message' => 'Rumah not found',
                'data' => []
            ], 404);
        }
     }
 

     public function store(Request $request)
     {

            $validated = $request->validate([
                'alamat' => 'required|string',
                'status_rumah' => 'required|in:dihuni,tidak_dihuni',
            ]);

            $rumah = Rumah::create($validated);
         if ($rumah) {
            return response()->json([
                'code' => 201,
                'message' => 'rumah successfully added',
                'data' => $rumah
            ], 200);
        } else {
            return response()->json([
                'code' => 404,
                'message' => 'rumah unsuccessfully added',
                'data' => []
            ], 404);
        }
     }
 

     public function update(Request $request, $id)
     {
        $validated = $request->validate([
            'alamat' => 'required|string',
             'status_rumah' => 'required|in:dihuni,tidak_dihuni',
             ]);
         $rumah = Rumah::find($id);
         $rumah->update($validated);
            if ($rumah) {
                return response()->json([
                    'code' => 200,
                    'message' => 'rumah successfully updated',
                    'data' => $rumah
                ], 200);
            } else {
                return response()->json([
                    'code' => 404,
                    'message' => 'rumah unsuccessfully updated',
                    'data' => []
                ], 404);
            }
     }
 

     public function destroy($id)
     {
         $rumah = Rumah::find($id);
            $rumah->delete();
            if ($rumah) {
                return response()->json([
                    'code' => 200,
                    'message' => 'rumah successfully deleted',
                    'data' => $rumah
                ], 200);
            } else {
                return response()->json([
                    'code' => 404,
                    'message' => 'rumah unsuccessfully deleted',
                    'data' => []
                ], 404);
            }
     }


    public function totalRumah()
    {
        $total = Rumah::all()->count();
        if($total){
            return response()->json([
                'code' => 200,
                'message' => 'success',
                'data' => $total
            ], 200);
        } else {
            return response()->json([
                'code' => 404,
                'message' => 'Rumah not found',
                'data' => []
            ], 404);
        }
    }
}
