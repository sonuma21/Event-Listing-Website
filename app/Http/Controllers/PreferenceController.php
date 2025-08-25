<?php

namespace App\Http\Controllers;

use App\Models\UserPreference;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PreferenceController extends Controller {

    public function edit() {
        $categories = [
            'culture' => 'Culture',
            'sports' => 'Sports',
            'tech' => 'Technology',
            'art' => 'Art',
        ]; // Adjust categories to match events
        $userPreferences = Auth::user()->preferences->pluck('category')->toArray();
        return view('preference.edit', compact('categories', 'userPreferences'));
    }

    public function store(Request $request) {

        $user =  Auth::user();
        dd($user);
        $user->preferences()->delete();
        foreach ($request->categories as $category) {
            $user->preferences()->create([
                'category' => $category,
                'weight' => 1.0,
            ]);
        }

        return redirect()->route('recommendations');
    }
}
