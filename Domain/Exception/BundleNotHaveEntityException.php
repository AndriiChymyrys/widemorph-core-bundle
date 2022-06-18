<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Exception;

use Exception;
use Throwable;

/**
 * Class BundleNotHaveEntityException
 *
 * @package WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Exception
 */
class BundleNotHaveEntityException extends Exception
{
    /**
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct(string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        $message = sprintf('Bundle "%s" does not have entities', $message);

        parent::__construct($message, $code, $previous);
    }
}
