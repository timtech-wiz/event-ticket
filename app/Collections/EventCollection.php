<?php

namespace App\Collections;

use App\Models\Event;
use Illuminate\Database\Eloquent\Collection;

class EventCollection extends Collection
{
    public function published(): static
    {
        return $this->filter(
            fn (Event $event) => $event->status === 'published'
        );
    }
}
