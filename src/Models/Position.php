<?php

namespace Acacha\Scool\Staff\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Position.
 *
 * @package Acacha\Scool\Staff\Models
 */
class Position extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * The teachers that have this position assigned.
     */
    public function teachers()
    {
        return $this->belongsToMany(Teacher::class);
    }
}
