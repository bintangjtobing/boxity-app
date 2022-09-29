<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Throwable
     */
    public function report(\Exception $e)
    {
        if ($e instanceof \Exception) {
            // emails.exception is the template of your email
            // it will have access to the $error that we are passing below
            Mail::send('emails.exception', ['error' => $e->getMessage()], function ($m) {
                $m->from('system@boxity.id', 'New Log Report for Boxity Platform')->to('hello@bintangtobing.com', 'New log report for boxity application')->subject('New log report for boxity application');
            });
        }

        parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        if ($this->isHttpException($exception)) {
            if ($exception->getStatusCode() == 404) {
                return response()->view('errors.' . '404', [], 404);
            }
            if ($exception->getStatusCode() == 500) {
                return response()->view('errors.' . '500', [], 500);
            }
        }
        return parent::render($request, $exception);
    }
}
