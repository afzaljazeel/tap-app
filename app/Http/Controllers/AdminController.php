<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Guide;
use App\Models\Tourist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class AdminController extends Controller
{
    public function dashboard() {
        return view('admin.dashboard');
    }

    public function manageUsers() {
        return view('admin.users.users'); // ✅ loads the tab view
    }

    // 📌 LOAD GUIDES
    public function getGuides() {
        $guides = Guide::with('user')->get();
        return view('admin.users.guide-list', compact('guides'));
    }

    // 📌 ADD GUIDE
    public function addGuide(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'guide',
        ]);

        Guide::create([
            'user_id' => $user->id,
            'experience' => $request->experience,
            'certification' => $request->certification,
            'specialties' => json_encode($request->specialties),
        ]);

        if ($request->expectsJson()) {
            return response()->json(['message' => 'Guide added successfully']);
        } else {
            return redirect()->route('admin.guides')->with('success', 'Guide added successfully');
        }
    }

    // 📌 DELETE GUIDE
    public function deleteGuide($id) {
        $user = User::where('id', $id)->where('role', 'guide')->firstOrFail();
        $user->delete();
        Guide::where('user_id', $id)->delete();

        return response()->json(['message' => 'Guide removed successfully']);
    }

    // 📌 LOAD TOURISTS
    public function getTourists() {
        $tourists = Tourist::with('user')->get();
        return view('admin.users.tourist-list', compact('tourists'));
    }

    // 📌 DELETE TOURIST
    public function deleteTourist($id) {
        $user = User::where('id', $id)->where('role', 'tourist')->firstOrFail();
        $user->delete();
        Tourist::where('user_id', $id)->delete();

        return response()->json(['message' => 'Tourist removed successfully']);
    }
    // 📌 COUNT GUIDES
    public function getGuideCount()
{
    $total = \App\Models\Guide::count();
    return response()->json(['total' => $total]);
}
 
  // 📌 COUNT TOURISTS
public function getTouristCount()
{
    $total = \App\Models\Tourist::count();
    return response()->json(['total' => $total]);
}

}
