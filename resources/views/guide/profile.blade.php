@extends('layouts.guide')

@section('content')
<div class="guide-profile-section">
    <h2>My Profile</h2>

    <form method="POST" action="{{ route('guide.profile.update') }}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <!-- User Details -->
        <div class="form-row">
            <label for="name">Full Name</label>
            <input type="text" name="name" id="name" value="{{ Auth::user()->name }}" required>
        </div>

        <div class="form-row">
            <label for="email">Email Address</label>
            <input type="email" name="email" id="email" value="{{ Auth::user()->email }}" required>
        </div>

        <div class="form-row">
            <label for="password">New Password <small>(leave blank to keep current)</small></label>
            <input type="password" name="password" id="password">
        </div>

        <div class="form-row">
            <label for="password_confirmation">Confirm Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation">
        </div>

        <div class="form-row">
            <label for="profile_picture">Profile Picture</label>
            <input type="file" name="profile_picture" id="profile_picture" accept="image/*">
        </div>

        <hr>

        <!-- Guide-Specific Details -->
        <div class="form-row">
            <label for="certification">Certification</label>
            <input type="text" name="certification" id="certification" value="{{ $guide->certification }}">
        </div>

        <div class="form-row">
            <label for="experience">Experience (years)</label>
            <input type="text" name="experience" id="experience" value="{{ $guide->experience }}">
        </div>

        <div class="form-row">
            <label for="specialties">Specialties (comma separated)</label>
            <input type="text" name="specialties" id="specialties" value="{{ $guide->specialties }}">
        </div>

        <button type="submit" class="save-btn">Update Profile</button>
    </form>
</div>
@endsection
