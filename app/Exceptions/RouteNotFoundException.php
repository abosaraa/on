<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    // ...

    public function render($request, Throwable $exception)
    {
        if ($exception instanceof NotFoundHttpException) {
            // Redirect to the desired route (e.g., '/')
            return redirect('/');
        }

        return parent::render($request, $exception);
    }

    // ...
}
