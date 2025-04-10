<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Guide;
use App\Models\Tour;

class TouristController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();

        // Load bookings by status (for dashboard display)
        $pending = $user->bookings()->where('status', 'Pending')->get();
        $scheduled = $user->bookings()->where('status', 'Scheduled')->get();
        $ongoing = $user->bookings()->where('status', 'Ongoing')->get();
        $completed = $user->bookings()->where('status', 'Completed')->get();

        return view('tourist.dashboard', compact('pending', 'scheduled', 'ongoing', 'completed'));
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
        return view('tourist.book', compact('tour'));
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

        return redirect()->route('tourist.dashboard')->with('success', 'Booking request sent!');
    }

    public function locationSelection()
    {
        $locations = ['Kandy', 'Galle', 'Trincomalee', 'Badulla', 'Dambulla', 'Nuwara Eliya'];
        return view('pages.locations', compact('locations'));
    }
    

}
