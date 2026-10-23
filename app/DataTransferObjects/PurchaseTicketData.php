<?php

namespace App\DataTransferObjects;

final class PurchaseTicketData
{
    public function __construct(
        public readonly int $ticket_id,
        public readonly int $user_id,
        public readonly int $quantity,
    ) {
    }
}