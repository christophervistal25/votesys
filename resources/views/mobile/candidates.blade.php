<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" />
<ul data-role="listview" data-inset="true">
	@foreach ($candidatesForThePosition as $candidate)
	<li id="candidate" candidate-id="{{ $candidate->id }}" candidate-name="{{ $candidate->studentInfo->firstname . ' ' . $candidate->studentInfo->lastname }}"><a >
		<img src="{{ URL::asset('images/no_image.png') }}">
		<h2>{{ $candidate->studentInfo->firstname . ' ' .  $candidate->studentInfo->lastname }}</h2>
		<p>{{ $candidate->platforms }}</p></a>
	</li>
	@endforeach
</ul>

<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
<script>
	$(document).on('click','#candidate' , function() {
		var candidateId = $(this).attr('candidate-id');
		var confirmVote = confirm('Do you want to vote ' + $(this).attr('candidate-name'));
		if(confirmVote) {
		$.ajax({
			  type: "POST",
			  url: "/api/student/vote?student_id=" + {{ $voter_student_id }} + "&candidate_id="+candidateId,
			  success: function (data) {
			  		alert('Successfully vote');
			  }
			});
		} else {
			alert('Please vote wisely.');
		}
	});
</script>
