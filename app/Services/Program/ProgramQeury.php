<?php

namespace App\Services\Program;

use App\Models\Program;
use App\Models\ProgramCategory;
use App\Services\GlobaleService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\DestroyRequest;
use App\Http\Requests\ProgramRequest;
use Illuminate\Support\Facades\Crypt;


class ProgramQeury extends GlobaleService {


    public function allPrograms(){
        $programs = Program::with('tags')->get(['id' , 'title' , 'description']);
        return $programs;
    }
 
    public function storeProgram(ProgramRequest $request)
    {
        $validatedData = $request->validated();

        $program = Program::create([
            'title' => $validatedData['title'],
            'description' => $validatedData['description']
        ]);

        $categoryIds = array_map('intval', $validatedData['categoryId']);

        foreach ($categoryIds as $categoryId) {
            ProgramCategory::create([
                'categoryId' => $categoryId,
                'programId' => $program->id
            ]);
        }

        if ($request->has('tags') && $request->tags[0] !== null) {
            $StringTag = $request->tags[0];
            $tags = explode(',', $StringTag);
            $arrTags = array_map('trim', $tags);
            $program->syncTags($arrTags, 'program');
        }

        return $program;
    }



    public function updateProgram(ProgramRequest $request, String $id)
    {

        $program = Program::findOrFail(Crypt::decrypt($id));
        
        $validatedData = $request->validated();
        $program->title = $validatedData['title'];
        $program->description = $validatedData['description'];
        $program->save();
        
        $categoryIds = array_map('intval', $validatedData['categoryId']);
        
        $program->programcategory()->forceDelete(); 
        
        foreach ($categoryIds as $categoryId) {
            ProgramCategory::create([
                'categoryId' => $categoryId,
                'programId' => $program->id
            ]);
        }
    

        if ($request->has('tags') && $request->tags[0] !== null) {
            $StringTag = $request->tags[0];
            $tags = explode(',', $StringTag);
            $arrTags = array_map('trim', $tags);
            $program->syncTags($arrTags, 'program');
        }
        
        return $program;
    }

    public function destroyProgram(DestroyRequest $request , String $id)
    {
        $program = Program::findOrFail(Crypt::decrypt($id));

        if (Hash::check($request->password, Auth::user()->password)) {
            $program->delete();
        }
        return $program;
    }


    //program api
    public function allProgramsApi(){
        $programs = Program::with(['tags', 'programcategory.category'])->get(['id', 'title', 'description']);

        $filteredPrograms = $programs->map(function ($program) {
            return [
                'id' => $program->id,
                'title' => $program->title,
                'description' => $program->description,
                'tags' => $program->tags->pluck('name'), 
                'categories' => $program->programcategory->map(function ($programCategory) {
                    return [
                        'id' => $programCategory->category->id ,
                        'name' => $programCategory->category->name,
                    ];
                }),
            ];
        });
    
        return $filteredPrograms;
    }



    
}