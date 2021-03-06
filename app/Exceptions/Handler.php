<?php

namespace App\Exceptions;

use App\Models\StatVisit;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });

        /** Отчет о посещении страницы с ошибкой */
        $this->renderable(function (NotFoundHttpException $e, $request) {
            if (!$request->is('api/*') and !$e->getMessage()) {
                StatVisit::writeStatVisit($request, $e->getStatusCode());
            }
        });
    }
}
