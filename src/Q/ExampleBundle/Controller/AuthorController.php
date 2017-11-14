<?php

namespace Q\ExampleBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Swagger\Annotations as SWG;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class AuthorController extends BaseController
{
    /**
     * Create a new Author.
     *
     * @SWG\Post(
     *     path="/authors",
     *     tags={"Example Author"},
     *     summary="Create a new Author",
     *     @SWG\Parameter(
     *         name="body",
     *         in="body",
     *         required=true,
     *         @SWG\Schema(ref="#/definitions/Example-Author-request-create")
     *     ),
     *     @SWG\Response(
     *         response="200",
     *         description="Author created",
     *         @SWG\Schema(ref="#/definitions/Example-Author-response-default")
     *     ),
     *     @SWG\Response(
     *         response="422",
     *         description="Validation error",
     *         @SWG\Schema(ref="#/definitions/Validation-error")
     *     )
     * )
     *
     * @Route("/authors")
     * @Method("POST")
     *
     * @param Request $request
     *
     * @throws \LogicException
     * @throws \Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException
     *
     * @return JsonResponse
     */
    public function createAction(Request $request) : JsonResponse
    {
        $author = $this->runJsonFactory($this->get('q_example.author.factory'), $request->getContent());
        $this->get('q_example.author.repository')->save($author);

        return $this->serializeToJsonResponse($author, 'default');
    }

    /**
     * Update an Author.
     *
     * @SWG\Put(
     *     path="/authors/{id}",
     *     tags={"Example Author"},
     *     summary="Update an existing Author",
     *     @SWG\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID",
     *         type="integer",
     *         format="int64"
     *     ),
     *     @SWG\Parameter(
     *         name="body",
     *         in="body",
     *         required=true,
     *         @SWG\Schema(ref="#/definitions/Example-Author-request-update")
     *     ),
     *     @SWG\Response(
     *         response="200",
     *         description="Author created",
     *         @SWG\Schema(ref="#/definitions/Example-Author-response-default")
     *     ),
     *     @SWG\Response(
     *         response="422",
     *         description="Validation error",
     *         @SWG\Schema(ref="#/definitions/Validation-error")
     *     )
     * )
     *
     * @Route("/authors/{id}", requirements={"id" = "\d+"})
     * @Method("PUT")
     *
     * @param Request $request
     * @param int $id
     *
     * @throws \LogicException
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     * @throws \Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException
     *
     * @return JsonResponse
     */
    public function updateAction(Request $request, $id) : JsonResponse
    {
        $this->get('q_example.author.repository')->findOr404($id);
        $author = $this->runJsonFactory($this->get('q_example.author.factory'), $request->getContent(), ['default']);
        $author = $this->get('q_example.author.repository')->merge($author);

        return $this->serializeToJsonResponse($author, ['default', 'books']);
    }

    /**
     * List all Authors.
     *
     * @SWG\Get(
     *     path="/authors",
     *     tags={"Example Author"},
     *     summary="List all authors",
     *     @SWG\Response(
     *         response="200",
     *         description="List of authors",
     *         @SWG\Schema(
     *             type="array",
     *             @SWG\Items(ref="#/definitions/Example-Author-response-light"),
     *         ),
     *     ),
     * )
     *
     * @Route("/authors")
     * @Method("GET")
     *
     * @return JsonResponse
     */
    public function indexAction() : JsonResponse
    {
        $authors = $this->get('q_example.author.repository')->findAll();

        return $this->serializeToJsonResponse($authors, 'light');
    }

    /**
     * Get a single author.
     *
     * @SWG\Get(
     *     path="/authors/{id}",
     *     tags={"Example Author"},
     *     summary="Get a single Author",
     *     @SWG\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID",
     *         type="integer",
     *         format="int64"
     *     ),
     *     @SWG\Response(
     *         response="200",
     *         description="Author found",
     *         @SWG\Schema(ref="#/definitions/Example-Author-response-default-books")
     *     ),
     *     @SWG\Response(
     *         response="404",
     *         description="Not found"
     *     ),
     * )
     *
     * @Route("/authors/{id}", requirements={"id" = "\d+"})
     * @Method("GET")
     *
     * @param $id
     *
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     *
     * @return JsonResponse
     */
    public function getAction($id) : JsonResponse
    {
        $author = $this->get('q_example.author.repository')->findOr404($id);

        return $this->serializeToJsonResponse($author, ['author_default', 'light', 'books']);
    }

    /**
     * Delete an existing Author.
     *
     * @SWG\Delete(
     *     path="/authors/{id}",
     *     tags={"Example Author"},
     *     summary="Delete an existing Author",
     *     @SWG\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID",
     *         type="integer",
     *         format="int64"
     *     ),
     *     @SWG\Response(
     *         response="204",
     *         description="Author removed"
     *     ),
     *     @SWG\Response(
     *         response="404",
     *         description="Not found"
     *     ),
     * )
     *
     * @Route("/authors/{id}", requirements={"id" = "\d+"})
     * @Method("DELETE")
     *
     * @param int $id
     *
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     *
     * @return JsonResponse
     */
    public function deleteAction($id) : JsonResponse
    {
        $author = $this->get('q_example.author.repository')->findOr404($id);
        $this->get('q_example.author.repository')->remove($author);

        return new JsonResponse([],JsonResponse::HTTP_NO_CONTENT);
    }


}
