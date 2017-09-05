<?php

namespace Acacha\Scool\Staff\Models;

use Acacha\Stateful\Contracts\Stateful;
use Acacha\Stateful\Traits\StatefulTrait;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Scool\Curriculum\Models\Speciality;

/**
 * Class Vacancy.
 *
 * @package App
 */
class Vacancy extends Model implements Stateful
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
        'assigned' => ['final' => true]
    ];

    /**
     * Vacancy State Transitions
     *
     * @var array
     */
    protected $transitions = [
        'assign' => [
            'from' => ['pending'],
            'to' => 'assigned'
        ],
        'unassign' => [
            'from' => ['assigned'],
            'to' => 'pending'
        ]
    ];

    /**
     * Validate activate.
     *
     * @return bool
     */
    protected function validateAssign()
    {
        if (! $this->users->isEmpty()) return true;
        return false;
    }

    /**
     * Get the speciality record associated with the teacher vacancy.
     */
    public function speciality()
    {
        return $this->belongsTo(Speciality::class);
    }

    /**
     * Get the users record associated with the teacher vacancy.
     * Multiple teacher could have the same vacancy (substitutes).
     */
    public function users()
    {
        return $this->belongsTo(User::class)->using(Teacher::class);
    }
}
