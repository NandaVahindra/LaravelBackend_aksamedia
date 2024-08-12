<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        try{
            $query = Employee::with('division');

            if ($request->has('name')) {
                $query->where('name', 'LIKE', "%{$request->name}%");
            }

            if ($request->has('division_id')) {
                $query->where('division_id', $request->division_id);
            }
            
            $employees = $query->paginate(15);
            $formattedEmployees = $employees->items();
            $formattedEmployees = collect($formattedEmployees)->map(function ($employee) {
                return [
                    'id' => $employee->id,
                    'image' => $employee->image,
                    'name' => $employee->name,
                    'phone' => $employee->phone,
                    'division' => [
                        'id' => $employee->division->id,
                        'name' => $employee->division->name,
                    ],
                    'position' => $employee->position,
                ];
            });

            return response()->json([
                'status' => 'success',
                'data' => [
                    'employees' => $formattedEmployees,
                ],
                'pagination' => [
                    'first_page_url' => $employees->url(1),
                    'from' => $employees->firstItem(),
                    'last_page' => $employees->lastPage(),
                    'last_page_url' => $employees->url($employees->lastPage()),
                    'next_page_url' => $employees->nextPageUrl(),
                    'path' => $employees->path(),
                    'per_page' => $employees->perPage(),
                    'prev_page_url' => $employees->previousPageUrl(),
                    'to' => $employees->lastItem(),
                    'total' => $employees->total(),
                ]
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required|url',
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'division' => 'required|exists:divisions,id',
            'position' => 'required|string|max:255',
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 400);
        }
        try{
            $employee = Employee::create([
                'image' => $request->image,
                'name' => $request->name,
                'phone' => $request->phone,
                'division_id' => $request->division,
                'position' => $request->position,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Employee created successfully'
            ], 201);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required|url',
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'division' => 'required|exists:divisions,id',
            'position' => 'required|string|max:255',
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 400);
        }

        $employee = Employee::find($id);

        if (!$employee) {
            return response()->json([
                'status' => 'error',
                'message' => 'Employee not found'
            ], 404);
        }
        try{
            $updateData = $request->only(['image', 'name', 'phone', 'division', 'position']);
            
            if (isset($updateData['division'])) {
                $updateData['division_id'] = $updateData['division'];
                unset($updateData['division']);
            }

            $employee->update($updateData);

            return response()->json([
                'status' => 'success',
                'message' => 'Employee updated successfully'
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try{
            Employee::destroy($id);

            return response()->json([
                'status' => 'success',
                'message' => 'Employee deleted successfully',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
