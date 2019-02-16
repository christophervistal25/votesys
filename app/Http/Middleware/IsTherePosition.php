<?php

namespace App\Http\Middleware;

use Closure;
use App\Repositories\PositionRepository;
class IsTherePosition
{

    public function __construct(PositionRepository $positionRepository)
    {
        $this->positionRepository = $positionRepository;
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
        if ($this->positionRepository->isThereAnyPosition()) {
            return $next($request);
        } else {
            return redirect()->route('admin.dashboard');
        }
    }
}
