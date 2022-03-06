<?php

namespace App\Http\Controllers;

use App\Models\CustomerResponse;
use DB;
use Exception;
use Illuminate\Http\Request;

class CustomerResponseController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->keyword;
        $is_readed = $request->status;
        $created_at_min = $request->tglmin;
        $created_at_max = $request->tglmaks;
        $customerResponses = CustomerResponse::when(isset($keyword), function ($q) use ($keyword) {
            $q->where(function ($q) use ($keyword) {
                $q->where('name', 'LIKE', "%$keyword%")
                    ->orWhere('phone', 'LIKE', "%$keyword%")
                    ->orWhere('email', 'LIKE', "%$keyword%");
            });
        })->when(isset($is_readed), function ($q) use ($is_readed) {
            $q->where('is_readed', $is_readed);
        })->when(isset($created_at_min), function ($q) use ($created_at_min) {
            $q->whereDate('created_at', '>=', $created_at_min);
        })->when(isset($created_at_max), function ($q) use ($created_at_max) {
            $q->whereDate('created_at', '<=', $created_at_max);
        })
            ->orderBy("is_readed", "ASC")->orderBy('created_at', "DESC")->paginate($this->paginate);
        $data = array(
            "customerResponses" => $customerResponses,
        );
        return view('admin.respon-customer.index', $data);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ["required", "max:100", "unique:App\Models\CustomerResponse,name,NULL,NULL,deleted_at,NULL"],
        ], [
            'name.required' => 'Nama tidak boleh kosong.',
            'name.max' => 'Nama maksimal 100 karakter.',
            'name.unique' => 'Nama sudah digunakan.',
        ]);
        DB::beginTransaction();
        try {
            $customerResponse = CustomerResponse::create($validated);
            DB::commit();
            return response()->json([
                'success' => true,
                'message' => "customerResponse \"$customerResponse->name\" berhasil ditambahkan",
            ], 200);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function show(CustomerResponse $customerResponse)
    {
        $this->read($customerResponse);
        $data = [
            'customerResponse' => $customerResponse
        ];
        return view('admin.respon-customer.lihat', $data);
    }

    private function read(CustomerResponse $customerResponse)
    {
        DB::beginTransaction();
        try {
            $customerResponse->update(['is_readed' => 1]);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->withErrors([
                    'mess' => $e->getMessage()
                ]);
        }
    }

    private function unread(CustomerResponse $customerResponse)
    {
        DB::beginTransaction();
        try {
            $customerResponse->update(['is_readed' => 0]);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->withErrors([
                    'mess' => $e->getMessage()
                ]);
        }
    }

    public function destroy(CustomerResponse $customerResponse)
    {
        DB::beginTransaction();
        try {
            $customerResponse->delete();
            DB::commit();
            return response()->json([
                'success' => true,
                'message' => "Respon Customer \"$customerResponse->name\" berhasil dihapus",
            ], 200);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
