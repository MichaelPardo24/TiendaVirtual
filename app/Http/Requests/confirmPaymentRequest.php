<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class confirmPaymentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|regex:/^[\pL\s\-]+$/u',
            'num' => 'required|integer|digits:16',
            'expirationMonth' => ["required", Rule::in([
                '01',
                '02',
                '03',
                '04',
                '05',
                '06',
                '07',
                '08',
                '09',
                '10',
                '11',
                '12',
                ])],
            'expirationYear' => ["required", Rule::in([
                '2022',
                '2023',
                '2024',
                '2025',
                '2026',
                '2027',
                '2028',
                '2029'
                ])],
            'securityCode' => 'required|integer|digits:3'
        ];
    }
}
