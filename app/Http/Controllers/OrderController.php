<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function markAsDelivered($id)
    {
        try {
            $order = Order::findOrFail($id);
            
            // Update both status and delivery_status
            $order->update([
                'delivery_status' => 'delivered',
                'status' => 'completed' // Or whatever your final status should be
            ]);
            
            return redirect()->back()->with('success', 'Order #'.$order->id.' marked as delivered successfully!');
            
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update order status: '.$e->getMessage());
        }
    }
}