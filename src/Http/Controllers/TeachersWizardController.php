<?php

namespace Acacha\Scool\Staff\Http\Controllers;

use Acacha\Scool\Staff\Models\Teacher;
use Acacha\Scool\Staff\Http\Resources\Teacher as TeacherResource;
use Acacha\Scool\Staff\Http\Resources\Teachers as TeachersCollection;
use Illuminate\Http\Request;

/**
 * Class TeachersWizardController.
 *
 * @package Acacha\Scool\Staff\Http\Controllers
 */
class TeachersWizardController extends Controller
{
    /**
     * Show wizard.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index2()
    {
        $this->authorize('assign-user-to-teacher');

        return view('acacha_scool_staff::assign-user-to-teacher');
    }

    /**
     * Show wizard.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('acacha_scool_staff::teacher_wizard');
    }

}
