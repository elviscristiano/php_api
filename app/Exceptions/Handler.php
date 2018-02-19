<?php

namespace App\Exceptions;

use App\Traits\ApiResponser;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{

    use ApiResponser;
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

        if ($exception instanceOf AuthenticationException)
        {
            return $this->unauthenticated($request, $exception);
        }

        if ($exception instanceOf AuthorizationException)
        {
            return $this->errorResponse($exception->getMessage(), 403);
        }

        if ($exception instanceOf HttpException)
        {
            return $this->errorResponse($exception->getMessage(), $exception->getStatusCode());
        }

        if ($exception instanceOf MethodNotAllowedHttpException)
        {
            return $this->errorResponse("Method not allowed.", 405);
        }

        if ($exception instanceOf ModelNotFoundException)
        {
            $modelMissing = strtolower(class_basename($exception->getModel()));
            return $this->errorResponse("This {$modelMissing} does not exist.", 404);
        }
        
        if ($exception instanceOf NotFoundHttpException)
        {
            return $this->errorResponse("URL not found.", 404);
        }

        if ($exception instanceOf QueryException)
        {
            return $this->errorResponse("Operation not allowed (database constraint)", 409);
        }

        if ($exception instanceOf ValidationException)
        {
            return $this->convertValidationExceptionToResponse($exception, $request);
        }

        if (config('app.debug'))
        {
            return parent::render($request, $exception);
        }        

        return $this->errorResponse("URL not found.", 404);
    }

    /**
     * Create a response object from the given validation exception.
     *
     * @param  \Illuminate\Validation\ValidationException  $e
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function convertValidationExceptionToResponse(ValidationException $e, $request)
    {
        $errors = $e->validator->errors()->getMessages();
        return response()->json($errors, 422);
    }
}
