<?php

namespace Acacha\Scool\Staff\Http\Resources;

use Acacha\Scool\Staff\Http\Resources\Traits\TransformsTeachers;
use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * Class Teachers.
 *
 * @package App\Http\Resources
 */
class Teachers extends ResourceCollection
{
    use TransformsTeachers;

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => $this->collection->map(function ($teacher, $key) {
                return $this->transformTeacher($teacher);
            }),
            'meta' => [
                'total' => count($this->collection)
            ]
        ];
    }
}
