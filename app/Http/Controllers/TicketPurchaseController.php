<?php

namespace App\Http\Controllers;

use App\Actions\PurchaseTicketAction;
use App\DataTransferObjects\PurchaseTicketData;
use App\Http\Resources\TicketPurchaseResource;
use Illuminate\Http\Request;

class TicketPurchaseController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'ticket_id' => ['required', 'exists:tickets,id'],
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        $purchase = PurchaseTicketAction::execute(
            new PurchaseTicketData(
                ticket_id: $validated['ticket_id'],
                user_id: 1,
                quantity: $validated['quantity'],
            )
        );

        return new TicketPurchaseResource($purchase);
    }
}