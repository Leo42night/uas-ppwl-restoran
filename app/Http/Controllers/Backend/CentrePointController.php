<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\CenterPoint;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CentrePointController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.CentrePoint.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.CentrePoint.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'coordinate' => 'required'
        ]);

        $centerPoint = new CenterPoint;
        $centerPoint->coordinates = $request->input('coordinate');
        $centerPoint->save();

        if ($centerPoint) {
            return to_route('centre-point.index')->with('success','Data berhasil disimpan');
        } else {
            return to_route('centre-point.index')->with('error','Data gagal disimpan');
        }
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
    public function edit(CenterPoint $centrePoint)
    {
        $centrePoint = CenterPoint::findOrFail($centrePoint->id);
        return view('backend.CentrePoint.edit',['centrePoint' => $centrePoint]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CenterPoint $centrePoint)
    {
        $centrePoint = CenterPoint::findOrFail($centrePoint->id);
        $centrePoint->coordinates = $request->input('coordinate');
        $centrePoint->update();

        if ($centrePoint) {
            return to_route('centre-point.index')->with('success','Data berhasil diupdate');
        } else {
            return to_route('centre-point.index')->with('error','Data gagal diupdate');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $centrePoint = CenterPoint::findOrFail($id);
        $centrePoint->delete();
        return redirect()->back();
    }
}
