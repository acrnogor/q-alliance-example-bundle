<?php

use Swagger\Annotations as SWG;

/**
 * @SWG\Definition(
 *     definition="Example-Author-response-default",
 *     allOf={
 *         @SWG\Schema(ref="#/definitions/Helper-Id"),
 *         @SWG\Schema(ref="#/definitions/Example-Author-base"),
 *         @SWG\Schema(
 *             title="Example Author response default",
 *             @SWG\Property(
 *                 property="biography",
 *                 type="string",
 *                 example="He was OK."
 *             ),
 *             @SWG\Property(
 *                 property="name",
 *                 type="string",
 *                 example="John Doe",
 *                 description="Virtual property that combines first name and last name."
 *             ),
 *         ),
 *     }
 * )
 */
