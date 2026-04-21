<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'userName' => $this->name,
            'userSlug' => $this->user_slug,
            'imageUrl' => $this->profile?->image_url,
            'nickname' => $this->profile?->nickname,
            'prefecture' => $this->profile?->prefecture ? [
                'prefectureId' => $this->profile->prefecture->id,
                'prefectureName' => $this->profile->prefecture->name,
                'prefectureRegion' => $this->profile->prefecture->region,
            ] : null,
            'favoriteCrop' => $this->profile?->favoriteCrop ? [
               'cropId' =>  $this->profile->favoriteCrop->id,
               'cropName' =>  $this->profile->favoriteCrop->name,
            ] : null,
            'currentModeData' => $this->currentModeData,
        ];
    }
}
