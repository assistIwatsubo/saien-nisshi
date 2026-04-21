<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDiaryDetailPesticideRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // 認可処理は不要なら true
    }

    public function rules(): array
    {
        return [
            'crop_name'       => ['required', 'string', 'max:255'],
            'pesticide_name'  => ['required', 'string', 'max:255'],
            'field_name'      => ['nullable', 'string', 'max:255'],
            'concentration'   => ['nullable', 'numeric', 'between:0,100'],
            'concentration_unit' => ['required_with:concentration', 'in:%,割'],
            'dilution_rate' => 'nullable|numeric|min:0|max:100',
            'amount'          => ['nullable', 'numeric', 'min:0'],
            'amount_unit'     => ['required_with:amount', 'in:L,ml,g,kg'],
            'memo'            => ['nullable', 'string', 'max:500'],
        ];
    }
}
