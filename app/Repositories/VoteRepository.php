<?php

namespace App\Repositories;
use App\Repositories\CandidateRepository;
use App\Vote;
use Illuminate\Support\Facades\DB;

class VoteRepository
{
    public function __construct(Vote $vote)
    {
        $this->vote = $vote;
    }

    /**
     * [getRecordGreaterThan get the newest record]
     * @param  string $date_time [description]
     * @return [type]            [description]
     */
    public function getRecordGreaterThan($date_time = null)
    {
        if ($date_time != null) {
            return DB::table('student_vote')
                             ->where('created_at', '>', $date_time)
                             ->get();
        } else {
            return;
        }

    }

    /**
     * [getLastRecord Get the last record of all votes]
     * @param  array  $column_fetch [description]
     * @return [type]               [description]
     */
    public function getLastRecord(array $column_fetch = ['*'])
    {
        return DB::table('student_vote')
                             ->orderBy('created_at','desc')
                             ->first($column_fetch);
    }
}
