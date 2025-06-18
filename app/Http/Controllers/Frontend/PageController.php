<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\organizer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
        return redirect()->route('home');
    }
}
