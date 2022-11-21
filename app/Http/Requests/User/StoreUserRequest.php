<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->role === "admin";
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['required', 'min:3', 'max:80'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'confirmed', 'min:6'],
            'role' => ['required', 'in:employee,approver,admin'],
            'team_id' => ['exclude_if:role,admin', 'exists:teams,id'],
            'approver_role' => ['exclude_if:role,admin', 'exclude_if:role,employee'],
            'remaining_vacation_days' => ['exclude_if:role,approver', 'exclude_if:role,admin', 'gt:0']
        ];
    }
}
