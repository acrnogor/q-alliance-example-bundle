<?php

namespace Q\ExampleBundle\Controller;

use Q\ExampleBundle\Entity\EntityInterface;
use Q\ExampleBundle\Exception\ValidationException;
use Q\ExampleBundle\Factory\FactoryInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

class BaseController extends Controller
{
    /**
     * @param $object
     * @param null $group
     * @param int $status
     * @param array $headers
     *
     * @return JsonResponse
     */
    protected function serializeToJsonResponse(
        $object,
        $group = null,
        $status = 200,
        $headers = []
    ) {
        return new JsonResponse(
            $this->get('q_example.serializer')->toJson($object, $group),
            $status,
            $headers,
            true
        );
    }

    /**
     * @param FactoryInterface $factory
     * @param string $jsonData
     * @param array|string $groups
     *
     * @throws \Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException
     *
     * @return EntityInterface
     */
    protected function runJsonFactory(FactoryInterface $factory, string $jsonData, array $groups = []) : EntityInterface
    {
        try {
            $entity = $factory->factory($jsonData, $groups);
        } catch (ValidationException $exception) {
            throw new UnprocessableEntityHttpException($exception->getMessage(), $exception);
        }

        return $entity;
    }
}
