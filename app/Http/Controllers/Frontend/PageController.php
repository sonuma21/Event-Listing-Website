<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\EventRequestNotification;
use App\Models\Admin;
use App\Models\CarouselImage;
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
        $carousels = CarouselImage::all();
        $categories = Category::all();
        return view('frontend.home', compact('categories', 'latest_events', 'carousels'));
    }

    public function request_event(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|regex:/^[A-Za-z][A-Za-z\s]*$/',
                'email' => 'required|email|unique:organizers|regex:/^.+@gmail\.com$/',
                'phone' => 'required|digits:10|regex:/^98[0-9]{8}$/',
                'categories' => 'required|array|min:1|exists:categories,id', // Assuming categories table has 'id' column
                'categories.*' => 'integer', // Ensure each category ID is an integer
                'title' => 'required|string|max:255',
                'location' => 'required|string|max:255',
                'date' => 'required|date|after_or_equal:today',
                'time' => 'required',
                'fees' => 'sometimes|required|numeric|min:0',

            ],
            [
                'name.required' => 'Name is required.',
                'name.regex' => 'Name must start with an alphabet letter and contain only letters and spaces.',
                'email.required' => 'Email is required.',
                'email.email' => 'Please enter a valid email address.',
                'email.unique' => 'This email is already registered.',
                'email.regex' => 'Email must be a Gmail address (e.g., example@gmail.com).',
                'phone.required' => 'Phone number is required.',
                'phone.digits' => 'Phone number must be exactly 10 digits.',
                'phone.regex' => 'Phone number must start with 98 followed by 8 digits (Nepali mobile format).',
                'categories.required' => 'At least one category must be selected.',
                'categories.min' => 'At least one category must be selected.',
                'categories.exists' => 'One or more selected categories are invalid.',
                'title.required' => 'Event title is required.',
                'location.required' => 'Event location is required.',
                'date.required' => 'Event date is required.',
                'date.date' => 'Please enter a valid date.',
                'date.after_or_equal' => 'Event date must be today or in the future.',
                'time.required' => 'Event time is required.',
                'fees.required' => 'Event fees are required when fees option is selected.',
                'fees.numeric' => 'Fees must be a valid number.',
                'fees.min' => 'Fees cannot be negative.',
            ]
        );
        // Conditional validation for fees based on request input (if not using JS fully)
        if ($request->input('feesOption') === 'required' && !$request->has('fees')) {
            return back()->withErrors(['fees' => 'Event fees are required when fees option is selected.'])->withInput();
        }
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
        return view('frontend.event', compact('event', 'organizer', 'relatedEvents'));
    }
    public function category($slug)
    {
        $category = Category::where('slug', $slug)->first();
        $categoryevents = $category->events()->paginate(8);
        return view('frontend.category', compact('categoryevents', 'category'));
    }
    public function notFound()
    {
        return view('frontend.404error');
    }
    public function compare(Request $request)
    {
        $q = $request->q;
        $results = event::where('title', 'like', "%$q%")->OrderBy('date', 'desc')->get();
        return view('frontend.compare', compact('results', 'q'));
    }
    public function events()
    {
        $events = event::where('status', 'approved')->orderBy('id', 'desc')->paginate(12);
        return view('frontend.all', compact('events'));
    }
    public function about()
    {
        return view('frontend.about');
    }
    public function contact()
    {
        return view('frontend.contact');
    }
}
