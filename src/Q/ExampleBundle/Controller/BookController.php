<?php

namespace Q\ExampleBundle\Controller;

use Q\ExampleBundle\Entity\Book;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Swagger\Annotations as SWG;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class BookController extends BaseController
{
    /**
     * Create a new Book.
     *
     * @SWG\Post(
     *     path="/books",
     *     tags={"Example Book"},
     *     summary="Create a new Book",
     *     @SWG\Parameter(
     *         name="body",
     *         in="body",
     *         required=true,
     *         @SWG\Schema(ref="#/definitions/Example-Book-request-create")
     *     ),
     *     @SWG\Response(
     *         response="200",
     *         description="Book created",
     *         @SWG\Schema(ref="#/definitions/Example-Book-response-default-author")
     *     ),
     *     @SWG\Response(
     *         response="422",
     *         description="Validation error",
     *         @SWG\Schema(ref="#/definitions/Validation-error")
     *     )
     * )
     *
     * @Route("/books")
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
        $book = $this->runJsonFactory($this->get('q_example.book.factory'), $request->getContent());
        $book = $this->get('q_example.book.repository')->merge($book);

        return $this->serializeToJsonResponse($book, ['default', 'author']);
    }

    /**
     * Update an existing Book.
     *
     * @SWG\Put(
     *     path="/books/{id}",
     *     tags={"Example Book"},
     *     summary="Update an existing Book",
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
     *         @SWG\Schema(ref="#/definitions/Example-Book-request-update")
     *     ),
     *     @SWG\Response(
     *         response="200",
     *         description="Book created",
     *         @SWG\Schema(ref="#/definitions/Example-Book-response-default-author")
     *     ),
     *     @SWG\Response(
     *         response="422",
     *         description="Validation error",
     *         @SWG\Schema(ref="#/definitions/Validation-error")
     *     ),
     *     @SWG\Response(
     *         response="404",
     *         description="Not found",
     *         @SWG\Schema(ref="#/definitions/Not-Found-error")
     *     ),
     * )
     *
     * @Route("/books/{id}", requirements={"id" = "\d+"})
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
        $this->get('q_example.book.repository')->findOr404($id);
        $book = $this->runJsonFactory($this->get('q_example.book.factory'), $request->getContent(), ['default', 'author']);
        $book = $this->get('q_example.book.repository')->merge($book);

        return $this->serializeToJsonResponse($book, ['default', 'author']);
    }

    /**
     * List all Books.
     *
     * @SWG\Get(
     *     path="/books",
     *     tags={"Example Book"},
     *     summary="List all books",
     *     @SWG\Response(
     *         response="200",
     *         description="List of books",
     *         @SWG\Schema(
     *             type="array",
     *             @SWG\Items(ref="#/definitions/Example-Book-response-light"),
     *         ),
     *     ),
     * )
     *
     * @Route("/books")
     * @Method("GET")
     *
     * @return JsonResponse
     */
    public function indexAction() : JsonResponse
    {
        $books = $this->get('q_example.book.repository')->findAll();

        return $this->serializeToJsonResponse($books, 'light');
    }

    /**
     * Get a single Book.
     *
     * @SWG\Get(
     *     path="/books/{id}",
     *     tags={"Example Book"},
     *     summary="Get a single Book",
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
     *         description="Book found",
     *         @SWG\Schema(ref="#/definitions/Example-Book-response-default-author")
     *     ),
     *     @SWG\Response(
     *         response="404",
     *         description="Not found",
     *         @SWG\Schema(ref="#/definitions/Not-Found-error")
     *     ),
     * )
     *
     * @Route("/books/{id}", requirements={"id" = "\d+"})
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
        $book = $this->get('q_example.book.repository')->findOr404($id);

        return $this->serializeToJsonResponse($book, ['default', 'author']);
    }

    /**
     * Delete an existing Book.
     *
     * @SWG\Delete(
     *     path="/books/{id}",
     *     tags={"Example Book"},
     *     summary="Delete an existing Book",
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
     *         description="Book removed"
     *     ),
     *     @SWG\Response(
     *         response="404",
     *         description="Not found",
     *         @SWG\Schema(ref="#/definitions/Not-Found-error")
     *     ),
     * )
     *
     * @Route("/books/{id}", requirements={"id" = "\d+"})
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
        $book = $this->get('q_example.book.repository')->findOr404($id);
        $this->get('q_example.book.repository')->remove($book);

        return new JsonResponse([], JsonResponse::HTTP_NO_CONTENT);
    }
}
