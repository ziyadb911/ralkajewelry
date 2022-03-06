<?php

namespace App\Http\Controllers;

use App\Models\CompanyInfo;
use App\Models\CustomerResponse;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $unreadResponseCount = CustomerResponse::where('is_readed', 0)->count();
        $customerResponses = CustomerResponse::where('is_readed', 0)->limit(10)->orderBy('created_at', 'DESC')->get();
        $data = [
            'unreadResponseCount' => $unreadResponseCount,
            'customerResponses' => $customerResponses,
        ];
        return view('admin.dashboard', $data);
    }
}
