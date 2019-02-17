@extends('admin.templates.master' , [
	'title'        => 'List of Students',
	'voting_state' => getCurrentStateOfVote(),
	'admin'        => getAdminInfo()
])
@section('content')
<table class="table table-bordered">
	<thead>
		<tr>
			<th>Student ID</th>
			<th>Fullname</th>
			<th>Status</th>
		</tr>
	</thead>
	<tbody>

		@foreach ($students as $student)
			<tr>
				<th>{{ substr($student->student_id,0,2) }} - {{ substr($student->student_id,2,strlen($student->student_id-1)) }}</th>
				<td>{{ ucfirst($student->info->lastname) }}, {{ ucfirst($student->info->firstname) }} {{ ucfirst(substr($student->info->middlename,0,1)) }}.</td>
				@if ($student->student_vote->count() >= 1)
					<th class="text-success text-center">Already vote</th>
				@else
					<th class=""></th>
				@endif
			</tr>
		@endforeach

	</tbody>
</table>
@endsection
