<?php

namespace App\Http\Middleware;

use App\Repositories\CandidateRepository;
use Closure;
class IsThereCandidate
{

    public function __construct(CandidateRepository $candidateRepository)
    {
        $this->candidateRepository = $candidateRepository;
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
        if ($this->candidateRepository->isThereAnyCandidate()) {
            return $next($request);
        } else {
            return redirect()->route('admin.dashboard');
        }
    }
}
