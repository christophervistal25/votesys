<?php

namespace App\Http\Middleware;
use App\Repositories\StudentRepository;
use App\Repositories\StudentVoteRepository;
use Closure;

class IsStudentCanVote
{

    public function __construct(StudentVoteRepository $studentVoteRepo , StudentRepository $studentRepo)
    {
        $this->studentVoteRepo = $studentVoteRepo;
        $this->studentRepository = $studentRepo;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $isVoterReachTheLimitForPosition = $this->studentVoteRepo
                                            ->isVoterReachTheLimitForPosition($this->studentRepository,$request->all());
        if ($isVoterReachTheLimitForPosition) {
            return $next($request);
        } else {
            return response()->json(['message' => 'Sorry, but you already vote to other candidate within this position.']);
        }

    }
}
