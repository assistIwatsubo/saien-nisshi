<?php

namespace App\Http\Controllers;
use App\Http\Resources\LayoutResource;

use Illuminate\Http\Request;

class LayoutController extends Controller
{
     public function index()
    {
        $user = $this->getUser();

        $user->load(
            'fields.layouts.field',
            'fields.layouts.ridges.ridgeDetails.crop'
        );
        $layouts = $user->fields->flatMap->layouts;

        return LayoutResource::collection($layouts);

    }
}
