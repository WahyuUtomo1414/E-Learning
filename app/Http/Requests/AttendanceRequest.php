<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AttendanceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => 'required|exists:users,id',
            'latitude' => 'required|string|max:255',
            'longitude' => 'required|string|max:255',
            'foto'  => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'desc' => 'nullable|string|max:255',
            'status_id' => 'required|exists:status,id,status_type_id,2',
        ];
    }
}
