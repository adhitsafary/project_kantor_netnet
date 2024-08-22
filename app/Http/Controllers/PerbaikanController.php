<?php

namespace App\Http\Controllers;

use App\Models\Netnet;
use App\Models\Perbaikan;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Export\PerbaikanExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;


class PerbaikanController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function login()
    {
        return view('auth.login');
    }




    public function index(Request $request)
    {
        $query = Perbaikan::query();

        // Filtering
        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        // Pencarian
        if ($request->filled('search')) {
            $query->where('id_plg', 'like', '%' . $request->search . '%')
                ->orWhere('nama_plg', 'like', '%' . $request->search . '%');
        }

        // Sorting
        $sort = $request->get('sort', 'asc');
        $query->orderBy('created_at', $sort);

        $perbaikan = $query->get();

        // Data for charts
        $weeklyData = $query->selectRaw('WEEK(created_at) as week, COUNT(*) as total')
            ->groupBy('week')
            ->pluck('total', 'week');

        $monthlyData = $query->selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->groupBy('month')
            ->pluck('total', 'month');

        $yearlyData = $query->selectRaw('YEAR(created_at) as year, COUNT(*) as total')
            ->groupBy('year')
            ->pluck('total', 'year');

        return view('perbaikan.index', compact('perbaikan', 'sort', 'weeklyData', 'monthlyData', 'yearlyData'));
    }



    public function exportPdf(Request $request)
    {
        $query = Perbaikan::query();

        // Tambahkan filter jika perlu

        $perbaikan = $query->get();

        $pdf = Pdf::loadView('perbaikan.pdf', compact('perbaikan'));

        return $pdf->download('perbaikan.pdf');
    }

    /* public function exportExcel(Request $request)
    {
        return Excel::download(new PerbaikanExport($request), 'perbaikan.xlsx');
    } */


    public function create()
    {
        return view('perbaikan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $perbaikan = new Perbaikan();
        $perbaikan->id_plg = $request->id_plg;
        $perbaikan->nama_plg = $request->nama_plg;
        $perbaikan->alamat_plg = $request->alamat_plg;
        $perbaikan->no_telepon_plg = $request->no_telepon_plg;
        $perbaikan->paket_plg = $request->paket_plg;
        $perbaikan->odp = $request->odp;
        $perbaikan->maps = $request->maps;
        $perbaikan -> save();

        // Redirect kembali ke halaman pelanggan dengan pesan sukses
        return redirect()->route('perbaikan.index')->with('success', 'Data perbaikan berhasil ditambahkan');
    }




    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $perbaikan = Perbaikan::findOrFail($id);
        return view('perbaikan.edit', compact('perbaikan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $perbaikan = Perbaikan::findOrFail($id);
        $perbaikan->id_plg = $request->id_plg;
        $perbaikan->nama_plg = $request->nama_plg;
        $perbaikan->alamat_plg = $request->alamat_plg;
        $perbaikan->no_telepon_plg = $request->no_telepon_plg;
        $perbaikan->paket_plg = $request->paket_plg;
        $perbaikan->odp = $request->odp;
        $perbaikan->maps = $request->maps;
        $perbaikan->update();

        return redirect()->route('perbaikan.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $perbaikan = Perbaikan::findOrFail($id);
        $perbaikan->delete();

        return redirect()->route('perbaikan.index');
    }
}
