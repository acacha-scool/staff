<?php

namespace Acacha\Scool\Staff\Http\Requests;

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
        return true;
//        return $this->authorize('create-vacancies');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'code' => 'required',
            'state' => 'required_with:pending,active',
            'speciality_id' => 'required|integer',
        ];
    }
}
