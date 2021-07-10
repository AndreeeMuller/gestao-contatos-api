<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Address::all();
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
        $request->validate([
            'state' => 'required',
            'city' => 'required',
            'district' => 'required',
            'address' => 'required',
            'postal_code' => 'required',
            'ibge_code' => 'required'
        ]);

        return Address::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Address::find($id);
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
        $address = Address::find($id);
        $address->update($request->all());
        return $address;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Address::destroy($id);
    }

    /**
     * Search for a address
     *
     * @param  string @postal_code
     * @return \Illuminate\Http\Response
     */
    public function searchByAddress($address)
    {
        return Address::whereRaw('upper(address) like ? ', [ '%'.trim(Str::upper($address)).'%' ])->get();
    }

    /**
     * Search for a postal_code
     *
     * @param  string @postal_code
     * @return \Illuminate\Http\Response
     */
    public function searchByPostalCode($postal_code)
    {
        return Address::where('postal_code', '=', $postal_code)->get();
    }
}
