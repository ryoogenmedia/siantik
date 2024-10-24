<?php

namespace App\Helpers;

use App\Models\Attendance;
use Carbon\Carbon;

class Maps
{
    public static function ATTENDANCE($date = null, $status = null, $id = null)
    {
        $attendance = Attendance::query()
            ->when($status, function ($query,  $status) {
                $query->where('status_attendance', $status);
            })
            ->when($id, function ($query, $id) {
                $query->where('user_id', $id);
            })
            ->when($date, function ($query, $date) use ($id) {
                $query->whereMonth('created_at', Carbon::parse($date)->month)
                    ->whereYear('created_at', Carbon::parse($date)->year);
            }, function ($query) {
                $query->whereMonth('created_at', Carbon::now()->month)
                    ->whereYear('created_at', Carbon::now()->year);
            })
            ->with('akun.personnel')
            ->get();

        return $attendance;
    }
}
