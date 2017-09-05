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
        $vacancy = [];
        if ($teacher->vacancy) {
//            $vacancy = new VacancyResource($teacher->user);
        }
        $specialities = [];
        if ($teacher->specialities) {
//            $specialities = new SpecialityResource($teacher->user);
            //TODO
            $specialities = [];
        }
        return [
            'id' => $teacher->id,
            'code' => $teacher->code,
            'state' => $teacher->state,
            'specialities' => $specialities,
            'user' => $user,
            'vacancy' => $vacancy,
            'administrative_status_id' => $teacher->administrative_status_id,
            'administrative_start_year' => $teacher->administrative_start_year,
            'opossitions_pass_year' => $teacher->opossitions_pass_year,
            'start_date' => $teacher->start_date,
            'created_at' => $teacher->created_at->toDateTimeString(),
            'updated_at' => $teacher->updated_at->toDateTimeString() ,
        ];
    }
}