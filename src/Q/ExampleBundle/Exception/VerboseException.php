<?php

namespace Q\ExampleBundle\Exception;

use Throwable;

class VerboseException extends \Exception implements VerboseExceptionInterface
{
    /**
     * @var array
     */
    public $extraData;

    /**
     * VerboseException constructor.
     *
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     * @param array $extraData
     */
    public function __construct($message = '', $code = 0, Throwable $previous = null, array $extraData = [])
    {
        $this->extraData = $extraData;

        parent::__construct($message, $code, $previous);
    }

    /**
     * @return array
     */
    public function getExtraData() : array
    {
        return $this->extraData;
    }

    /**
     * @param string $message
     * @param array $extraData
     *
     * @return VerboseExceptionInterface
     */
    public static function create($message = '', array $extraData = []) : VerboseExceptionInterface
    {
        return new static($message, 0, null, $extraData);
    }
}
