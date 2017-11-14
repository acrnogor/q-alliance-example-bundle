<?php

use Swagger\Annotations as SWG;

/**
 * @SWG\Definition(
 *     definition="Validation-error",
 *     @SWG\Property(
 *         property="code",
 *         type="integer",
 *         example=422
 *     ),
 *     @SWG\Property(
 *         property="message",
 *         type="string",
 *         example="Unprocessable Entity"
 *     ),
 *     @SWG\Property(
 *         property="validation",
 *         @SWG\Property(
 *             additionalProperties=true,
 *             property="field_name",
 *             type="string",
 *             example="Please fill FieldName"
 *         )
 *     )
 * )
 */
