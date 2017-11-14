<?php

use Swagger\Annotations as SWG;

/**
 * @SWG\Definition(
 *     definition="Example-Book-response-default-author",
 *     allOf={
 *         @SWG\Schema(ref="#/definitions/Helper-Id"),
 *         @SWG\Schema(ref="#/definitions/Example-Book-response-default"),
 *         @SWG\Schema(
 *             title="Example Book response default-author",
 *             @SWG\Property(
 *                 property="author",
 *                 ref="#/definitions/Example-Author-response-default",
 *             ),
 *         ),
 *     }
 * )
 */
