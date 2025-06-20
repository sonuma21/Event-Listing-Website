<?php

namespace App\Observers;

use App\Mail\EventApprovedNotification;
use App\Models\Event;
use App\Models\Organizer;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;

class EventObserver
{
    /**
     * Handle the Event "created" event.
     */
    public function created(Event $event): void
    {
        //
    }

    /**
     * Handle the Event "updated" event.
     */
    public function updated(Event $event): void
    {
        if ($event->isDirty('status') && $event->status == 1) {
            $organizer = $event->organizer;

            $data = [
                'organizer_name' => $organizer->name,
                'organizer_email' => $organizer->email,
                'event_title' => $event->title,
                'event_date' => (new \DateTime($event->date))->format('Y-m-d'),
                'event_time' => $event->time,
                'event_location' => $event->location,
                'password' => null,
            ];
            if (count($organizer->events)==1) {
                if ($organizer) {
                    $password = rand(1111, 9999);
                    $organizer->password = Hash::make($password);
                    $organizer->saveQuietly();

                    $data = [
                        'organizer_name' => $organizer->name,
                        'organizer_email' => $organizer->email,
                        'event_title' => $event->title,
                        'event_date' => (new \DateTime($event->date))->format('Y-m-d'),
                        'event_time' => $event->time,
                        'event_location' => $event->location,
                        'password' => $password,
                    ];
                }
            }
            Mail::to($organizer->email)->send(new EventApprovedNotification($data));
        }
    }


    /**
     * Handle the Event "deleted" event.
     */
    public function deleted(Event $event): void
    {
        //
    }

    /**
     * Handle the Event "restored" event.
     */
    public function restored(Event $event): void
    {
        //
    }

    /**
     * Handle the Event "force deleted" event.
     */
    public function forceDeleted(Event $event): void
    {
        //
    }
}
