<?php

namespace App\Actions;

use App\DataTransferObjects\EventData;
use App\Models\Event;

class UpsertEventAction
{
    public static function execute(EventData $eventData, Event $event): Event
    {
        // $event->title = $eventData->title;
        // $event->description = $eventData->description;
        // $event->start_at = $eventData->start_at;
        // $event->end_at = $eventData->end_at;
        // $event->location = $eventData->location;
        // $event->total_seats = $eventData->total_seats;

        // $event->save();

        // return $event;

        return Event::updateOrCreate(
            ['id' => $event->id],
            [
                'title' => $eventData->title,
                'description' => $eventData->description,
                'start_at' => $eventData->start_at,
                'end_at' => $eventData->end_at,
                'location' => $eventData->location,
                'total_seats' => $eventData->total_seats,
            ]
        );
    }
}
