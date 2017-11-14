<?php

use Swagger\Annotations as SWG;

/**
 * @SWG\Definition(
 *     definition="Example-Author-response-default-books",
 *     allOf={
 *         @SWG\Schema(ref="#/definitions/Example-Author-response-default"),
 *         @SWG\Schema(
 *             title="Example Author response default-books",
 *             type="object",
 *             @SWG\Property(
 *                 property="books",
 *                 type="array",
 *                 @SWG\Items(
 *                     ref="#/definitions/Example-Book-response-default",
 *                 ),
 *             ),
 *         ),
 *     }
 * )
 */
