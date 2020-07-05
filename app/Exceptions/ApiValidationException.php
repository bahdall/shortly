<?php
declare(strict_types=1);

namespace App\Exceptions;

use Illuminate\Validation\ValidationException;

class ApiValidationException extends ValidationException
{
    /**
     * Get the underlying response instance.
     *
     * @return \Symfony\Component\HttpFoundation\Response|null
     */
    public function getResponse()
    {
        return $this->response;
    }
}
