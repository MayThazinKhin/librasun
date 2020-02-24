<?php

namespace App\Http\Middleware;

use Closure;

class VerifyWebhookToken
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
        dd(env("MESSENGER_VERIFY_TOKEN"));
        if ($request->input("hub_mode") === "subscribe"
            && $request->input("hub_verify_token") === env("MESSENGER_VERIFY_TOKEN")) {
            return response($request->input("hub_challenge"), 200);
        }
        return $next($request);
    }
}
