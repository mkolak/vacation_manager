<?php

namespace App\Http\Requests\VacationRequest;

use Illuminate\Foundation\Http\FormRequest;

class StoreVacationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->role == "employee";
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'start_date' => 'required|before:end_date',
            'end_date' => 'required|after:start_date',
            'message' => 'nullable|max:200'
        ];
    }
}
