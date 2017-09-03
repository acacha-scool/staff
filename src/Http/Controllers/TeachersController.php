<?php

namespace Acacha\Scool\Staff\Http\Controllers;

use Acacha\Scool\Staff\Models\Teacher;

/**
 * Class TeachersController.
 *
 * @package Acacha\Scool\Staff\Http\Controllers
 */
class TeachersController extends Controller
{

    /**
     * Display a listing of the resource
     *
     * @return mixed
     */
    public function index()
    {
        $this->authorize('list-teachers');
        return Teacher::paginate();
    }
}
