<?php

namespace App\Actions;

use App\DataTransferObjects\PurchaseTicketData;
use App\Models\Ticket;
use App\Models\TicketPurchase;
use App\Pipelines\Ticket\AddShipping;
use App\Pipelines\Ticket\AddVat;
use App\Pipelines\Ticket\ApplyDiscount;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Pipeline;
use Illuminate\Validation\ValidationException;

class PurchaseTicketAction
{
    public static function execute(
        PurchaseTicketData $data
    ): TicketPurchase {
        return DB::transaction(function () use ($data) {

            $ticket = Ticket::whereKey($data->ticket_id)
                //->lockForUpdate()
                ->firstOrFail();

            $available = $ticket->quantity - $ticket->quantity_sold;

            if ($data->quantity > $available) {
                throw ValidationException::withMessages([
                    'quantity' => "Only {$available} ticket(s) available.",
                ]);
            }

            $ticket->increment('quantity_sold', $data->quantity);

            $ticketPuchased = TicketPurchase::create([
                'ticket_id' => $ticket->id,
                'user_id' => $data->user_id,
                'quantity' => $data->quantity,
                'total_amount' => $ticket->price * $data->quantity,
            ]);

            $pipes = [
                ApplyDiscount::class,
                AddVat::class,
                AddShipping::class
            ];

            $ticketPuchased = app(Pipeline::class)
                ->send($ticketPuchased)
                ->through($pipes)
                ->then(function(TicketPurchase $ticketPurchase){
                    $ticketPurchase->save();
                    return $ticketPurchase;
            });
        });
    }
}