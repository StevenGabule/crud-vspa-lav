<?php

namespace App\Http\Requests\Location;

use Illuminate\Foundation\Http\FormRequest;

class StoreLocationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'participant_id' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'address' => 'required',
            'city' => 'required',
            'country' => 'required',
        ];
    }
}
