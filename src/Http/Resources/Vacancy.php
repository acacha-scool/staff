<?php

namespace Acacha\Scool\Staff\Http\Resources;

use Acacha\Scool\Staff\Http\Resources\Traits\TransformsVacancies;
use Illuminate\Http\Resources\Json\Resource;

/**
 * Class Vacancy.
 *
 * @package Acacha\Scool\Staff\Http\Resources
 */
class Vacancy extends Resource
{
    use TransformsVacancies;

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return $this->transformVacancy($this);
    }

}
