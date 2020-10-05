<?php

namespace App\Exceptions;

use Borto\Application\Traits\ApiResponse;
use Borto\Domain\Authentication\Exceptions\DuplicatedUserEmailException;
use Borto\Domain\Authentication\Exceptions\InvalidCredentialsException;
use Borto\Domain\Authentication\Exceptions\UserNotFoundException;
use Borto\Domain\Equipment\Exceptions\BrandNotFoundException;
use Borto\Domain\Equipment\Exceptions\CategoryNotFoundException;
use Borto\Domain\Equipment\Exceptions\DuplicatedBrandException;
use Borto\Domain\Equipment\Exceptions\DuplicatedCategoryException;
use Borto\Domain\Equipment\Exceptions\DuplicatedModelException;
use Borto\Domain\Equipment\Exceptions\ModelNotFoundException;
use Borto\Domain\Order\Exceptions\OrderNotFoundException;
use Borto\Domain\Order\Exceptions\UnableToChangeOrderStatusException;
use Borto\Domain\Order\Exceptions\UnableToDeleteOrderException;
use Borto\Domain\Order\Exceptions\UnableToDeleteSystemInformationException;
use Borto\Domain\Person\Exceptions\CustomerNotFoundException;
use Borto\Domain\Person\Exceptions\SupplierNotFoundException;
use Borto\Domain\Shared\Exceptions\CustomException;
use Borto\Domain\Shared\Exceptions\NotAllowedException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Throwable;

class Handler extends ExceptionHandler
{
    use ApiResponse;

    const STATUS_MAP = [
        // # 401
        UnauthorizedException::class       => Response::HTTP_UNAUTHORIZED,
        AuthenticationException::class     => Response::HTTP_UNAUTHORIZED,
        InvalidCredentialsException::class => Response::HTTP_UNAUTHORIZED,
        // # 403
        NotAllowedException::class                      => Response::HTTP_FORBIDDEN,
        UnableToDeleteOrderException::class             => Response::HTTP_FORBIDDEN,
        UnableToChangeOrderStatusException::class       => Response::HTTP_FORBIDDEN,
        UnableToDeleteSystemInformationException::class => Response::HTTP_FORBIDDEN,
        // # 404
        CategoryNotFoundException::class => Response::HTTP_NOT_FOUND,
        BrandNotFoundException::class    => Response::HTTP_NOT_FOUND,
        UserNotFoundException::class     => Response::HTTP_NOT_FOUND,
        ModelNotFoundException::class    => Response::HTTP_NOT_FOUND,
        CustomerNotFoundException::class => Response::HTTP_NOT_FOUND,
        SupplierNotFoundException::class => Response::HTTP_NOT_FOUND,
        OrderNotFoundException::class    => Response::HTTP_NOT_FOUND,
        // # 422
        DuplicatedUserEmailException::class => Response::HTTP_UNPROCESSABLE_ENTITY,
        DuplicatedCategoryException::class  => Response::HTTP_UNPROCESSABLE_ENTITY,
        DuplicatedBrandException::class     => Response::HTTP_UNPROCESSABLE_ENTITY,
        DuplicatedModelException::class     => Response::HTTP_UNPROCESSABLE_ENTITY,
    ];

    protected $dontReport = [
        InvalidCredentialsException::class
    ];

    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    public function render($request, Throwable $exception)
    {
        $type = get_class($exception);

        // dd($exception);

        if ($exception instanceof CustomException && isset(self::STATUS_MAP[$type])) {
            return $this->renderCustomException($exception, self::STATUS_MAP[$type]);
        }

        if (isset(self::STATUS_MAP[$type])) {
            Log::debug(get_class($exception));
            return $this->renderError($exception, self::STATUS_MAP[$type]);
        }

        if ($exception instanceof ValidationException) {
            return $this->renderUnprocessableEntity($exception);
        }

        if (env('APP_ENV') === 'local') {
            dd('Handler - Uncaught Exception ', $exception);
        }

        return $this->sendError('An unexpected error occurred! Try again later.', null, Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    public function renderCustomException(CustomException $exception, int $statusCode)
    {
        $message = $exception->getMessage();
        $errors = null;

        if (method_exists($exception, "errors")) {
            $errors = $exception->errors();
        }

        return $this->sendError($message, $errors, $statusCode);
    }

    public function renderError(Throwable $exception, int $statusCode): JsonResponse
    {
        if ($exception instanceof AuthenticationException) {
            return $this->sendError('unauthenticated', null, $statusCode);
        }

        $message = $exception->getMessage();
        return $this->sendError($message, null, $statusCode);
    }

    public function renderUnprocessableEntity(ValidationException $exception): JsonResponse
    {
        $errors = $exception->errors();
        $fields = array_keys($errors);

        $messages = array_map(function ($field) use ($errors) {
            return [$field => $errors[$field][0]];
        }, $fields);

        return $this->sendError('Não autorizado!', $messages, Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
