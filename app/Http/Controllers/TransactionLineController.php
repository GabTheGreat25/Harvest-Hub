<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TransactionLine;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class TransactionLineController extends Controller
{
    public function index()
    {

        return response()->json([
            'data' => TransactionLine::with(["product", "transaction"])->withTrashed()->get(),
            'status' => 'success',
            'message' => 'Get transaction line success',
        ]);
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'product_id' => 'required|numeric',
            'transaction_id' => 'required|numeric',
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

            $data = TransactionLine::create([
                'product_id' => $request->product_id,
                'transaction_id' => $request->transaction_id,
                'quantity' => $request->quantity,
            ]);

            DB::commit();
        } catch (\Exception $e) {

            DB::rollback();
            return response()->json([
                'data' => [],
                'status' => 'failed',
                'message' => 'Create transaction line failed',
            ]);
        }

        return response()->json([
            'data' => [$data],
            'status' => 'success',
            'message' => 'Create transaction line success',
        ]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|numeric',
            'transaction_id' => 'required|numeric',
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
            $data = TransactionLine::find($id);

            if ($data == null) 
                return response()->json([
                    'data' => [],
                    'status' => 'failed',
                    'message' => 'Transaction line not found',
                ]);
            

            $data->product_id = $request->get('product_id');
            $data->transaction_id = $request->get('transaction_id');
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
            'message' => 'Update transaction line success',
        ]);
    }

    public function show($id)
    {
        $data = TransactionLine::find($id);

        if ($data == null) {
            return response()->json([
                'data' => [],
                'status' => 'failed',
                'message' => 'Transaction line not found',
            ]);
        }

        return response()->json([
            'data' => [TransactionLine::with(["product", "transaction"])->find($id)],
            'status' => 'success',
            'message' => 'Get transaction line success',
        ]);
    }

     public function destroy($id)
    {
        $data = TransactionLine::find($id);

        if ($data == null) 
            return response()->json([
                'data' => [],
                'status' => 'failed',
                'message' => 'Transaction Line not found ',
            ]);
        
        $data->delete();

        return response()->json([
            'data' => [],
            'status' => 'success',
            'message' => 'Soft delete Transaction Line success',
        ]);
    }

    public function restore($id)
    {
        $data = TransactionLine::onlyTrashed()->find($id);

        if ($data == null) 
            return response()->json([
                'data' => [],
                'status' => 'failed',
                'message' => 'Transaction Line not found',
            ]);
        
        $data->restore();

        return response()->json([
            'data' => [],
            'status' => 'success',
            'message' => 'Restore Transaction Line success',
        ]);
    }

    public function forceDelete($id)
    {
        $data = TransactionLine::find($id);

        if ($data == null) 
            return response()->json([
                'data' => [],
                'status' => 'failed',
                'message' => 'Transaction Line not found',
            ]);
        
        $data->forceDelete();

        return response()->json([
            'data' => [],
            'status' => 'success',
            'message' => 'Permanently delete Transaction Line success',
        ]);
    }
}
