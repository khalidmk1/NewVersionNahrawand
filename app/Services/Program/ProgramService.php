<?php

namespace App\Services\Program;

use App\Interfaces\ProgramInterface;
use App\Services\Program\ProgramQeury;




class ProgramService extends ProgramQeury implements ProgramInterface {
    
    public function index(){
        $categories = $this->allCategories(); 
        $programs = $this->allPrograms();
        return view('filter.program.index')->with(['categories' => $categories , 
        'programs' => $programs]);
    }



    public function store($request){
        $prgram = $this->storeProgram($request);

        return redirect()->back()->with('status', 'Program created successfully!');
    }

    public function update($request, $id){
        $program = $this->updateProgram($request,  $id);

        return redirect()->back()->with('status' , 'You Updated Program');
    }

    public function destroy($request,$id)
    {
        $program = $this->destroyProgram( $request ,  $id);

        return redirect()->back()->with('status' , 'You deleted a Program');
    }

    //api programs
    public function allProgramApi(){
        $programs = $this->allPrograms();
        return response()->json($programs);
    }

  
}