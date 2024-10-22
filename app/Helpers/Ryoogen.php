<?php

namespace App\Helpers;

use App\Models\Attendance;
use App\Models\Permission;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Ryoogen{
    public static function ATTENDANCE($date = null, $status = null, $id = null){
        $attendance = Attendance::query()
            ->when($status, function($query,  $status){
                $query->where('status_attendance', $status);
            })
            ->when($id, function($query, $id){
                $query->where('user_id', $id);
            })
            ->when($date, function($query, $date) use ($id){
                $query->whereMonth('created_at', Carbon::parse($date)->month)
                    ->whereYear('created_at', Carbon::parse($date)->year);
            }, function($query){
                $query->whereMonth('created_at', Carbon::now()->month)
                    ->whereYear('created_at', Carbon::now()->year);
            })
            ->with('akun.personnel')
            ->get();

        return $attendance;
    }

}

if (!function_exists('presensi')) {
    function presensi($id) {
        $pengguna = User::findOrFail($id);

        $hadir = 0;
        $terlambat = 0;
        $izin = 0;
        $cuti = 0;
        $tugas = 0;
        $sakit = 0;
        $pendidikan = 0;

        $permissions = Permission::where('user_id', $pengguna->id)
            ->select('status_permission', DB::raw('count(*) as total'))
            ->groupBy('status_permission')
            ->get();

        $attendances = Attendance::where('user_id', $pengguna->id)
            ->select('status_attendance', DB::raw('count(*) as total'))
            ->groupBy('status_attendance')
            ->get();

        foreach($permissions as $permission){
            switch($permission->status_permission){
                case 'hadir' :
                    $hadir += $permission->total;
                break;
                case 'terlmabat' :
                    $terlambat += $permission->total;
                break;
                case 'izin' :
                    $izin += $permission->total;
                break;
                case 'cuti' :
                    $cuti += $permission->total;
                break;
                case 'pendidikan' :
                    $pendidikan += $permission->total;
                break;
                case 'terlambat' :
                    $terlambat += $permission->total;
                break;
                case 'tugas' :
                    $tugas += $permission->total;
                break;
                case 'sakit' :
                    $sakit += $permission->total;
                break;
            }
        }

        foreach($attendances as $attendance){
            if($attendance->status_attendance == 'hadir'){
                $hadir += $attendance->total;
            }else{
                $terlambat += $attendance->total;
            }
        }

        return [
            'hadir' => $hadir,
            'terlambat' => $terlambat,
            'izin' => $izin,
            'cuti' => $cuti,
            'tugas' => $tugas,
            'pendidikan' => $pendidikan,
            'terlambat' => $terlambat,
            'sakit' => $sakit,

            'total' => $hadir + $terlambat + $izin + $cuti + $tugas + $pendidikan + $terlambat + $sakit,
        ];
    }
}
