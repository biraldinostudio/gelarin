<?php

namespace App\Exceptions;

use Exception;
//START untuk custom redirect page jika session expire
use Request;
use Illuminate\Auth\AuthenticationException;
use Response;
use Redirect;
//END untuk custom redirect page jika session expire

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

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
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        //return parent::render($request, $exception);
		if ($exception instanceof AuthenticationException) {
			return redirect('/login'); //return redirect('/');
		}
		return parent::render($request, $exception);
    }
	
	//START untuk custom redirect page jika session expire
         protected function unauthenticated($request, AuthenticationException $exception)
         {
            return $request->expectsJson()
                    ? response()->json(['message' => 'Unauthenticated.'], 401)
                    : redirect()->guest(route('/'));
    }	
	//END untuk custom redirect page jika session expire
	
}
