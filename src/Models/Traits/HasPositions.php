<?php

namespace Acacha\Scool\Staff\Models\Traits;

use Acacha\Scool\Staff\Models\Charge;
use Acacha\Scool\Staff\Models\Position;

/**
 * Class HasPositions.
 */
trait HasPositions
{
    /**
     * Get the positions associated to the model.
     */
    public function positions()
    {
        return $this->belongsToMany(Position::class,'charges');
    }
}