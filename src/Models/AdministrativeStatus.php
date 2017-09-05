<?php

namespace Acacha\Scool\Staff\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class AdministrativeStatus.
 *
 * @package Acacha\Scool\Staff\Models
 */
class AdministrativeStatus extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['code','name'];

    /**
     * The teachers that have this position assigned.
     */
    public function teachers()
    {
        return $this->belongsToMany(Teacher::class);
    }
}
