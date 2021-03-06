<?php

namespace App\Http\Middleware;

use App\LogAccess;
use Closure;

class LogAccessMiddleware {
  /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure  $next
   * @return mixed
   */
  public function handle($request, Closure $next) {
    // return $next($request);
    $ip = $request->server->get('REMOTE_ADDR');
    $route = $request->getRequestUri();

    LogAccess::create(['log' => "IP $ip requested the $route route"]);

    $response = $next($request);

    $response->setStatusCode(201, 'The response status was modified!');

    return $response;
  }
}
