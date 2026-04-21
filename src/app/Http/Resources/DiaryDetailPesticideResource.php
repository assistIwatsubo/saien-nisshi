<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DiaryDetailPesticideResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'pesticideId' => $this->pesticide->id,
            'pesticideName' => $this->pesticide->name,
            'amount' => $this->amount,
            'amountUnit' => $this->amount_unit,
            'concentration' => $this->concentration,
            'concentrationUnit' => $this->concentration_unit,
            'dilurationRate' => $this->diluration_rate,
        ];
    }
}
