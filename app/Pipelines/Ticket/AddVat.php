<?php

namespace App\Pipelines\Ticket;

use App\Models\TicketPurchase;
use Closure;

class AddVat
{
      public function handle(TicketPurchase $ticketPurchase, Closure $next):TicketPurchase
      {
        $ticketPurchase->total_amount *= 1.15;
        return $next($ticketPurchase);
      }
}
