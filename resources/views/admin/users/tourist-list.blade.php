<div class="user-section">
    <h3 class="section-title">Tourists</h3>

    <div class="table-container">
        <table class="user-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Nationality</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tourists as $tourist)
                    <tr>
                        <td>{{ $tourist->user->name }}</td>
                        <td>{{ $tourist->user->email }}</td>
                        <td>{{ $tourist->nationality }}</td>
                        <td>
                            <form method="POST" action="{{ route('admin.deleteTourist', $tourist->user_id) }}">
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
