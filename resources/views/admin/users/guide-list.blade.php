<div class="user-section">



<h3>Guides</h3>

<!-- Add Guide Button -->
<button onclick="document.getElementById('add-guide-form').style.display = 'block';">+ Add Guide</button>

<!-- Add Guide Form -->
<div id="add-guide-form" style="display: none; margin-top: 20px;">
<form method="POST" action="{{ route('admin.addGuide') }}" enctype="multipart/form-data">

    @csrf
    <input type="text" name="name" placeholder="Guide Name" required>
    <input type="email" name="email" placeholder="Guide Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <input type="password" name="password_confirmation" placeholder="Confirm Password" required>
    <input type="file" name="profile_picture" accept="image/*" required>
    <input type="text" name="location" placeholder="Location" required>
    <button type="submit">Add Guide</button>
    </form>
</div>

{{-- ✅ Flash Success Message --}}
    @if (session('success'))
        <div style="background-color: #d4edda; color: #155724; padding: 12px 20px; border-radius: 6px; margin-bottom: 20px; border: 1px solid #c3e6cb;">
            {{ session('success') }}
        </div>
    @endif

<!-- Guides Table -->
<table style="margin-top: 20px;">
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Location</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($guides as $guide)
            <tr>
                <td>{{ $guide->user->name }}</td>
                <td>{{ $guide->user->email }}</td>
                <td>{{ $guide->location }}</td>
                <td>
                    <form method="POST" action="{{ route('admin.deleteGuide', $guide->user_id) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Remove</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
</div>