<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Permission;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CetakLaporanController extends Controller
{
    public function admin(Request $request){
        $kategori = $request->kategori;
        $data = [];

        $data = User::query()
            ->where('roles', 'personnel')
            ->get();

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
