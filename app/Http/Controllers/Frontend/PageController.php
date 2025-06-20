<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\EventRequestNotification;
use App\Models\Admin;
use App\Models\event;
use App\Models\organizer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class PageController extends Controller
{
    public function home()
    {
        return view('frontend.home');
    }
    public function request_event(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:organizers',
            'phone' => 'required|digits:10',
        ]);
        $organizer = new organizer();
        $organizer->name = $request->name;
        $organizer->email = $request->email;
        $organizer->phone = $request->phone;
        $organizer->password = Hash::make(uniqid());
        $imageData = [];
        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $file) {
                // Generate a unique filename
                $newName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                // Move the file to the 'public/images' directory
                $path = $file->store('images', 'public');
                $imageData[] = [
                    'path' => $path,
                    'filename' => $file->getClientOriginalName(),
                    'mime_type' => $file->getMimeType(),
                    'size' => $file->getSize(),
                    'uploaded_at' => now()->toDateTimeString(),
                ];
            }
            // Save image metadata as JSON in prev_images column
            $organizer->prev_images = json_encode($imageData);
        }
        $organizer->save();

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ];

        // $admins = Admin::all();
        Mail::to('sonumalmb@gmail.com')->send(new EventRequestNotification($data));

       $event = new event();
       $event->title = $request->title;
       $event->organizer_id = $organizer->id;
       $event->time = $request->time;
       $event->date = $request->date;
       $event->location = $request->location;
       $event->save();

        return redirect()->route('home');
    }
}
