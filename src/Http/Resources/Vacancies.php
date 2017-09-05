<?php

namespace Acacha\Scool\Staff\Http\Resources;

use Acacha\Scool\Staff\Http\Resources\Traits\TransformsVacancies;
use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * Class Vacancies.
 *
 * @package App\Http\Resources
 */
class Vacancies extends ResourceCollection
{
    use TransformsVacancies;

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => $this->collection->map(function ($item, $key) {
                return $this->transformVacancy($item);
            }),
            'meta' => [
                'total' => count($this->collection)
            ]
        ];
    }
}
