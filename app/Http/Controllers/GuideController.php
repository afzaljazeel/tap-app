<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Guide;
use App\Models\Tour;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\Booking;
use Carbon\Carbon;
use App\Models\Revenue;




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
        $guide = auth()->user()->guide;
        $bookings = $guide->bookings()->with(['tour', 'tourist'])->where('status', 'Pending')->orderBy('created_at', 'desc')->get();
    
        return view('guide.notifications', compact('bookings'));
    
    }

    public function ongoingTours() {
        return view('guide.ongoing-tours');
    }

    public function canceledTours() {
        $cancelled = Booking::with('tour', 'tourist')
            ->where('guide_id', Auth::user()->guide->id)
            ->where('status', 'Cancelled')
            ->orderByDesc('date')
            ->get();

        return view('guide.canceled-tours', compact('cancelled'));
    }

    public function travelHistory() {
        $completed = Booking::with('tour', 'tourist')
            ->where('guide_id', Auth::user()->guide->id)
            ->where('status', 'Completed')
            ->orderByDesc('date')
            ->get();

        return view('guide.travel-history', compact('completed'));
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

public function showAllGuides()
{
    // Fetch all guides from the database
    $guides = Guide::all();
    
    // Return the view with the guides data
    return view('pages.guides', compact('guides'));

}

// app/Http/Controllers/GuideController.php
public function show($id) {
    // Retrieve the guide by ID along with the associated user
    $guide = Guide::with('user')->findOrFail($id);

    // Pass the guide to the profile view
    return view('pages.profile', compact('guide'));
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



  // Bookings

    public function approveBooking($id)
    {
        $booking = Booking::findOrFail($id);

        if ($booking->guide_id !== Auth::user()->guide->id) {
            abort(403); // Unauthorized
        }

        $booking->status = 'Scheduled';
        $booking->save();

       return back()->with('success', 'Booking approved successfully.');

    }

    public function declineBooking(Request $request, $id)
    {
        $request->validate([
            'reason' => 'required|string|max:255',
        ]);

        $booking = Booking::findOrFail($id);

        if ($booking->guide_id !== Auth::user()->guide->id) {
            abort(403); // Unauthorized
        }

        $booking->status = 'Cancelled';
        $booking->notes = 'Declined: ' . $request->reason;
        $booking->save();

      return back()->with('error', 'Booking declined.');

    }

    
    public function calendar()
    {
        $guideId = Auth::user()->guide->id;
    
        $scheduled = Booking::with('tour', 'tourist')
            ->where('guide_id', $guideId)
            ->where('status', 'Scheduled')
            ->orderBy('date')
            ->get();
    
        $ongoing = Booking::with('tour', 'tourist')
            ->where('guide_id', $guideId)
            ->where('status', 'Ongoing')
            ->orderBy('date')
            ->get();
    
        $completed = Booking::with('tour', 'tourist')
            ->where('guide_id', $guideId)
            ->where('status', 'Completed')
            ->orderBy('date')
            ->get();
    
        $cancelled = Booking::with('tour', 'tourist')
            ->where('guide_id', $guideId)
            ->where('status', 'Cancelled')
            ->orderBy('date')
            ->get();
    
        return view('guide.calendar', compact('scheduled', 'ongoing', 'completed', 'cancelled'));
    }

    
        public function startTour($id)
        {
            $booking = Booking::findOrFail($id);

            // Ensure the guide owns the booking
            if ($booking->guide_id !== Auth::user()->guide->id) {
                abort(403);
            }

            // Ensure the booking is scheduled and for today or earlier
            if ($booking->status !== 'Scheduled') {
                return back()->with('error', 'Only scheduled bookings can be started.');
            }

            if (\Carbon\Carbon::parse($booking->date)->isFuture()) {
                return back()->with('error', 'You can only start tours on the booking day.');
            }

            // Update status
            $booking->status = 'Ongoing';
            $booking->save();

            return back()->with('success', 'Tour marked as ongoing.');
        }

        public function completeTour($id)
        {
            $booking = Booking::with(['tour', 'guide', 'tourist'])->findOrFail($id);

            if ($booking->guide_id !== Auth::user()->guide->id) {
                abort(403);
            }

            if ($booking->status !== 'Ongoing') {
                return back()->with('error', 'Only ongoing bookings can be marked as completed.');
            }

            // Update booking status
            $booking->status = 'Completed';
            $booking->save();

            // Calculate revenue details
            $income = $booking->tour->amount;
            $commissionRate = 0.12; // 10% platform fee — change if needed
            $commission = round($income * $commissionRate, 2);
            $guidePayment = $income - $commission;

            // Save revenue record
            Revenue::create([
                'booking_id'    => $booking->id,
                'tour_id'       => $booking->tour_id,
                'guide_id'      => $booking->guide_id,
                'tourist_id'    => $booking->tourist_id,
                'date'          => Carbon::now()->toDateString(),
                'income'        => $income,
                'commission'    => $commission,
                'guide_payment' => $guidePayment,
            ]);

            return back()->with('success', 'Tour marked as completed and revenue recorded.');
        }
        // Show revenue details
       public function revenue(Request $request)
        {
            $guideId = Auth::user()->guide->id;

            $months = Revenue::where('guide_id', $guideId)
                ->selectRaw('DATE_FORMAT(date, "%Y-%m-01") as month')
                ->distinct()
                ->pluck('month')
                ->sortDesc();

            $selectedMonth = $request->query('month') ?? Carbon::now()->startOfMonth()->toDateString();

            $revenues = Revenue::where('guide_id', $guideId)
                ->whereBetween('date', [
                    Carbon::parse($selectedMonth)->startOfMonth(),
                    Carbon::parse($selectedMonth)->endOfMonth()
                ])
                ->orderBy('date', 'desc')
                ->get();

            return view('guide.revenue', [
                'revenues' => $revenues,
                'months' => $months,
                'selectedMonth' => $selectedMonth,
                'totalIncome' => $revenues->sum('income'),
                'totalCommission' => $revenues->sum('commission'),
                'totalGuidePayment' => $revenues->sum('guide_payment'),
            ]);
        }


        //dahsboard method

       
        public function dashboard()
{
    $guide = auth()->user()->guide;

    $newRequests = $guide->bookings()->where('status', 'Pending')->get();

    $completedTours = $guide->bookings()->where('status', 'Completed')->get();

    $upcomingTours = $guide->bookings()
        ->where('status', 'Scheduled')
        ->whereDate('date', '>=', Carbon::today())
        ->get();

    $ongoingTour = $guide->bookings()
        ->where('status', 'Ongoing')
        ->orderBy('date')
        ->first();

    // Enhanced "next24hrs" to consider preferred_time and time of day
    $next24hrs = $guide->bookings()
        ->where('status', 'Scheduled')
        ->whereDate('date', Carbon::today())
        ->get()
        ->filter(function ($booking) {
            $hour = now()->hour;

            return match ($booking->preferred_time) {
                'Morning' => $hour < 8,
                'Evening' => $hour < 14,
                'Night'   => $hour < 19,
                default   => false,
            };
        });

    $earnedThisMonth = Revenue::where('guide_id', $guide->id)
        ->whereBetween('date', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])
        ->sum('guide_payment');

    return view('guide.dashboard', compact(
        'newRequests',
        'completedTours',
        'upcomingTours',
        'ongoingTour',
        'next24hrs',
        'earnedThisMonth'
    ));
}

        public function viewPublicProfile($id)
{
    $guide = Guide::with('user')->findOrFail($id);
    return view('guide.public-profile', compact('guide'));
}


}