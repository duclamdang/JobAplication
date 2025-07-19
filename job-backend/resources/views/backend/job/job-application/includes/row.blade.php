<tr>
    <td>{{ $row->user->name ?? 'N/A' }}</td>
    <td>{{ $row->job->title ?? 'N/A' }}</td>
    <td>{{ $row->created_at->format('d/m/Y H:i') }}</td>
    <td>
        <a href="{{ route('admin.auth.user.show', $row->user_id) }}" class="btn btn-info btn-sm">
            <i class="fas fa-search"></i> View
        </a>
    </td>
</tr>
