<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    // INDEX: Read all sales
    public function index()
    {
        // Load sales with plant and user info
        $sales = Sale::with(['plant', 'user'])->get();

        return view('sales.index', compact('sales'));
    }
}
