<?php

namespace Acacha\Scool\Staff\Http\Requests;

use Auth;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class StoreVacancy.
 *
 * @package Acacha\Scool\Staff\Http\Requests
 */
class StoreVacancy extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->hasPermissionTo('create-vacancies');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'speciality_id' => 'required|integer|exists:specialities,id',
            'department_id' => 'required|integer|exists:departments,id',
            'order' => 'required|integer',
            'owner' => 'required|integer|exists:teachers,id',
            'state' => 'required_with:pending,assigned',
        ];
    }
}
