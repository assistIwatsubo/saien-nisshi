<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\UserResource;

class MeResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'userId' => $this->id,
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
            'followings' => $this->followings ?  UserResource::collection(
                $this->followings->where('id', '!=', $this->id)
            ) : null,
        ];
    }
}
