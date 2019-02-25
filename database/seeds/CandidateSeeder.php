<?php

use App\Candidate;
use Illuminate\Database\Seeder;

class CandidateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Candidate::create([
        	'student_id' => 1501755,
        	'position_id' => 1,
        	'platforms' => 'Free wifi',
        ]);

        Candidate::create([
        	'student_id' => 1501756,
        	'position_id' => 2,
        	'platforms' => 'Free wifi',
        ]);

        Candidate::create([
        	'student_id' => 1501757,
        	'position_id' => 2,
        	'platforms' => 'Free wifi',
        ]);

        Candidate::create([
            'student_id' => 1501758,
            'position_id' => 2,
            'platforms' => 'Free wifi',
        ]);
    }
}
