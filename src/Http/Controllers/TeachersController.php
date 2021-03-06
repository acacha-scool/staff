<?php

namespace Acacha\Scool\Staff\Http\Controllers;

use Acacha\Scool\Staff\Http\Controllers\Traits\CanDisablePagination;
use Acacha\Scool\Staff\Models\Teacher;
use Acacha\Scool\Staff\Http\Resources\Teachers as TeachersCollection;
use Illuminate\Http\Request;

/**
 * Class TeachersController.
 *
 * @package Acacha\Scool\Staff\Http\Controllers
 */
class TeachersController extends Controller
{
    use CanDisablePagination;

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function index( Request $request)
    {
        $this->authorize('list-teachers');
        if ( $this->paginationIsDisabled($request) ) {
            return new TeachersCollection(Teacher::all());
        }
        return new TeachersCollection(Teacher::paginate());
    }

}
