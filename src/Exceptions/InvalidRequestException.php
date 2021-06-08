<?php

namespace BlackJew\Payments\Exceptions;

/**
 * Invalid Request Exception
 *
 * Thrown when a request is invalid or missing required fields.
 */
class InvalidRequestException extends \Exception implements PaymentException
{
}