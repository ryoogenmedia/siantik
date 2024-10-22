<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CetakLaporanController extends Controller
{
    public function admin(Request $request)
    {
        $data = [];

        $data = User::query()
            ->where('roles', 'personnel')
            ->where(function ($query) use ($request) {
                $query->whereHas('permissions', function ($query) use ($request) {
                    $query->when($request->date_start, function ($query, $date_start) {
                        $query->where('created_at', '>=', \Carbon\Carbon::parse($date_start));
                    })
                        ->when($request->date_end, function ($query, $date_end) {
                            $query->where('created_at', '<=', \Carbon\Carbon::parse($date_end)->endOfDay());
                        })
                        ->when($request->bulan, function ($query, $bulan) {
                            $query->whereMonth('created_at', $bulan);
                        });
                })
                    ->orWhereHas('attendances', function ($query) use ($request) {
                        $query->when($request->date_start, function ($query, $date_start) {
                            $query->where('created_at', '>=', \Carbon\Carbon::parse($date_start));
                        })
                            ->when($request->date_end, function ($query, $date_end) {
                                $query->where('created_at', '<=', \Carbon\Carbon::parse($date_end)->endOfDay());
                            })
                            ->when($request->bulan, function ($query, $bulan) {
                                $query->whereMonth('created_at', $bulan);
                            });
                    });
            })->get();

        $pdf = \PDF::loadView('pdf.report-admin', [
            'date_start' => $request->date_start ? Carbon::parse($request->date_start) : null,
            'date_end' => $request->date_end ? Carbon::parse($request->date_end) : null,
            'bulan' => $request->bulan,
            'data' => $data,
        ]);

        $pdf->setPaper('a4', 'portrait');

        return $pdf->stream("cetak-laporan-" . "-" . $request->bulan ?? '' . ".pdf");
    }

    public function leader() {}
}
