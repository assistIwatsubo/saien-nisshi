<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Diary;
use App\Models\DiaryDetail;
use App\Models\DiaryDetailCrop;
use App\Models\DiaryDetailPesticide;
use App\Models\Field;
use App\Http\Requests\StoreDiaryRequest;
use App\Http\Resources\DiaryResource;
use Illuminate\Http\Request;

class DiaryController extends Controller
{
    protected function saveDiaryDetails(Diary $diary, array $details, $user)
    {
        foreach ($details as $index => $detail) {
            $detail = DiaryDetail::create([
                'diary_id' => $diary->id,
                'type' => $detail['type'],
                'position' => $index,
                'memo' => $detail['memo'],
            ]);

            $fields = $detail['fields'] ?? [];

            // 圃場所有権チェック
            $fieldName = $fields['field_name'] ?? null;
            if ($fieldName && !Field::where('name', $fieldName)->where('user_id', $user->id)->exists()) {
                throw new \Exception("details.$index.fields.field_name: 指定された圃場はログインユーザーのものではありません");
            }

            match($detail['type']) {
                'crop' => DiaryDetailCrop::create(['diary_detail_id' => $detail->id],),
                'pesticide' => DiaryDetailPesticide::create(['diary_detail_id' => $detail->id],),
            }; // あとでcrop_field_idを入れないと…
        }
    }


    public function index(Request $request)
    {
        $start = microtime(true);

        $user = $this->getUser();
        $latestLimit = $request->query('latest');

        $diaries = $user->diaries()
            ->with([
                'diaryDetails.diaryDetailCrop',
                'diaryDetails.diaryDetailPesticide',
            ])
            ->orderBy('date', 'desc')
            ->when($latestLimit, fn ($query) => $query->limit($latestLimit))
            ->get();

        $end = microtime(true);
        \Log::info('Diary + Schedule timing: ' . ($end - $start) . 's');

        return DiaryResource::collection($diaries);
    }

    public function show(Diary $diary)
    {
        $this->getUser();

        $diary = $diary->load([
            'diaryDetails.diaryDetailCrop',
            'diaryDetails.diaryDetailPesticide',
        ]);

        return new DiaryResource($diary);
    }

    public function store(StoreDiaryRequest $request)
    {
        $user = $this->getUser();
        $validated = $request->validated();

        $diary = Diary::create([
            'user_id' => $user->id,
            'date' => $validated['date'],
            'title' => $validated['title'] ?? null,
            'summary' => $validated['summary'] ?? null,
        ]);

        $this->saveDiaryDetails($diary, $validated['details'] ?? [], $user);

        return response()->json($diary, 201);
    }

    public function update(StoreDiaryRequest $request, $id)
    {
        $user = $this->getUser();
        $validated = $request->validated();

        $diary = Diary::where('user_id', $user->id)->findOrFail($id);

        $diary->update([
            'title' => $validated['title'] ?? $diary->title,
            'summary' => $validated['summary'] ?? $diary->summary,
        ]);

        $this->saveDiaryDetails($diary, $validated['details'] ?? [], $user);

        return response()->json($diary, 200);
    }

    public function today()
    {
        $user = $this->getUser();

        $todayDiary = $user->diaries()->whereDate('date', today())->first();

        if (!$todayDiary) {
            return response()->json([
                'message' => '今日の日誌はまだありません。'
            ], 404);
        }

        return new DiaryResource($todayDiary);
    }

}
