<?php

namespace App\DataTransferObjects;

final class EventData
{
    public function __construct(
        public readonly string $title,
        public readonly ?string $description,
        public readonly string $start_at,
        public readonly ?string $end_at,
        public readonly ?string $location,
        public readonly int $total_seats,
        public readonly int $available_seats,

    ) {
        //
    }
}
