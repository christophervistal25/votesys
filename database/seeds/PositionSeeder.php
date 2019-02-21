<?php

use App\Position;
use Illuminate\Database\Seeder;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Position::create([
			'name'             => 'Governor',
			'limit'            => 2,
			'student_can_vote' => 1
        ]);

        Position::create([
			'name'             => 'Senator',
			'limit'            => 3,
			'student_can_vote' => 2
        ]);
    }
}
