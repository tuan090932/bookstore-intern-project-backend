<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Support\MessageBag;

/**
 * This class represents a custom exception that is thrown when a validation fails.
 * It extends the base Exception class and adds a property to hold the validation errors.
 */
class ValidationException extends Exception
{
    /**
     * The validation errors.
     *
     * @var \Illuminate\Support\MessageBag
     */
    protected $errors;

    /**
     * Constructor for the ValidationException.
     *
     * @param \Illuminate\Support\MessageBag $errors
     *
     * Call the constructor of the parent class (Exception) with the message 'Validation failed'
     *
     * Store the validation errors in the $errors property
     */
    public function __construct(MessageBag $errors)
    {
        parent::__construct('Validation failed');

        $this->errors = $errors;
    }

    /**
     * Get the validation errors.
     *
     * @return \Illuminate\Support\MessageBag
     *
     * Return the validation errors
     */
    public function getErrors()
    {
        return $this->errors;
    }
}
