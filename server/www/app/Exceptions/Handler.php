<?php namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler {

    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = ['Symfony\Component\HttpKernel\Exception\HttpException'];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception $e
     * @return void
     */
    public function report(Exception $e) {
        return parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Exception $e
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e) {
        // If the request wants JSON (AJAX doesn't always want JSON)
        if ($request->wantsJson()) {
            // Define the response
            $response = ['status' => 400, 'errors' => 'Sorry, something went wrong.'];

            // If the app is in debug mode
            if (config('app.debug')) {
                // Add the exception class name, message and stack trace to response
                $response['exception'] = get_class($e); // Reflection might be better here
                $response['message'] = $e->getMessage();
                $response['trace'] = $e->getTrace();
            }

            // If this exception is an instance of HttpException
            if ($this->isHttpException($e)) {
                // Grab the HTTP status code from the Exception
                $response['status'] = $e->getStatusCode();
            }

            // Return a JSON response with the response array and status code
            return response()->json($response, $response['status']);
        }

        // Default to the parent class' implementation of handler
        return parent::render($request, $e);
    }
}