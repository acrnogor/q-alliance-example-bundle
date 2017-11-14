<?php

namespace Q\ExampleBundle\EventListener;

use Q\ExampleBundle\Exception\VerboseExceptionInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ExceptionListener
{
    /**
     * Debug mode
     *
     * @var bool
     */
    private $debug;

    public function __construct($debug = false)
    {
        $this->debug = $debug;
    }

    /**
     * @param GetResponseForExceptionEvent $event
     */
    public function onKernelException(GetResponseForExceptionEvent $event)
    {
        if (!$event->isMasterRequest()) {
            return;
        }

        $exception = $event->getException();
        $code = $exception->getCode() === 0 ? Response::HTTP_BAD_REQUEST : $exception->getCode();

        if (
            $exception instanceof NotFoundHttpException &&
            strpos($exception->getMessage(), 'No route found') !== false
        ) {
            $message = 'Invalid request.';
            $code = Response::HTTP_NOT_FOUND;
        } elseif ($exception instanceof AccessDeniedHttpException) {
            $code = Response::HTTP_FORBIDDEN;
            $message = 'Not allowed, insufficient permissions.';
        } else {
            $message = $exception->getMessage();
        }

        $data = [
            'message' => $message,
            'code' => $code,
        ];

        // for VerboseExceptionInterface exceptions, add the extra data
        if ($exception instanceof VerboseExceptionInterface) {
            $data['validation'] = $exception->getExtraData();
        }

        // give some more feedback in debug mode :-)
        if ($this->debug) {
            $data['debug'] = [
                'line' => $exception->getLine(),
                'file' => $exception->getFile(),
            ];
        }

        $event->setResponse(new JsonResponse($data, $code));
    }
}
