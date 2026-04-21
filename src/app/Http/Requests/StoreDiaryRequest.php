<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;
use App\Http\Requests\StoreDiaryDetailPesticideRequest;

class StoreDiaryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // 認可は別ロジックでやるならここはtrue
    }

    public function rules(): array
    {
        return [
            'date'    => ['required', 'date'],
            'title'   => ['nullable', 'string', 'max:255'],
            'summary' => ['nullable', 'string'],
            'details' => ['nullable', 'array'],
            'details.*.type' => ['required', 'in:crop,pesticide,other'],
            'details.*.fields' => ['nullable', 'array'],
        ];
    }

    public function withValidator(Validator $validator)
    {
        $validator->after(function ($validator) {
            $details = $this->input('details', []);
            foreach ($details as $index => $detail) {
                if (($detail['type'] ?? null) === 'pesticide') {
                    // pesticide用ルールを適用
                    $pesticideValidator = \Validator::make(
                        $detail['fields'] ?? [],
                        (new StoreDiaryDetailPesticideRequest())->rules()
                    );

                    if ($pesticideValidator->fails()) {
                        foreach ($pesticideValidator->errors()->messages() as $field => $messages) {
                            foreach ($messages as $message) {
                                $validator->errors()->add("details.$index.fields.$field", $message);
                            }
                        }
                    }
                }
            }
        });
    }
}
