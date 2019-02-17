<?php

namespace App\Http\Middleware;

use App\Repositories\PositionRepository;
use Closure;
use Illuminate\Support\Facades\URL;
class IsVotingOpen
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (getCurrentStateOfVote() === 'open') {
            return $next($request);
        } else {
            setFlashMessage('status','Whoops! you can\'t proceed to the voting section.');
            return redirect()->route('admin.dashboard');
        }
    }
}
