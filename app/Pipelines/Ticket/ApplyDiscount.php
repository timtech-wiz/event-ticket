<?php

namespace App\Pipelines\Ticket;

use App\Models\TicketPurchase;
use Closure;

class ApplyDiscount
{
    public function handle(TicketPurchase $ticketPurchase, Closure $next):TicketPurchase
    {
        $ticketPurchase->total_amount *= 0.9;
        return $next($ticketPurchase);
    }
}
