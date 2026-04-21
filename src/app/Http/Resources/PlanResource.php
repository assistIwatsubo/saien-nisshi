<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PlanResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        // $this は Collection を想定
        $first = $this->first();

        return [
            'fieldId'   => $first->field->id,
            'fieldName' => $first->field->name,
            'cropId'    => $first->crop->id,
            'cropName'  => $first->crop->name,
            
            'plans' => $this->map(fn ($p) => [
                'month'  => $p->month,
                'action' => $p->action,
            ])->values(),
        ];
    }
}
