<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Division;


class DivisionController extends Controller
{
    public function index(Request $request)
    {
        try{
            $query = Division::query();

            if ($request->has('name')) {
                $query->where('name', 'LIKE', "%{$request->name}%");
            }
            
            $query->select('id', 'name');
            $divisions = $query->paginate(15);

            return response()->json([
                'status' => 'success',
                'message' => 'Data division berhasil diambil',
                'data' => [
                    'divisions' => $divisions->items(),
                ],
                'pagination' => [
                    'first_page_url' => $divisions->url(1),
                    'from' => $divisions->firstItem(),
                    'last_page' => $divisions->lastPage(),
                    'last_page_url' => $divisions->url($divisions->lastPage()),
                    'next_page_url' => $divisions->nextPageUrl(),
                    'path' => $divisions->path(),
                    'per_page' => $divisions->perPage(),
                    'prev_page_url' => $divisions->previousPageUrl(),
                    'to' => $divisions->lastItem(),
                    'total' => $divisions->total(),
                ],
            ]); 
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage()
            ], 500);
        }
        
    }
}
