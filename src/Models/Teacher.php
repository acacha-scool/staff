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
    protected $fillable = [
        'code',
        'state',
        'speciality_id',
        'user_id',
        'administrative_status_id',
        'administrative_start_year',
        'opossitions_pass_year',
        'start_date',
    ];

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
        if ( ( $this->user_id != null ) && ( $this->vacancy_id != null )) return true;
        return false;
    }

    /**
     * Get the specialities record associated with the teacher.
     */
    public function specialities()
    {
        return $this->belongsToMany(
            Speciality::class,'qualifications',
            'teacher_id',
            'speciality_id')->withTimestamps();
    }

    /**
     * Get the user record associated with the teacher.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the vacancy record associated with the teacher.
     */
    public function vacancy()
    {
        return $this->belongsTo(Vacancy::class);
    }

}

