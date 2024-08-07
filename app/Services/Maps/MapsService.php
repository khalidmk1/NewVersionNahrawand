<?php

namespace App\Services\Maps;

use App\Services\Maps\MapsQuery;
use App\Interfaces\MapsInterface;

class MapsService extends MapsQuery implements MapsInterface {

    public function index(){
        $maps = $this->paginateMap();
        return view('maps.index')->with('maps' , $maps);
    }

    public function create(){
        $cities = $this->allCities();
        return view('maps.create')->with('cities' , $cities);
    }

    public function store($request){
        return $this->storeMaps($request);
    }

    public function show($id){
        $map = $this->showMap($id);
        $cities = $this->allCities();
        return view('maps.show')->with(['map' => $map , 'cities' => $cities]);
    }

    public function update($request , $id){
        $map = $this->updateMap($request , $id);
        return redirect()->back()->with('status' , 'You have updated Map');
    }

    public function destroy($request , $id){
        $map = $this->destroyMap($request , $id);
        return redirect()->route('map.index')->with('status', 'You have deleted map');
    }

    public function delete($id){
        return $this->deleteMap($id);
    }

    //api map

    public function mapAll(){
        $maps = $this->indexApi();
        return response()->json($maps); 
    }
}
