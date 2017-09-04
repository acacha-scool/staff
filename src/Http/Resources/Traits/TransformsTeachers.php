<?php

namespace Acacha\Scool\Staff\Http\Resources\Traits;

use Acacha\Scool\Staff\Http\Resources\Position;

use Acacha\Scool\Staff\Http\Resources\Speciality as SpecialityResource;
use Acacha\Scool\Staff\Http\Resources\User as UserResource;

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
        $user = [];
        if ($teacher->user) {
            $user = new UserResource($teacher->user);
        }
        return [
            'id' => $teacher->id,
            'code' => $teacher->code,
            'state' => $teacher->state,
            'positions' => Position::collection($teacher->positions),
            'speciality' => new SpecialityResource($teacher->speciality),
            'user' => $user,
            'created_at' => $teacher->created_at,
            'updated_at' => $teacher->updated_at,
        ];
    }
}