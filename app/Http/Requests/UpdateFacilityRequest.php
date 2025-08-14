<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFacilityRequest extends FormRequest
{
    public function authorize(): bool { return true; }
    public function rules(): array {
        return [
            'business_name'    => ['required','string','max:255'],
            'last_update_date' => ['required','date','before_or_equal:today'],
            'street_address'   => ['required','string','max:255'],
            'materials'        => ['array'],
            'materials.*'      => ['integer','exists:materials,id'],
        ];
    }
}
