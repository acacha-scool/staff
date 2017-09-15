<?php

namespace Acacha\Scool\Staff\Http\Controllers;

use Acacha\Scool\Staff\Http\Controllers\Traits\CanDisablePagination;
use Acacha\Scool\Staff\Http\Requests\StoreVacancy;
use Acacha\Scool\Staff\Http\Requests\UpdateVacancy;
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

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreVacancy $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreVacancy $request)
    {
        Vacancy::create(
            request([
                'code',
                'state',
                'speciality_id',
            ]));
        return $this->respondCreated('Vacancy');
    }


    /**
     * Update an existing resource in storage.
     *
     * @param UpdateVacancy $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateVacancy $request, $id)
    {
        $vacancy = Vacancy::findOrFail($id);

        $vacancy->update(request([
            'code',
            'state',
            'speciality_id',
        ]));
        return $this->respondUpdated('Vacancy');
    }

    /**
     * Delete a vacancy.
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $this->authorize('delete-vacancies');
        $vacancy = Vacancy::findOrFail($id);
        $vacancy->delete();
        return $this->respondDeleted('Vacancy');
    }

    /**
     * Response with a json message that resource has been correctly created.
     *
     * @param $resource
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondCreated($resource)
    {
        return response()->json([
            'message' =>  $resource . ' successfully created.'
        ], 201);
    }

    /**
     * Response with a json message that resource has been correctly updated.
     *
     * @param $resource
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondUpdated($resource)
    {
        return response()->json([
            'message' =>  $resource . ' successfully updated.'
        ], 200);
    }

    /**
     * Response with a json message that resource has been correctly deleted.
     *
     * @param $resource
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondDeleted($resource)
    {
        return response()->json([
            'message' =>  $resource . ' successfully deleted.'
        ], 200);
    }


}
