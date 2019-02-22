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
            //if the request is came from API
            if (strpos($_SERVER['REQUEST_URI'],'api') !== false  || strpos($_SERVER['REQUEST_URI'],'mobile') !== false) {
                return response()->json(['message' => 'Sorry but the voting is already closed']);
            } else {
                setFlashMessage('status','Whoops! you can\'t proceed to the voting section.');
            }
            return redirect()->route('admin.dashboard');
        }
    }
}
