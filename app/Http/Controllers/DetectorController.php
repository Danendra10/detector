<?php

namespace App\Http\Controllers;

use App\Models\CamConfig;
use App\Models\Meteran;
use App\Models\Unit;
use Illuminate\Http\Request;

class DetectorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $units = Unit::all();
        $meteran_type = CamConfig::all();
        return view('trial', compact('units', 'meteran_type'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $month = date('m');
        $year = date('Y');
        $request->merge([
            'month' => $month,
            'year' => $year,
        ]);
        $input = $request->all();
        // dd($request->all());
        if ($request->hasFile('foto_bukti') && $request->file('foto_bukti')->isValid()) {
            $meteran = Meteran::create($input);
            $meteran->addMediaFromRequest('foto_bukti')->toMediaCollection('foto_bukti');
            return redirect()->route('detector.index')->with('success', 'Data berhasil ditambahkan');
        }
        return redirect()->route('detector.index')->with('error', 'Data gagal ditambahkan, Foto bukti tidak boleh kosong');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
