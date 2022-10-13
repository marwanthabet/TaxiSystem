<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = City::all();
        return response()->view('cms.cities.index' , ['cities' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return response()->view('cms.cities.create');
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
        //dd($request->all());
        $request->validate([
            'name' => 'required|min:3|max:40'
        ], [
            'name.required' => 'Enter city name please.'
        ]);
        $city = new City();
        $city->name = $request->input('name');
        $isSaved = $city->save();
        return redirect()->route('cities.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function show(City $city)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function edit(City $city)
    {
        //
        return response()->view('cms.cities.edit', ['city' => $city]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, City $city)
    {
        //
        $request->validate([
            'name' => 'required|min:3|max:40'
        ]);

        $city->name = $request->input('name');
        $isSaved = $city->save();
        session()->flash('message', $isSaved ? "City updated" : "City update failed");
        session()->flash('status', $isSaved);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy(City $city)
    {
        //
        $isDeleted = $city->delete();
        return response()->json([
            'icon' => $isDeleted ? 'success' : 'error', 
            'title' => $isDeleted ? 'Deleted successfully' : 'Delete failed'  
        ], $isDeleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
    );
        //return redirect()->back();
    }
}
