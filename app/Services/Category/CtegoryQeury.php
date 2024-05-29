<?php

namespace  App\Services\Category;

use App\Models\Domain;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use App\Http\Requests\CategoryRequest;

class CtegoryQeury {

    public function allDomains(){
        $domains = Domain::all();

        return $domains;
    }

    public function allCategories(){
        $categories = Category::paginate(10);
        return $categories;
    }

    public function storeCategory(CategoryRequest $request){
        $validatedData = $request->validated();

        $category = Category::create([
            'domainId' => $request->domainId,
            'name' => $request->name
        ]);
        
        return $category;
    }

    public function updateCategory(CategoryRequest $request, string $id)
    {
        $category = Category::findOrFail(Crypt::decrypt($id));

        $validatedData = $request->validated();

        $category->domainId = $request->domainId;
        $category->name = $request->name;

        $category->save();

    }

    public function deleteCategory(Request $request , String $id){
        $category = Category::findOrFail(Crypt::decrypt($id));

        $request->validate([
            'password' => ['required' ,  'current_password']
        ]);

        if(Hash::check( $request->password, Auth::user()->password ))
        {
            $category->delete();
        }
        return $category;
    }
    
}