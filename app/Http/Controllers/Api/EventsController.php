<?php

namespace App\Http\Controllers\Api;

use App\Actions\UpsertEventAction;
use App\DataTransferObjects\EventData;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpsertEventRequest;
use App\Http\Resources\EventResource;
use App\Models\Event;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EventsController extends Controller
{
    /**
     * Get all events.
     */
    public function index(Request $request): JsonResponse
    {
        //$events = Event::latest()->paginate(10);
        $events = Event::query()
        ->with("oldestEvent")
        ->when($request->search, function ($query) use ($request) {
            $query->where('title', 'LIKE', '%' . $request->search . '%');
        })
        ->latest()
        ->paginate(10);

        //$events = Event::find([1,2,3]);

        return response()->json([
            'success' => true,
            'message' => 'Events retrieved successfully.',
            'data' => EventResource::collection($events),
        ]);
    }

    /**
     * Create an event.
     */
    public function store(UpsertEventRequest $request): JsonResponse
    {
        $event = $this->upsert($request, new Event);
        return response()->json([
            'success' => true,
            'message' => 'Event created successfully.',
            'data' => EventResource::make($event),
        ], 201);
    }

    /**
     * Get a single event.
     */
    public function show(Event $event): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => 'Event retrieved successfully.',
            'data' => EventResource::make($event),
        ]);
    }

    /**
     * Update an event.
     */
    public function update(UpsertEventRequest $request, Event $event): JsonResponse
    {

        $event = $this->upsert($request, $event);
        return response()->json([
            'success' => true,
            'message' => 'Event updated successfully.',
            'data' => [],
        ]);
    }

    /**
     * Delete an event.
     */
    public function destroy(Event $event): JsonResponse
    {
        $event->delete();

        return response()->json([
            'success' => true,
            'message' => 'Event deleted successfully.',
        ]);
    }

    private function upsert(
        UpsertEventRequest $request,
        Event $event
    ):Event
    {
        $eventData = new EventData(...$request->validated());
        return UpsertEventAction::execute($eventData, $event);
    }
}