<?php

namespace Q\ExampleBundle\Exception;

use Throwable;

interface VerboseExceptionInterface
{
    /**
     * VerboseException constructor.
     *
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     * @param array $extraData
     */
    public function __construct($message = '', $code = 0, Throwable $previous = null, array $extraData = []);

    /**
     * @return array
     */
    public function getExtraData() : array;

    /**
     * @param string $message
     * @param array $extraData
     *
     * @return VerboseExceptionInterface
     */
    public static function create($message = '', array $extraData = []) : VerboseExceptionInterface;
}
