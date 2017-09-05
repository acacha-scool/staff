<?php

namespace Acacha\Scool\Staff\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * Class Qualification.
 *
 * @package Acacha\Scool\Staff\Models
 */
class Qualification extends Pivot
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['main'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'qualifications';
}
