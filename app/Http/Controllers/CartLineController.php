<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CartLine;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CartLineController extends Controller
{
    public function index()
    {

        return response()->json([
            'data' => CartLine::with(["product", "cart"])->withTrashed()->get(),
            'status' => 'success',
            'message' => 'Get cart line success',
        ]);
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'product_id' => 'required|numeric',
            'cart_id' => 'required|numeric',
            'quantity' => 'required|numeric'
        ]);

        if ($validator->fails()) 
            return response()->json([
                'data' => [],
                'status' => 'failed',
                'message' => 'The form is not valid',
            ]);
        
        try {
            DB::beginTransaction();

            $data = CartLine::create([
                'product_id' => $request->product_id,
                'cart_id' => $request->cart_id,
                'quantity' => $request->quantity,
            ]);

            DB::commit();
        } catch (\Exception $e) {

            DB::rollback();
            return response()->json([
                'data' => $e,
                'status' => 'failed',
                'message' => 'Create cart line failed',
            ]);
        }

        return response()->json([
            'data' => [$data],
            'status' => 'success',
            'message' => 'Create cart line success',
        ]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|numeric',
            'cart_id' => 'required|numeric',
            'quantity' => 'required|numeric'
        ]);

        if ($validator->fails()) 
            return response()->json([
                'data' => [],
                'status' => 'failed',
                'message' => 'The form is not valid',
            ]);
        
        try {
            DB::beginTransaction();
            $data = CartLine::find($id);

            if ($data == null) {
                return response()->json([
                    'data' => [],
                    'status' => 'failed',
                    'message' => 'cart line not found',
                ]);
            }

            $data->product_id = $request->get('product_id');
            $data->cart_id = $request->get('cart_id');
            $data->quantity = $request->get('quantity');

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
            'message' => 'Update cart line success',
        ]);
    }

    public function show($id)
    {
        $data = CartLine::find($id);

        if ($data == null) {
            return response()->json([
                'data' => [],
                'status' => 'failed',
                'message' => 'cart line not found',
            ]);
        }

        return response()->json([
            'data' => [CartLine::with(["product", "cart"])->find($id)],
            'status' => 'success',
            'message' => 'Get cart line success',
        ]);
    }

     public function destroy($id)
    {
        $data = CartLine::find($id);

        if ($data == null) 
            return response()->json([
                'data' => [],
                'status' => 'failed',
                'message' => 'CartLine not found ',
            ]);
        
        $data->delete();

        return response()->json([
            'data' => [],
            'status' => 'success',
            'message' => 'Soft delete CartLine success',
        ]);
    }

    public function restore($id)
    {
        $data = CartLine::onlyTrashed()->find($id);

        if ($data == null) 
            return response()->json([
                'data' => [],
                'status' => 'failed',
                'message' => 'CartLine not found',
            ]);
        
        $data->restore();

        return response()->json([
            'data' => [],
            'status' => 'success',
            'message' => 'Restore CartLine success',
        ]);
    }

    public function forceDelete($id)
    {
        $data = CartLine::find($id);

        if ($data == null) 
            return response()->json([
                'data' => [],
                'status' => 'failed',
                'message' => 'CartLine not found',
            ]);
        
        $data->forceDelete();

        return response()->json([
            'data' => [],
            'status' => 'success',
            'message' => 'Permanently delete CartLine success',
        ]);
    }
}
