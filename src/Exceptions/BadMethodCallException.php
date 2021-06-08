<?php

namespace BlackJew\Payments\Exceptions;

/**
 * Bad Method Call Exception
 */
class BadMethodCallException extends \BadMethodCallException implements PaymentException
{
}