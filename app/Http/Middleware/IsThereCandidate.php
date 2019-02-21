<?php

namespace App\Http\Middleware;

use App\Helpers\FlashMessage;
use App\Repositories\CandidateRepository;
use Closure;
use Illuminate\Support\Facades\URL;

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
            flushMessage('status');
            return $next($request);
        } else {
            setFlashMessage('status','Please add some candidate first .');
            return redirect()->route('admin.dashboard');
        }
    }
}
