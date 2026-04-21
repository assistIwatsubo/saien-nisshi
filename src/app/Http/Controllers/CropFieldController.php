<?php

namespace App\Http\Controllers;

use App\Models\CropField;
use Illuminate\Http\Request;

class CropFieldController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = $this->getUser(); 

        // user_fields テーブルの user_id に基づいて関連する CropField を取得
        $cropFields = CropField::with('crop') // crop_id に関連する Crop を取得
            ->whereHas('field', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->get();

        // crop_name を追加して返す
        $cropFieldsWithNames = $cropFields->map(function ($fieldCrop) {
            return [
                'id' => $fieldCrop->id,
                'fieldId' => $fieldCrop->field_id,
                'cropName' => $fieldCrop->crop->name, // crop_name を取得
                'createdAt' => $fieldCrop->created_at,
                'updatedAt' => $fieldCrop->updated_at,
            ];
        });

        return response()->json($cropFieldsWithNames);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
