<?php

namespace App\DataTransferObjects;

final class TicketData
{
    public function __construct(
        public readonly int $event_id,
        public readonly string $name,
        public readonly float $price,
        public readonly int $quantity,
    ) {
        //
    }
}