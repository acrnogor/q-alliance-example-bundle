<?php

use Swagger\Annotations as SWG;

/**
 * @SWG\Definition(
 *     definition="Example-Author-request-create",
 *     allOf={
 *         @SWG\Schema(ref="#/definitions/Example-Author-base"),
 *         @SWG\Schema(
 *             title="Example Author request create",
 *             required={"first_name", "lastName", "gender", "place_of_birth"},
 *             @SWG\Property(
 *                 property="biography",
 *                 type="string",
 *                 example="He was OK."
 *             ),
 *         ),
 *     }
 * )
 */
