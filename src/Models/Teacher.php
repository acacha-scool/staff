<?php

namespace Acacha\Scool\Staff\Models;

use Acacha\Stateful\Contracts\Stateful;
use Acacha\Stateful\Traits\StatefulTrait;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Scool\Curriculum\Models\Speciality;

/**
 * Class Teacher.
 *
 * @package Acacha\Scool\Staff\Models
 */
class Teacher extends Model implements Stateful
{
    use StatefulTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['code', 'state', 'speciality_id'];

    /**
     * Progress States
     *
     * @var array
     */
    protected $states = [
        'pending'  => ['initial' => true],
        'unactive' ,
        'active' => ['final' => true]
    ];

    /**
     * Transaction State Transitions
     *
     * @var array
     */
    protected $transitions = [
        'activate' => [
            'from' => ['pending','unactive'],
            'to' => 'active'
        ],
        'deactivate' => [
            'from' => ['active'],
            'to' => 'unactive'
        ],
        'unfinish' => [
            'from' => ['active'],
            'to' => 'pending'
        ]
    ];

    /**
     * Validate activate.
     *
     * @return bool
     */
    protected function validateActivate()
    {
        if ( ( $this->users_id != null )) return true;
        return false;
    }

    /**
     * The positions that user have.
     */
    public function positions()
    {
        return $this->belongsToMany(Position::class);
    }

    /**
     * Get the speciality record associated with the teacher.
     */
    public function speciality()
    {
        return $this->belongsTo(Speciality::class);
    }

    /**
     * Get the user record associated with the teacher.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}

