<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\EventRequestNotification;
use App\Models\Admin;
use App\Models\Category;
use App\Models\event;
use App\Models\Organizer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\View;

class PageController extends Controller
{
    public function __construct()
    {

        $categories = Category::all();
        $latest_events = event::where('status', 'approved')->orderBy('id', 'desc')->limit(5)->get();
        View::share([
            'categories' => $categories,
            'latest_events' => $latest_events

        ]);
    }

    public function home()
    {
        $latest_events = event::where('status', 'approved')->orderBy('id', 'desc')->limit(5)->get();

        $categories = Category::all();
        return view('frontend.home', compact('categories', 'latest_events'));
    }

    public function request_event(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:organizers',
            'phone' => 'required|digits:10',
            "categories" => "required",
            'title' => 'required',
            'location' => 'required',
            'date' => 'required',
            'time' => 'required',

        ]);
        $organizer = new Organizer();
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
        $event->fees = $request->fees;
        $event->location = $request->location;
        $event->save();

        $event->categories()->attach($request->categories);

        toast("Your request is submitted sucessfully", "success");
        return redirect()->route('home');
    }

    public function event($id)
    {
        $event = event::find($id);
        $organizer = $event->organizer;
        $categoryIds = $event->categories->pluck('id');
        $relatedEvents = Event::where('id', '!=', $event->id)
                        ->where('status', 'approved')
                        ->whereHas('categories', function ($query) use ($categoryIds) {
                            $query->whereIn('category_id', $categoryIds);
                        })
                        ->limit(5)
                        ->get();
        return view('frontend.event',compact('event','organizer','relatedEvents'));
    }
    public function category($slug)
    {
        $category= Category::where('slug',$slug)->first();
        $categoryevents= $category->events()->paginate(8);
        return view('frontend.category',compact('categoryevents','category'));
    }
    public function notFound(){
        return view('frontend.404error');
    }
    public function compare(Request $request){
        $q = $request->q;
        $results = event::where('title','like',"%$q%")->OrderBy('date','desc')->get();
        return view('frontend.compare',compact('results','q'));
    }
}
