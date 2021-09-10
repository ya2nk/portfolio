<?php

namespace App\Http\Controllers\Admin;

use App\Models\Statistic;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $item = Statistic::orderByDesc("tanggal")->limit('4')->get();
        return view('admin.dashboard.index', compact('item'));
    }
}
