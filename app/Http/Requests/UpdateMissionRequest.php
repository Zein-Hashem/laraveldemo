<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateMissionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'driver_id'      => 'sometimes|exists:drivers,id',
            'vehicle_id'     => 'sometimes|exists:vehicles,id',
            'address'        => 'sometimes|string|max:255',
            'description'    => 'sometimes|string',
            'estimated_time' => 'sometimes|timestamp',
            'final_time'     => 'nullable|date|after_or_equal:estimated_time',
        ];
    }
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message_1' => 'Validation failed.',
            'errors' => $validator->errors(),
        ], 422));
    }
}
