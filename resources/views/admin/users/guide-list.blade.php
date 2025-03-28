<div class="user-section">
    <h3 class="section-title">Guides</h3>

    <!-- Add Guide Button -->
    <button class="add-guide-btn" onclick="document.getElementById('add-guide-form').style.display = 'block';">
        + Add Guide
    </button>

    <!-- Add Guide Form -->
    <div id="add-guide-form" class="add-form" style="display: none;">
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

    @if (session('success'))
        <div class="success-alert">
            {{ session('success') }}
        </div>
    @endif

    <!-- Guides Table -->
    <div class="table-container">
        <table class="user-table">
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
                                <button type="submit" class="remove-btn">Remove</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
