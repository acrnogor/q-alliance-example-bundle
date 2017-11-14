<?php

use Swagger\Annotations as SWG;

/**
 * @SWG\Definition(
 *     definition="Example-Author-base",
 *     title="Example Author base",
 *     @SWG\Property(
 *         property="first_name",
 *         type="string",
 *         example="John",
 *     ),
 *     @SWG\Property(
 *         property="last_name",
 *         type="string",
 *         example="Doe",
 *     ),
 *     @SWG\Property(
 *         property="birthday",
 *         type="string",
 *         format="date",
 *         example="1980-08-28",
 *     ),
 *     @SWG\Property(
 *         property="gender",
 *         type="string",
 *         example="male",
 *         enum={"male","female"},
 *     ),
 *     @SWG\Property(
 *         property="place_of_birth",
 *         type="string",
 *         example="Zagreb, Croatia",
 *     ),
 * )
 */
