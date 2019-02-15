<table>
	<thead>
		<tr>
			<th>Name</th>
			<th>Limit</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($positions as $position)
		<tr>
			<td>{{ $position->name }}</td>
			<td>{{ $position->limit }}</td>
			<td><a href="/admin/position/edit/{{ $position->id }}" >EDIT</a> | <a href="/admin/position/destroy/{{ $position->id }}">DELETE</a></td>
		</tr>
		@endforeach
	</tbody>
</table>
