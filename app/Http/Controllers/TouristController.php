<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Guide;
use App\Models\Tour;
use Illuminate\Support\Facades\Hash;

class TouristController extends Controller
{
    public function dashboard()
    {
        $userId = auth()->id();
    
        $pending = Booking::where('tourist_id', $userId)->where('status', 'Pending')->get();
        $scheduled = Booking::where('tourist_id', $userId)->where('status', 'Scheduled')->get();
        $ongoing = Booking::where('tourist_id', $userId)->where('status', 'Ongoing')->get();
        $completed = Booking::where('tourist_id', $userId)->where('status', 'Completed')->get();
        $cancelled = Booking::where('tourist_id', $userId)->where('status', 'Cancelled')->get();
        $recentBookings = Booking::where('tourist_id', $userId)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
    
            return view('tourist.dashboard', compact('pending', 'scheduled', 'ongoing', 'completed', 'cancelled', 'recentBookings'));

    }

    //booking
        
    public function locations()
    {
        $locations = Guide::select('location')->distinct()->pluck('location');
        return view('tourist.locations', compact('locations'));
    }

    public function guidesByLocation($location)
    {
        $guides = Guide::with('user')->where('location', $location)->get();
        return view('tourist.guides', compact('guides', 'location'));
    }

    public function viewGuideTours($id)
    {
        $guide = Guide::with('user')->findOrFail($id);
        $tours = $guide->tours;
        return view('tourist.tours', compact('guide', 'tours'));
    }

    
    public function bookForm($id)
    {
        $tour = Tour::with('guide.user')->findOrFail($id);

        // Get all bookings for this guide with future or today dates (not cancelled)
        $bookings = \App\Models\Booking::where('guide_id', $tour->guide_id)
            ->whereIn('status', ['Pending', 'Scheduled', 'Ongoing'])
            ->where('date', '>=', now()->toDateString())
            ->get(['date', 'preferred_time']);

        // Group like ['2025-05-10' => ['Morning', 'Evening']]
        $bookedSlots = [];
        foreach ($bookings as $b) {
            $bookedSlots[$b->date][] = $b->preferred_time;
        }

        return view('tourist.book', compact('tour', 'bookedSlots'));
    }

    public function submitBooking(Request $request, $id)
    {
        $request->validate([
            'date' => 'required|date|after_or_equal:today',
            'preferred_time' => 'required|in:Morning,Evening,Night',
            'notes' => 'nullable|string|max:500',
        ]);

        $tour = Tour::findOrFail($id);
        Booking::create([
            'tour_id' => $tour->id,
            'guide_id' => $tour->guide_id,
            'tourist_id' => auth()->id(),
            'preferred_time' => $request->preferred_time,
            'date' => $request->date,
            'status' => 'Pending',
            'notes' => $request->notes,
        ]);

        return redirect()->route('tourist.mybookings')->with('success', 'Your booking request has been sent!');
    }

    public function locationSelection()
    {
        $locations = ['Kandy', 'Galle', 'Trincomalee', 'Badulla', 'Dambulla', 'Nuwara Eliya'];
        return view('pages.locations', compact('locations'));
    }
    
    //profile//

    public function editProfile()
    {
        $user = Auth::user();
        $tourist = $user->tourist;
    
        if (!$tourist) {
            $tourist = \App\Models\Tourist::create([
                'user_id' => $user->id,
                'nationality' => '',
                'phone' => '',
                'extra_notes' => '',
            ]);
        }
    
        return view('tourist.profile', compact('user', 'tourist'));
    }

public function updateProfile(Request $request)
{
    $user = Auth::user();
    $tourist = $user->tourist;

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email',
        'password' => 'nullable|string|min:8|confirmed',
        'nationality' => 'nullable|string|max:255',
        'phone' => 'nullable|string|max:20',
        'extra_notes' => 'nullable|string|max:500',
    ]);

    // Update user
    $user->name = $request->name;
    $user->email = $request->email;
    if ($request->filled('password')) {
        $user->password = Hash::make($request->password);
    }
    $user->save();

    // Update tourist info
    $tourist->nationality = $request->nationality;
    $tourist->phone = $request->phone;
    $tourist->extra_notes = $request->extra_notes;
    $tourist->save();

    return redirect()->route('profile.edit')->with('status', 'Profile updated successfully.');
}

public function myBookings()
{
    $bookings = Booking::where('tourist_id', auth()->user()->id)->latest()->get();

    return view('tourist.mybookings', compact('bookings'));
}


public function tourHistory()
{
    $userId = auth()->id();

    $completed = Booking::where('tourist_id', $userId)
        ->where('status', 'Completed')
        ->orderBy('date', 'desc')
        ->get();

    $cancelled = Booking::where('tourist_id', $userId)
        ->where('status', 'Cancelled')
        ->orderBy('date', 'desc')
        ->get();

    return view('tourist.tour-history', compact('completed', 'cancelled'));
}


}
