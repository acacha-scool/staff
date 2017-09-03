<?php

namespace Acacha\Scool\Staff\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class JobPosition.
 *
 * @package Acacha\Scool\Staff\Models
 */
class JobPosition extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];
}
