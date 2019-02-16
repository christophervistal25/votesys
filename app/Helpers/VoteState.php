<?php
use App\VoteStatus;

function getCurrentStateOfVote()
{
	return VoteStatus::first()->status;
}
