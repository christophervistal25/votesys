<?php

namespace App\Http\Middleware;

use App\Repositories\PositionRepository;
use Closure;
use Illuminate\Support\Facades\URL;
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
            flushMessage('status');
            return $next($request);
        } else {
            // if (strpos(URL::current(), '/admin/candidate/create') !== false) {
                setFlashMessage('status','Please add some position first.');
            // }
            return redirect()->route('admin.dashboard');
        }
    }
}
