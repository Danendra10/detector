<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Meteran;

class MeteranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $meterans = Meteran::all();
        return view('meteran.index', compact('meterans'));
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
        //
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
        $curr_data = Meteran::where('id', $id)->first();
        $curr_data->delete();
        return redirect()->route('meteran-table.index')->with('success', 'Data berhasil dihapus');
    }

    public function image($id)
    {
        $curr_data = Meteran::where('id', $id)->first();
        $media_src = $curr_data->getFirstMediaUrl('foto_bukti');
        return response()->json(['media_src' => $media_src]);
    }
}
