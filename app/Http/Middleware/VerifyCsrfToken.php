<?php

namespace App\Http\Middleware;

use Closure;

class VerifyCsrfToken
{
    protected $except = [
        'api/*', // Desativa a verificação CSRF para todas as rotas que começam com /api/
    ];

    public function handle($request, Closure $next)
    {
        // Se a requisi o for uma exce o, permitir passagem
        if ($this->isReading($request) || $this->shouldPassThrough($request)) {
            return $next($request);
        }

        // Verificar se o token CSRF est  presente e vlido
        $token = $request->ajax() ? $request->header('X-CSRF-Token') : $request->input('_token');

        if (! $token || ! $request->session()->tokenMatches('csrf_token', $token)) {
            throw new TokenMismatchException;
        }

        return $next($request);
    }
}