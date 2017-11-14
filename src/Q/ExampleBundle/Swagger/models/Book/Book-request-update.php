<?php

use Swagger\Annotations as SWG;

/**
 * @SWG\Definition(
 *     definition="Example-Book-request-update",
 *     allOf={
 *         @SWG\Schema(ref="#/definitions/Example-Book-base"),
 *         @SWG\Schema(
 *             title="Example Book request update",
 *             @SWG\Property(
 *                 property="description",
 *                 type="string",
 *                 example="It's a book about books.",
 *             ),
 *             @SWG\Property(
 *                 property="author",
 *                 type="object",
 *                 @SWG\Property(
 *                     property="id",
 *                     type="integer",
 *                     format="int64",
 *                     example=1,
 *                 )
 *             ),
 *         ),
 *     }
 * )
 */
