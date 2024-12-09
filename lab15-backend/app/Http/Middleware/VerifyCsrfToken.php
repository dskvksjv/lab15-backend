<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class VerifyCsrfToken
{
    /**
     * Список маршрутів, які не потребують CSRF перевірки.
     *
     * @var array
     */
    protected $except = [
        '/book',
        'api/*',
        'books/*',
        'book/*', // Додаємо всі API маршрути, щоб вони не перевіряли CSRF
    ];

    /**
     * Обробка запиту.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Перевіряємо, чи не належить маршрут до списку "крізь CSRF перевірку"
        if ($this->inExceptArray($request)) {
            return $next($request);
        }

        // Якщо не виключення, виконуємо стандартну перевірку CSRF
        if ($this->shouldVerifyCsrfToken($request)) {
            $this->verifyCsrfToken($request);
        }

        return $next($request);
    }

    /**
     * Перевіряє, чи поточний маршрут є у виключеннях
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function inExceptArray(Request $request)
    {
        foreach ($this->except as $except) {
            if ($request->is($except)) {
                return true;
            }
        }
        return false;
    }

    /**
     * Перевіряє, чи потрібно проводити CSRF перевірку.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function shouldVerifyCsrfToken(Request $request)
    {
        // Логіка для визначення, чи потрібно перевіряти CSRF
        return ! in_array($request->method(), ['GET', 'HEAD', 'OPTIONS']);
    }

    /**
     * Виконує перевірку CSRF токену.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    protected function verifyCsrfToken(Request $request)
    {
        // Отримання CSRF токену з запиту
        $token = $request->header('X-CSRF-TOKEN') ?: $request->input('_token');

        // Перевірка наявності токену
        if ($token !== session()->token()) {
            abort(403, 'CSRF token mismatch.');
        }
    }
}
