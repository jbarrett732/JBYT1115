<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        HttpException::class,
        ModelNotFoundException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $e
     * @return void
     */
    public function report(Exception $e)
    {
        return parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $e
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {
        if ($e instanceof ModelNotFoundException) {
            $e = new NotFoundHttpException($e->getMessage(), $e);
        }
	if($this->isHttpException($e)) {
	    switch($e->getStatusCode()) {
		case 400: return \Response::view('errors.4xx5xx'); break;
		case 401: return \Response::view('errors.4xx5xx'); break;
		case 402: return \Response::view('errors.4xx5xx'); break;
		case 403: return \Response::view('errors.4xx5xx'); break;
		case 404: return \Response::view('errors.4xx5xx'); break;
		case 405: return \Response::view('errors.4xx5xx'); break;
		case 406: return \Response::view('errors.4xx5xx'); break;
		case 407: return \Response::view('errors.4xx5xx'); break;
		case 408: return \Response::view('errors.4xx5xx'); break;
		case 409: return \Response::view('errors.4xx5xx'); break;
		case 410: return \Response::view('errors.4xx5xx'); break;
		case 411: return \Response::view('errors.4xx5xx'); break;
		case 412: return \Response::view('errors.4xx5xx'); break;
		case 413: return \Response::view('errors.4xx5xx'); break;
		case 414: return \Response::view('errors.4xx5xx'); break;
		case 415: return \Response::view('errors.4xx5xx'); break;
		case 416: return \Response::view('errors.4xx5xx'); break;
		case 417: return \Response::view('errors.4xx5xx'); break;
		case 500: return \Response::view('errors.4xx5xx'); break;
		case 501: return \Response::view('errors.4xx5xx'); break;
		case 502: return \Response::view('errors.4xx5xx'); break;
		case 503: return \Response::view('errors.4xx5xx'); break;
		case 504: return \Response::view('errors.4xx5xx'); break;
		case 505: return \Response::view('errors.4xx5xx'); break;
 		default:  return $this->renderHttpException($e); break;
	    }
	} else {
            return parent::render($request, $e);
	}
    }
}
