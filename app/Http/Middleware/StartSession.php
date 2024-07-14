<?php

namespace App\Http\Middleware;

use App\Models\Session;
use Closure;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Session\Session as SessionContract;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StartSession
{
    private const DB_SESSION_ID_KEY = 'db_session_id';

    public function __construct(
        private readonly Application $app,
        private readonly SessionContract $sessionManager,
    ) {
    }

    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $session = null;

        if ($this->sessionManager->has(self::DB_SESSION_ID_KEY)) {
            $sessionIdForDb = $this->sessionManager->get(self::DB_SESSION_ID_KEY);
            $session = Session::query()->find($sessionIdForDb);
        }

        if ($session === null) {
            $session = new Session();
            $session->save();
            $this->sessionManager->put(self::DB_SESSION_ID_KEY, $session->id);
        }

        $this->app->instance(Session::class, $session);

        if ($request->getMethod() === 'GET' && ! $request->isXmlHttpRequest()) {
            $session->events()->create([
                'url' => url($request->path()),
                'type' => 'pageview',
            ]);
        }

        return $next($request);
    }
}
