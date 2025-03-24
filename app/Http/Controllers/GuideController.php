<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Guide;
use App\Models\Tour;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;


class GuideController extends Controller
{
    public function profile() {
    {
        $user = Auth::user();
        $guide = $user->guide;

        return view('guide.profile', compact('user', 'guide'));
    }
    }

    public function updateProfile(Request $request)
{
    $user = Auth::user();
    $guide = Guide::where('user_id', $user->id)->first();

    // Validate form data
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email',
        'password' => 'nullable|string|min:8|confirmed',
        'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'certification' => 'nullable|string',
        'experience' => 'nullable|string',
        'specialties' => 'nullable|string'
    ]);

    // Update user
    $user->name = $request->name;
    $user->email = $request->email;
    if ($request->filled('password')) {
        $user->password = Hash::make($request->password);
    }

    // Update profile picture if uploaded
    if ($request->hasFile('profile_picture')) {
        $path = $request->file('profile_picture')->store('guide_images', 'public');
        $guide->profile_picture = $path;
    }

    // Update guide details
    $guide->certification = $request->certification;
    $guide->experience = $request->experience;
    $guide->specialties = $request->specialties;

    $user->save();
    $guide->save();

    return redirect()->route('guide.profile')->with('status', 'Profile updated successfully.');
}

    public function notifications() {
        return view('guide.notifications');
    }

    public function ongoingTours() {
        return view('guide.ongoing-tours');
    }

    public function canceledTours() {
        return view('guide.canceled-tours');
    }

    public function travelHistory() {
        return view('guide.travel-history');
    }

    public function revenue() {
        return view('guide.revenue');
    }

    public function support() {
        return view('guide.support');
    }

    
public function myTours()
{
    $tours = Tour::where('guide_id', Auth::user()->guide->id)->get();
    return view('guide.tours.index', compact('tours'));
}

public function createTour()
{
    return view('guide.tours.create');
}


/*=======================================*/ 

public function storeTour(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'details' => 'nullable|string',
        'duration' => 'required|string',
        'amount' => 'required|numeric',
        'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $picturePath = null;
    if ($request->hasFile('picture')) {
        $picturePath = $request->file('picture')->store('tour_images', 'public');
    }

    Tour::create([
        'guide_id' => Auth::user()->guide->id,
        'name' => $request->name,
        'details' => $request->details,
        'duration' => $request->duration,
        'amount' => $request->amount,
        'picture' => $picturePath,
    ]);

    return redirect()->route('guide.tours')->with('success', 'Tour created successfully!');
}





  // Show all tours created by the logged-in guide
  public function index()
  {
      $tours = Tour::where('guide_id', Auth::id())->get();
      return view('guide.tours.index', compact('tours'));
  }

  // Show create tour form
  public function create()
  {
      return view('guide.tours.create');
  }

  // Handle tour creation
  public function store(Request $request)
  {
      $request->validate([
          'name' => 'required|string|max:255',
          'details' => 'required|string',
          'duration' => 'required|string|max:50',
          'amount' => 'required|numeric|min:0',
          'picture' => 'required|image|mimes:jpg,png,jpeg|max:2048',
      ]);

      $imagePath = $request->file('picture')->store('tour_images', 'public');

      Tour::create([
          'guide_id' => Auth::id(),
          'name' => $request->name,
          'details' => $request->details,
          'duration' => $request->duration,
          'amount' => $request->amount,
          'picture' => $imagePath,
      ]);

      return redirect()->route('guide.tours.index')->with('success', 'Tour created successfully!');
  }


}
