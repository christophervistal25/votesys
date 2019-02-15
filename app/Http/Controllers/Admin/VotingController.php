<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Candidate;

class VotingController extends Controller
{
    public function index()
    {
        $candidates = Candidate::with('votes')->get();
        return view('admin.voting.index',compact('candidates'));
    }
}
