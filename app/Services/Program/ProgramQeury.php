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

        if ($request->has('tags')) {
            $tags = $validatedData['tags'];
            foreach ($tags as $tag) {
                $program->attachTag($tag, 'program'); // Attach with type 'program'
            }
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
        
        if ($request->has('tags')) {
            $tags = $validatedData['tags'];
            $program->syncTags($tags, 'program');
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




    
}