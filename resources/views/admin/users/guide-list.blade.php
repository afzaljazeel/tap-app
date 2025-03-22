<h3>Guides</h3>

<!-- Add Guide Button -->
<button onclick="document.getElementById('add-guide-form').style.display = 'block';">+ Add Guide</button>

<!-- Add Guide Form -->
<div id="add-guide-form" style="display: none; margin-top: 20px;">
    <form method="POST" action="{{ route('admin.addGuide') }}">
        @csrf
        <input type="text" name="name" placeholder="Guide Name" required>
        <input type="email" name="email" placeholder="Guide Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="password" name="password_confirmation" placeholder="Confirm Password" required>
        <input type="text" name="experience" placeholder="Years of Experience">
        <input type="text" name="certification" placeholder="Certification">
        <button type="submit">Add Guide</button>
    </form>
</div>

<!-- Guides Table -->
<table style="margin-top: 20px;">
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Experience</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($guides as $guide)
            <tr>
                <td>{{ $guide->user->name }}</td>
                <td>{{ $guide->user->email }}</td>
                <td>{{ $guide->experience }}</td>
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
