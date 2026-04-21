<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\CropFieldResource;
use App\Http\Resources\DiaryDetailPesticideResource;

class DiaryDetailResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'detailId' => $this->id,
            'position' => $this->position,
            'type' => $this->type,
            'cropFieldId' => match($this->type) {
                'crop' => $this->diaryDetailCrop?->cropField?->crop->id,
                'pesticide' => $this->diaryDetailPesticide?->cropField?->crop->id,
                default => null,
            },
            'cropName' => match($this->type) {
                'crop' => $this->diaryDetailCrop?->cropField?->crop->name,
                'pesticide' => $this->diaryDetailPesticide?->cropField?->crop->name,
                default => null,
            },
            'fieldName' => match($this->type) {
                'crop' => $this->diaryDetailCrop?->cropField?->field->name,
                'pesticide' => $this->diaryDetailPesticide?->cropField?->field->name,
                default => null,
            },
            'pesticide' => $this->when(
                $this->type === 'pesticide',
                fn() => new DiaryDetailPesticideResource($this->whenLoaded('diaryDetailPesticide'))
            ),
            'memo' => $this->memo,
        ];
    }
}
