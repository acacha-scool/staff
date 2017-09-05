<?php

namespace Acacha\Scool\Staff\Http\Controllers;

use Acacha\Scool\Staff\Http\Controllers\Traits\CanDisablePagination;
use Acacha\Scool\Staff\Models\Vacancy;
use Acacha\Scool\Staff\Http\Resources\Vacancies as VacancyCollection;
use Illuminate\Http\Request;

/**
 * Class VacanciesController.
 *
 * @package Acacha\Scool\Staff\Http\Controllers
 */
class VacanciesController extends Controller
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
        $this->authorize('list-vacancies');
        if ( $this->paginationIsDisabled($request) ) {
            return new VacancyCollection(Vacancy::all());
        }
        return Vacancy::paginate();
    }

}
