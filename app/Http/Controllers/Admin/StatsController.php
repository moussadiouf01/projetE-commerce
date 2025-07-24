<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;

class StatsController extends Controller
{
    public function index()
    {
        $chiffreAffaires = Order::whereIn('status', ['livré', 'expédié'])
            ->sum('total');
        $nbCommandes = Order::count();
        $nbClients = User::count();
        $topProduits = Product::withSum('orderItems as total_vendus', 'quantity')
            ->orderByDesc('total_vendus')
            ->take(5)
            ->get();

        return view('admin.stats.index', compact('chiffreAffaires', 'nbCommandes', 'nbClients', 'topProduits'));
    }
} 