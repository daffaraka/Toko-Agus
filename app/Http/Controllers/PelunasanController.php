<?php

namespace App\Http\Controllers;

use App\Models\Pelunasan;
use App\Models\Penjualan;
use App\Models\PenjualanDetail;
use App\Http\Requests\StorePelunasanRequest;
use App\Http\Requests\UpdatePelunasanRequest;

class PelunasanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    $pelunasan = Pelunasan::all();
    return view('pelunasan/view',
                [
                    'pelunasan' => $pelunasan
                ]
                );
            }


    public function create()
    {
        $pelunasan = new Pelunasan();
        $pelunasan = new Pelunasan();

    }
    /**
     * Show the form for creating a new resource.
     */
   

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePelunasanRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Pelunasan $pelunasan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pelunasan $pelunasan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePelunasanRequest $request, Pelunasan $pelunasan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pelunasan $pelunasan)
    {
        //
    }
}
