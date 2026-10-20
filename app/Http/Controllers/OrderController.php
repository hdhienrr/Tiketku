<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    // Proses simpan pesanan dari halaman detail event
    public function store(Request $request)
    {
        // Pastikan user sudah login
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu untuk memesan tiket.');
        }

        $ticketsInput = $request->input('tickets', []); // format: [ticket_id => quantity]
        
        // Filter tiket yang jumlahnya > 0
        $selectedTickets = array_filter($ticketsInput, function($qty) {
            return $qty > 0;
        });

        if (empty($selectedTickets)) {
            return back()->with('error', 'Pilih minimal 1 tiket untuk melanjutkan.');
        }

        DB::beginTransaction();
        try {
            $totalPrice = 0;
            $itemsData = [];

            foreach ($selectedTickets as $ticketId => $qty) {
                $ticket = Ticket::findOrFail($ticketId);
                
                if ($ticket->stock < $qty) {
                    throw new \Exception("Stok tiket {$ticket->name} tidak mencukupi!");
                }

                $subtotal = $ticket->price * $qty;
                $totalPrice += $subtotal;

                // Kurangi stok tiket
                $ticket->stock -= $qty;
                $ticket->save();

                $itemsData[] = [
                    'ticket_id' => $ticket->id,
                    'quantity' => $qty,
                    'price' => $ticket->price,
                ];
            }

            // Buat Order baru
            $order = Order::create([
                'user_id' => Auth::id(),
                'total_price' => $totalPrice,
                'status' => 'pending',
            ]);

            // Simpan detail item order
            foreach ($itemsData as $item) {
                $order->items()->create($item);
            }

            DB::commit();

            return redirect()->route('order.success', $order->id)->with('success', 'Pesanan berhasil dibuat!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }

    // Halaman Sukses / Detail Pesanan
    public function success($id)
    {
        $order = Order::with('items.ticket.event', 'user')->findOrFail($id);
        return view('orders.success', compact('order'));
    }
}