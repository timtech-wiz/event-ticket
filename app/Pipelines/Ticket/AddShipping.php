<?php

namespace App\Pipelines\Ticket;

use App\Models\TicketPurchase;
use Closure;

class AddShipping
{
    public function handle(TicketPurchase $ticketPurchase, Closure $next): TicketPurchase
    {
        $ticketPurchase->total_amount += 10;

        return $next($ticketPurchase);
    }
}
