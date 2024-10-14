<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Permission;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CetakLaporanController extends Controller
{
    public function admin(Request $request){
        $kategori = $request->kategori;
        $data = [];

        if($kategori == 'izin'){
            $data = Permission::query()
                ->when($request->date_start, function($query, $tanggalMulai){
                    $query->where('created_at', '>=', Carbon::parse($tanggalMulai));
                })
                ->when($request->date_end, function($query, $tanggalSelesai){
                    $date_end = \Carbon\Carbon::parse($tanggalSelesai)->endOfDay();
                    $query->where('created_at', '<=', $date_end);
                })
                ->when($request->bulan, function($query, $bulan){
                    $query->whereMonth('created_at', $bulan)
                        ->whereYear('created_at', now()->year);
                })->get();
        }

        if($kategori == 'kehadiran'){
            $data = Attendance::query()
            ->when($request->date_start, function($query, $tanggalMulai){
                $query->where('created_at', '>=', Carbon::parse($tanggalMulai));
            })
            ->when($request->date_end, function($query, $tanggalSelesai){
                $date_end = \Carbon\Carbon::parse($tanggalSelesai)->endOfDay();
                $query->where('created_at', '<=', $date_end);
            })
            ->when($request->bulan, function($query, $bulan){
                $query->whereMonth('created_at', $bulan)
                    ->whereYear('created_at', now()->year);
            })->get();
        }

        $pdf = \PDF::loadView('pdf.report-admin', [
            'date_start' => $request->date_start ? Carbon::parse($request->date_start) : null,
            'date_end' => $request->date_end ? Carbon::parse($request->date_end) : null,
            'kategori' => $request->kategori,
            'bulan' => $request->bulan,
            'data' => $data,
        ]);
        $pdf->setPaper('a4', 'portrait');

        return $pdf->stream("cetak-laporan-" . "-" . strtolower($request->kategori) . "-" . $request->bulan ?? '' . ".pdf");
    }

    public function leader(){

    }
}
