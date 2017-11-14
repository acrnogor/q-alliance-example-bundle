<?php

use Swagger\Annotations as SWG;

/**
 * @SWG\Definition(
 *     definition="Example-Book-base",
 *     title="Example Book base",
 *     @SWG\Property(
 *         property="title",
 *         type="string",
 *         example="The book",
 *     ),
 *     @SWG\Property(
 *         property="release_date",
 *         type="string",
 *         format="date",
 *         example="2010-02-21",
 *     ),
 *     @SWG\Property(
 *         property="isbn",
 *         type="string",
 *         example="9783161484100",
 *     ),
 *     @SWG\Property(
 *         property="format",
 *         type="string",
 *         example="Hardcover",
 *     ),
 *     @SWG\Property(
 *         property="number_of_pages",
 *         type="integer",
 *         example=42,
 *     ),
 * )
 */
