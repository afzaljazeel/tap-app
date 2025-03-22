<h3>Tourists</h3>

<table>
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
                        <button type="submit">Remove</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
