<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Field;
use Illuminate\Http\Request;

class FieldController extends Controller
{

    public function index()
    {
        $user = $this->getUser();
        $fields = $user->fields()->select('id', 'name', 'address', 'memo')->get();

        return response()->json($fields);
    }

    public function store(Request $request)
    {
        $user = $this->getUser();

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:user_fields,name,NULL,id,user_id,' . $user->id,
        ]);

        $field = Field::create([
            'user_id' => $user->id,
            'name' => $validated['name'],
        ]);

        return response()->json($field, 201);
    }

    public function update(Request $request, Field $field)
    {
        $user = $this->getUser();

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:user_fields,name,' . $field->id . ',id,user_id,' . $user->id,
        ]);

        $field->update(['name' => $validated['name']]);

        return response()->json($field);
    }

    public function destroy(Field $field)
    {
        $user = $this->getUser();

        // 所有権チェック
        if ($field->user_id !== $user->id) {
            abort(403, 'Forbidden');
        }

        $field->delete();

        return response()->json(null, 204);
    }
}
