<?php

namespace App\Services\Maps;

use App\Models\Maps;
use App\Models\MapCities;
use App\Models\MapImages;
use Illuminate\Http\Request;
use App\Services\GlobaleService;
use App\Http\Requests\MapRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\DestroyRequest;
use Illuminate\Support\Facades\Crypt;
use App\Http\Requests\MapUpdateRequest;
use Illuminate\Support\Facades\Storage;


class MapsQuery extends GlobaleService {

    public function paginateMap(){
        $maps = Maps::paginate(9);
        return $maps;
    }

    public function allCities(){
        $cities = MapCities::all();
        return $cities;
    }

    public function storeMaps(MapRequest $request){
        $country = $request->input('country'); 
        
        list($longitude, $latitude) = explode(',', $request->country);

        $imagePath = null;

        if ($request->hasFile('imagePrincipale')) {
            $imagePath = $request->file('imagePrincipale')->store('map', 'public');
        }

        $map = Maps::create([
            'att' => $latitude,
            'lang' => $longitude,
            'title' => $request->title,
            'slogan' => $request->slogan,
            'image' => $imagePath,
            'date' => $request->dateEstablishe,
            'founder' => $request->founder,
            'description' => $request->description
        ]);

        if($request->hasFile('images') && is_array($request->file('images'))){
            foreach ($request->file('images') as $index => $image) {
                $imagePath = $image->store('images', 'public');
                $images = MapImages::create([
                    'mapId' => $map->id,
                    'type' => 'image',
                    'image' => $imagePath,
                ]);
            }
        
        }

        if ($request->hasFile('plateImages') && is_array($request->file('plateImages'))) {
            foreach ($request->file('plateImages') as $index => $plate) {
                $imagePath = $plate->store('plate', 'public');
                $text = $request->textPlate[$index] ?? '';

                $plateImages = MapImages::create([
                    'mapId' => $map->id,
                    'type' => 'plate',
                    'image' => $imagePath,
                    'description' => $text
                ]);
            }
        }

        if ($request->hasFile('clotheImages') && is_array($request->file('clotheImages'))) {
            foreach ($request->file('clotheImages') as $index => $clothe) {
                $imagePath = $plate->store('clothe', 'public');
                $text = $request->textClothes[$index] ?? '';

                $clotheImages = MapImages::create([
                    'mapId' => $map->id,
                    'type' => 'clothe',
                    'image' => $imagePath,
                    'description' => $text
                ]);
            }
        }

        

        return redirect()->back()->with('status' , 'You have created a map');
    }

    public function showMap(String $id){
        $map = Maps::findOrFail(Crypt::decrypt($id));
        return $map;
    }

    
    public function updateMap(MapUpdateRequest $request, String $id)
{
    $map = Maps::findOrFail(Crypt::decrypt($id));

    if ($request->country == 'select') {
        $longitude = $map->lang;
        $latitude = $map->att;
    } else {
        list($longitude, $latitude) = explode(',', $request->country);
    }

    $imagePath = $map->image;

    if ($request->hasFile('imagePrincipale')) {
        if ($map->image && Storage::disk('public')->exists($map->image)) {
            Storage::disk('public')->delete($map->image);
        }
        $imagePath = $request->file('imagePrincipale')->store('map', 'public');
    }

    $map->update([
        'att' => $latitude,
        'lang' => $longitude,
        'title' => $request->title,
        'slogan' => $request->slogan,
        'image' => $imagePath,
        'date' => $request->dateEstablishe,
        'founder' => $request->founder,
        'description' => $request->description
    ]);

    if ($request->hasFile('images') && is_array($request->file('images'))) {
        foreach ($request->file('images') as $index => $image) {
            $imagePath = $image->store('images', 'public');
            MapImages::create([
                'mapId' => $map->id,
                'type' => 'image',
                'image' => $imagePath,
            ]);
        }
    }

    if ($request->hasFile('plateImages') && is_array($request->file('plateImages'))) {
        foreach ($request->file('plateImages') as $index => $plate) {
            $imagePath = $plate->store('plate', 'public');
            $text = $request->textPlate[$index] ?? '';

            MapImages::create([
                'mapId' => $map->id,
                'type' => 'plate',
                'image' => $imagePath,
                'description' => $text
            ]);
        }
    }

    if ($request->hasFile('clotheImages') && is_array($request->file('clotheImages'))) {
        foreach ($request->file('clotheImages') as $index => $clothe) {
            $imagePath = $clothe->store('clothe', 'public');
            $text = $request->textClothes[$index] ?? '';

            MapImages::create([
                'mapId' => $map->id,
                'type' => 'clothe',
                'image' => $imagePath,
                'description' => $text
            ]);
        }
    }

    if ($request->has('textClothes')) {
        foreach ($request->textClothes as $imageId => $description) {
            $image = MapImages::find($imageId);
            if ($image && $image->type == 'clothe') {
                $image->update(['description' => $description]);
            }
        }
    }

    if ($request->has('textPlate')) {
        foreach ($request->textPlate as $imageId => $description) {
            $image = MapImages::find($imageId);
            if ($image && $image->type == 'plate') {
                $image->update(['description' => $description]);
            }
        }
    }

    return $map;
}


    public function deleteMap(string $id){
        $image = MapImages::findOrFail(Crypt::decrypt($id));
        if (Storage::exists($image->image)) {
            Storage::delete($image->image);
        }
        $image->forceDelete();
        return response()->json('you have deleted');
    }

    public function destroyMap(DestroyRequest $request , String $id){
        $map = Maps::findOrFail(Crypt::decrypt($id));

        if(Hash::check( $request->password, Auth::user()->password ))
        {
            $map->delete();
           
        }
        return $map;
    }

    //map api 
    public function indexApi(){
        $maps = Maps::with('images')->get();

        $mapFiltred =  $maps->map(function ($map) {
            $imageFilterd = $map->images->map(function ($image){
                return [
                    'type' => $image->type,
                    'image' => $image->image,
                    'description' => $image->description,
                ];
            });
            return [
                'name' => $map->title,
                'latitude' => $map->att,
                'longitude' => $map->lang,
                'description' => $map->description,
                'image' => $map->image,
                'date' => $map->date,
                'founder' => $map->founder,
                'slogan' => $map->slogan,
                'images' =>$imageFilterd
            ];
        });

        return $mapFiltred;
    }
}