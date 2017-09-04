<?php

namespace Acacha\Scool\Staff\Http\Controllers;

use Acacha\Scool\Staff\Models\Teacher;
use Acacha\Scool\Staff\Http\Resources\Teacher as TeacherResource;
use Acacha\Scool\Staff\Http\Resources\Teachers as TeachersCollection;
use Illuminate\Http\Request;

/**
 * Class TeachersController.
 *
 * @package Acacha\Scool\Staff\Http\Controllers
 */
class TeachersController extends Controller
{

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
//            return Teacher::all();
            return new TeachersCollection(Teacher::all());
        }
        return Teacher::paginate();
    }

    /**
     * Check if pagination is disabled.
     *
     * @param Request $request
     * @return bool
     */
    protected function paginationIsDisabled(Request $request) {
        return $request->has('paginate') && ($request->input('paginate') === "false");
    }
}
