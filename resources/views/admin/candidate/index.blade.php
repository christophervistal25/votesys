<table>
	<thead>
		<tr>
			<th>Fullname</th>
			<th>Running for</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($candidates as $candidate)
		<tr>
        <td>{{ucfirst($candidate->studentInfo->lastname) }} , {{ucfirst($candidate->studentInfo->firstname)}} {{ucfirst(substr($candidate->studentInfo->middlename,0,1))}}.</td>
        <td>{{ucfirst($candidate->position['name'])}}</td>
		</tr>
		@endforeach
	</tbody>
</table>
