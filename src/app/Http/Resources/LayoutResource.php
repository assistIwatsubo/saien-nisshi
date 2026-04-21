<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LayoutResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'layoutId'  => $this->id,
            'year'      => $this->year,
            'title'     => $this->title,
            'fieldId'   => $this->field_id,
            'fieldName' => $this->field->name,
            'direction' => $this->direction,
            'gap'       => $this->gap,
            'memo'      => $this->memo,
            'ridges'    => $this->ridges
                ? $this->ridges->map(fn ($ridge) => [
                    'ridgeId'  => $ridge->id,
                    'name'     => $ridge->name,
                    'size'     => $ridge->size,
                    'position' => $ridge->position,
                    'ridgeDetails' => $ridge->ridgeDetails
                        ? $ridge->ridgeDetails->map(fn ($detail) => [
                            'ridgeDetailId' => $detail->id,
                            'cropName'      => $detail->crop->name,
                            'position'         => $detail->position,
                            'ratio'         => $detail->ratio,
                        ])->values()
                        : null,
                ])->values()
                : null,
        ];
    }
}

