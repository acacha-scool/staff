<?php

namespace Acacha\Scool\Staff\Http\Controllers;

use Illuminate\Http\Request;

/**
 * Class TeachersUserController.
 *
 * @package Acacha\Scool\Staff\Http\Controllers
 */
class TeachersUserController extends Controller
{
    public function index()
    {
        $this->authorize('assign-user-to-teacher');

        return view('acacha_scool_staff::assign-user-to-teacher');
    }
}
