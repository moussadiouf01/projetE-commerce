<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Notifications\OrderStatusChanged;
use App\Models\Admin;
use App\Notifications\OrderStatusChangedClient;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['user', 'orderItems.product'])->latest()->paginate(10);
        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load(['user', 'orderItems.product']);
        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:en attente,en cours,expédié,livré,annulé'
        ]);

        $oldStatus = $order->status;
        $order->update([
            'status' => $request->status
        ]);

        // Notifier tous les admins
        foreach (Admin::all() as $admin) {
            $admin->notify(new OrderStatusChanged($order, $oldStatus, $request->status));
        }
        // Notifier le client
        $order->user->notify(new OrderStatusChangedClient($order, $oldStatus, $request->status));

        return redirect()->back()->with('success', 'Statut de la commande mis à jour avec succès.');
    }

    public function downloadInvoice(Order $order)
    {
        $order->load(['user', 'orderItems.product']);
        $pdf = Pdf::loadView('admin.orders.invoice', compact('order'));
        return $pdf->download('facture_commande_'.$order->id.'.pdf');
    }
} 