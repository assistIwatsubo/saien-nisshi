<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;


class UserController extends Controller
{
    public function index()
    {
        return response()->json(User::all());
    }

    public function show($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        return response()->json($user);
    }

    public function followings()
    {
        $user = $this->getUser();
        $followings = $user->followings()->get();

        return response()->json($followings);
    }

    public function followingsWithLatestDiary(Request $request)
    {
        $user = $this->getUser();
        $limit = $request->query('limit');

        $followings = $user->followings()
            ->with(['diaries' => fn($query) => $query
            ->whereNotNull('title')
            ->latest('date')
            ->limit(1)
            ])
            ->when($limit, fn($query) => $query->limit($limit))
            ->get();

        $data = $followings->map(fn($following) => [
            'userSlug' => $following->user_slug,
            'userName' => $following->name,
            'imageUrl' => $following->profile?->image_url,
            'diaryId' => $following->diaries->first()?->id,
            'title' => $following->diaries->first()?->title,
            'date' => $following->diaries->first()?->date,
        ]);

        return response()->json($data);

    }
    
    public function followers() // 使うかわからない
    {
        $user = $this->getUser();
        $followers = $user->followers()->get();

        return response()->json($followers);
    }
}
