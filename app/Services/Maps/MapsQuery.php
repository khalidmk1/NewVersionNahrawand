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

    protected function handleFileUploads($request, $map, $fieldName, $type, $descriptions = [], $titles = [], $addresses = [], $links = [])
    {
        if ($request->hasFile($fieldName) && is_array($request->file($fieldName))) {
            foreach ($request->file($fieldName) as $index => $file) {
                $imagePath = $file->store($type, 'public');
                $description = $descriptions[$index] ?? '';
                $title = $titles[$index] ?? '';
                $address = $addresses[$index] ?? '';
                $link = $links[$index] ?? '';

                MapImages::create([
                    'mapId' => $map->id,
                    'type' => $type,
                    'image' => $imagePath,
                    'description' => $description,
                    'title' => $title,
                    'adresse' => $address,
                    'link' => $link
                ]);
            }
        }
    }


    public function paginateMap(){
        $maps = Maps::paginate(9);
        return $maps;
    }

    public function allCities(){
        $cities = MapCities::all();
        return $cities;
    }

    public function storeMaps(MapRequest $request)
    {
        list($longitude, $latitude) = explode(',', $request->country);
    
        $imagePath = $request->hasFile('imagePrincipale') ? 
            $request->file('imagePrincipale')->store('map', 'public') : 
            null;
    
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
    
        $this->handleFileUploads($request, $map, 'images', 'image');
        $this->handleFileUploads($request, $map, 'plateImages', 'plate', $request->textPlate ?? []);
        $this->handleFileUploads($request, $map, 'clotheImages', 'clothe', $request->textClothes ?? []);
        $this->handleFileUploads($request, $map, 'placeImages', 'place', $request->descriptionPlace ?? [], $request->titlePlace ?? [], $request->adressePlace ?? [], $request->linkPlace ?? []);

        return redirect()->back()->with('status', 'You have created a map');
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
            if (Storage::disk('public')->exists($map->image)) {
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

        if ($request->has('titlePlace') && $request->has('descriptionPlace') 
            && $request->has('adressePlace') && $request->has('linkPlace')) {
            foreach ($request->titlePlace as $imageId => $title) {
                $image = MapImages::find($imageId);
                if ($image && $image->type == 'place') {
                    $image->update([
                        'title' => $title,
                        'description' => $request->descriptionPlace[$imageId],
                        'adresse' => $request->adressePlace[$imageId],
                        'link' => $request->linkPlace[$imageId]
                    ]);
                }
            }
        }

        $this->handleFileUploads($request, $map, 'images', 'image');
        $this->handleFileUploads($request, $map, 'plateImages', 'plate', $request->textPlate ?? []);
        $this->handleFileUploads($request, $map, 'clotheImages', 'clothe', $request->textClothes ?? []);
        $this->handleFileUploads($request, $map, 'placeImages', 'place', $request->descriptionPlace ?? [], $request->titlePlace ?? [], $request->adressePlace ?? [], $request->linkPlace ?? []);

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
                    'title' => $image->title,
                    'adresse' => $image->adresse,
                    'link' => $image->link,
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