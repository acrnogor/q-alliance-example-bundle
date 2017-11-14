<?php

use Swagger\Annotations as SWG;

/**
 * @SWG\Definition(
 *     definition="Example-Author-request-update",
 *     allOf={
 *         @SWG\Schema(ref="#/definitions/Example-Author-base"),
 *         @SWG\Schema(
 *             title="Example Author request update",
 *             @SWG\Property(
 *                 property="biography",
 *                 type="string",
 *                 example="He was OK."
 *             ),
 *         ),
 *     }
 * )
 */
