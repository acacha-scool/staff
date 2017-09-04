<?php

namespace Acacha\Scool\Staff\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

/**
 * Class User.
 *
 * @package Acacha\Scool\Staff\Http\Resources
 */
class User extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
