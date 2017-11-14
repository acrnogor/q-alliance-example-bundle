<?php

use Swagger\Annotations as SWG;

/**
 * @SWG\Definition(
 *     definition="Example-Book-response-light",
 *     allOf={
 *         @SWG\Schema(ref="#/definitions/Helper-Id"),
 *         @SWG\Schema(ref="#/definitions/Example-Book-base"),
 *         @SWG\Schema(
 *             title="Example Book response light",
 *             @SWG\Property(
 *                 property="updated_at",
 *                 type="string",
 *                 format="date-time",
 *                 example="2017-03-25 02:40:07",
 *             ),
 *         ),
 *     }
 * )
 */
