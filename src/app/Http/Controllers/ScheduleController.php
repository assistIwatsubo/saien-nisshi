<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $start = microtime(true);

        $beforeAttempt = microtime(true);
        try {
            // JWTで認証
            $user = JWTAuth::parseToken()->authenticate();
        } catch (JWTException $e) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $afterAttempt = microtime(true);
        \Log::info('JWTAuth::attempt timing: ' . ($afterAttempt - $beforeAttempt) . 's');

        // 基本クエリ：ログインユーザーのスケジュール取得
        $query = Schedule::with('status')
            ->where('user_id', $user->id);

        // クエリパラメータで日付指定がある場合はフィルタ
        if ($request->has('date')) {
            $date = $request->query('date');

            // 日付形式チェック（YYYY-MM-DD）
            if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $date)) {
                return response()->json(['error' => 'Invalid date format. Use YYYY-MM-DD.'], 400);
            }

            $query->where(function($q) use ($date) {
                $q->whereDate('start', '<=', $date)
                ->where(function($q2) use ($date) {
                    $q2->whereDate('end', '>=', $date)
                        ->orWhereNull('end'); // 終了日がnullでも含める
                });
            });
        }
        $schedules = $query->orderBy('start', 'asc')->get();

        $end = microtime(true);
        \Log::info('Schedule login timing: ' . ($end - $start) . 's');

        return response()->json($schedules);
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
    public function show($id)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // ユーザーのスケジュールのみ取得
        $schedule = Schedule::with('status')
            ->where('user_id', $user->id)
            ->where('id', $id)
            ->first();

        if (!$schedule) {
            return response()->json(['error' => 'Not Found'], 404);
        }

        return response()->json($schedule);
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
