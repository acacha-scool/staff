<?php

namespace Acacha\Scool\Staff\Http\Resources\Traits;

use Acacha\Scool\Staff\Http\Resources\Position;

use Acacha\Scool\Staff\Http\Resources\Speciality as SpecialityResource;

/**
 * Class TransformsTeachers.
 *
 * @package Acacha\Scool\Staff\Http\Resources\Traits
 */
trait TransformsTeachers
{
    /**
     * @return array
     */
    protected function transformTeacher( $teacher )
    {
        return [
            'id' => $teacher->id,
            'code' => $teacher->code,
            'state' => $teacher->state,
            'positions' => Position::collection($teacher->positions),
            'speciality' => new SpecialityResource($teacher->speciality),
            'created_at' => $teacher->created_at,
            'updated_at' => $teacher->updated_at,
        ];
    }
}