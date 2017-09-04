<?php

namespace Acacha\Scool\Staff\Http\Resources;

use Acacha\Scool\Staff\Http\Resources\Traits\TransformsTeachers;
use Illuminate\Http\Resources\Json\Resource;

/**
 * Class Teacher.
 *
 * @package Acacha\Scool\Staff\Http\Resources
 */
class Teacher extends Resource
{
    use TransformsTeachers;

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return $this->transformTeacher($this);
    }

}
