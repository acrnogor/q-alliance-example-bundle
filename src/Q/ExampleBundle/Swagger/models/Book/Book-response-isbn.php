<?php

use Swagger\Annotations as SWG;

/**
 * @SWG\Definition(
 *     definition="Example-Book-response-isbn",
 *     title="Example Book response isbn",
 *     @SWG\Property(
 *         property="isbn",
 *         type="string",
 *         example="0552131067",
 *     ),
 *     @SWG\Property(
 *         property="title",
 *         type="string",
 *         example="Mort",
 *     ),
 *     @SWG\Property(
 *         property="subtitle",
 *         type="string",
 *         example="A Discworld Novel",
 *     ),
 *     @SWG\Property(
 *         property="authors",
 *         type="array",
 *         @SWG\Items(
 *             type="string",
 *             example="Terry Pratchett"
 *         ),
 *     ),
 *     @SWG\Property(
 *         property="publisher",
 *         type="string",
 *         example="Corgi Books",
 *     ),
 *     @SWG\Property(
 *         property="pageCount",
 *         type="integer",
 *         example=271,
 *     ),
 *     @SWG\Property(
 *         property="averageRating",
 *         type="integer",
 *         example=4,
 *     ),
 * )
 */
