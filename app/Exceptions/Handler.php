<?php

namespace App\Exceptions;

use App\Traits\JsonResponseTrait;
use Illuminate\Support\Str;
use Throwable;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    use JsonResponseTrait;
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
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
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $e)
    {
        if ($e instanceof ModelNotFoundException) {
            return $this->jsonErrorResponse(" {$this->prettyModelNotFound($e)} not found.",404);
        }
        if ($e instanceof \Exception) {
            return  $this->jsonErrorResponse( $e->getMessage(),500);
        }
        return parent::render($request, $e);
    }

    private function prettyModelNotFound(ModelNotFoundException $exception): string
    {
        if (! is_null($exception->getModel())) {
            return Str::lower(ltrim(preg_replace('/[A-Z]/', ' $0', class_basename($exception->getModel()))));
        }
        return 'resource';
    }
}
