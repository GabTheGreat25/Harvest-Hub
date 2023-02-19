<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function index()
    {

        return response()->json([
            'data' => Admin::with(["user"])->withTrashed()->get(),
            'status' => 'success',
            'message' => 'Get admin success',
        ]);
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'user_id' => 'required|numeric'
        ]);

        if ($validator->fails()) 
            return response()->json([
                'data' => [],
                'status' => 'failed',
                'message' => 'The form is not valid',
            ]);
        
        try {
            DB::beginTransaction();

            $data = Admin::create([
                'user_id' => $request->user_id,
            ]);

            DB::commit();
        } catch (\Exception $e) {

            DB::rollback();
            return response()->json([
                'data' => [],
                'status' => 'failed',
                'message' => 'Create admin failed',
            ]);
        }

        return response()->json([
            'data' => [$data],
            'status' => 'success',
            'message' => 'Create admin success',
        ]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|numeric'
        ]);

        if ($validator->fails()) 
            return response()->json([
                'data' => [],
                'status' => 'failed',
                'message' => 'The form is not valid',
            ]);
        
        try {
            DB::beginTransaction();
            $data = Admin::find($id);

            if ($data == null) 
                return response()->json([
                    'data' => [],
                    'status' => 'failed',
                    'message' => 'Admin not found',
                ]);

            $data->user_id = $request->get('user_id');

            $data->update();
            DB::commit();
        } catch (\Exception $e) {

            DB::rollback();

            return response()->json([
                'data' => [],
                'status' => 'failed',
                'message' => $e,
            ]);
        }

        return response()->json([
            'data' => [$data],
            'status' => 'success',
            'message' => 'Update admin success',
        ]);
    }

    public function show($id)
    {
        $data = Admin::find($id);

        if ($data == null) {
            return response()->json([
                'data' => [],
                'status' => 'failed',
                'message' => 'Admin not found',
            ]);
        }
        
        return response()->json([
            'data' => [Admin::with(["user"])->find($id)],
            'status' => 'success',
            'message' => 'Get admin success',
        ]);
    }

     public function destroy($id)
    {
        $data = Admin::find($id);

        if ($data == null) 
            return response()->json([
                'data' => [],
                'status' => 'failed',
                'message' => 'Admin not found ',
            ]);
        
        $data->delete();

        return response()->json([
            'data' => [],
            'status' => 'success',
            'message' => 'Soft delete Admin success',
        ]);
    }

    public function restore($id)
    {
        $data = Admin::onlyTrashed()->find($id);

        if ($data == null) 
            return response()->json([
                'data' => [],
                'status' => 'failed',
                'message' => 'Admin not found',
            ]);
        
        $data->restore();

        return response()->json([
            'data' => [],
            'status' => 'success',
            'message' => 'Restore Admin success',
        ]);
    }

    public function forceDelete($id)
    {
        $data = Admin::find($id);

        if ($data == null) 
            return response()->json([
                'data' => [],
                'status' => 'failed',
                'message' => 'Admin not found',
            ]);
        
        $data->forceDelete();

        return response()->json([
            'data' => [],
            'status' => 'success',
            'message' => 'Permanently delete Admin success',
        ]);
    }
}
