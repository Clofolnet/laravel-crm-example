<?php

namespace App\Http\Requests\Student;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreStudentRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'contract_type' => 'required|integer',
            'name' => 'required|string|max:30',
            'surname' => 'required|string|max:30',
            'middle_name' => 'required|string|max:30',
            'birth_of_date' => 'required|date',
            'email' => 'required|email',
            'address' => 'required|string',
            'phone' => 'required|string|max:17',
            'passport_series' => 'required|string|max:2',
            'passport_number' => 'required|string|max:7',
            'PIN' => 'required|string|max:14',
            'region_id' => 'required|integer',
            'authority' => 'required|string',
            'major_id' => 'required|integer',
            'gender' => 'required|integer',
            'discount' => 'required|boolean',
            'percent' => 'decimal:2|nullable',
            'discount_from' => 'date|nullable',
            'discount_to' => 'date|nullable',
            'super_contract' => 'required|boolean',
            'super_contract_sum' => 'integer|nullable',
            'passport_document' => 'required|file|mimes:pdf, heif, hevc',
            'IELTS_document' => 'required|file|mimes:pdf, heif, hevc',
            'contract_document' => 'file|mimes:pdf|nullable',
            'status' => 'integer|nullable',
            'comment_id' => 'integer|nullable',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => 'Validation errors',
            'data' => $validator->errors()
        ], 400));
    }
}
