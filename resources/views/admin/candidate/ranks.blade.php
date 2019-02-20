@extends('admin.templates.master' , [
'title'        => 'Ranks of all Candidates',
'voting_state' => getCurrentStateOfVote(),
'admin'        => getAdminInfo()
])
@section('content')
	@foreach ($candidates as $candidate_position => $candidate)
		<h1>{{ $positions[$candidate_position-1]->name }}</h1>
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>Name</th>
						<th>No. of votes</th>
					</tr>
				</thead>
				@foreach ($candidate as $student)
				<tr>
					<th>{{ $student->studentInfo->lastname }} , {{ $student->studentInfo->firstname }} {{ substr($student->studentInfo->middlename,0,1) }}.</th>
					@if ($student->votes->count() === 0)
					<th class="text-center text-danger">No Votes</th>
					@else
					<th class="text-center">{{ $student->votes->count() }}</th>
					@endif
				</tr>
				@endforeach
			</tbody>
			</table>
	@endforeach
@endsection
