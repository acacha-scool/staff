<?php

namespace Acacha\Scool\Staff\Http\Resources\Traits;

/**
 * Class TransformsVacancies.
 *
 * @package Acacha\Scool\Staff\Http\Resources\Traits
 */
trait TransformsVacancies
{
    /**
     * @return array
     */
    protected function transformVacancy( $vacancy )
    {
        return [
            'id' => $vacancy->id,
            'code' => $vacancy->code,
            'created_at' => $vacancy->created_at,
            'updated_at' => $vacancy->updated_at
        ];
    }
}