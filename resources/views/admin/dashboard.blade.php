@if (!$current_state_of_voting)
	<a href="/admin/candidate/create">Add new candidate</a>
	<br>
	<a href="/admin/candidates">Candidates</a>
	<br>
	<a href="/admin/position/create">Add new position</a>
	<br>
	<a href="/admin/positions">Positions</a>
	<br>
	<a href="/admin/voting">View</a>
	<br>
	<form method="POST" >
		<input type="submit" value="Start vote">
	</form>
@endif
<p>Vote status : {{ (!$current_state_of_voting) ? 'Closed' : 'Open'  }}</p>
