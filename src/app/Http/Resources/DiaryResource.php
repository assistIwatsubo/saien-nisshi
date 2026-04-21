<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\DiaryDetailResource;

class DiaryResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'diaryId' => $this->id,
            'date' => $this->date,
            'title' => $this->title,
            'summary' => $this->summary,
            'details' => $this->diaryDetails ?                 DiaryDetailResource::collection($this->diaryDetails) : null,
        ];
    }
}
