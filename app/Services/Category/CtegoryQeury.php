<?php

namespace  App\Services\Category;

use App\Models\Domain;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Services\GlobaleService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\DestroyRequest;
use Illuminate\Support\Facades\Crypt;
use App\Http\Requests\CategoryRequest;

class CtegoryQeury extends GlobaleService {

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

        $existingCategory = Category::where('name', $request->name)->first();

        if($existingCategory){
            return redirect()->back()->with('faild' , ' The name has already been taken.');
        }
        $category = Category::create([
            'domainId' => $request->domainId,
            'name' => $request->name
        ]);
        
        return redirect()->back()->with('status' , 'You Create Category');
    }

    public function updateCategory(CategoryRequest $request, string $id)
    {
        $category = Category::findOrFail(Crypt::decrypt($id));

        $validatedData = $request->validated();

        $existingCategory = Category::where('name', $request->name)
        ->where('id', '!=', $category->id)
        ->first();

        if($existingCategory){
            return redirect()->back()->with('faild' , ' The name has already been taken.');
        }

        $category->domainId = $request->domainId;
        $category->name = $request->name;

        $category->save();
        
        return redirect()->back()->with('status' , 'You Update Category');
    }

    public function deleteCategory(DestroyRequest $request , String $id){

        $category = Category::findOrFail(Crypt::decrypt($id));

        $hasContent = $category->content()->exists();

        if($hasContent){
            return redirect()->back()->with('faild' , 'Cannot delete category. It is associated with content.');
        }

        if(Hash::check($request->password, Auth::user()->password ))
        {
            $category->delete();
        }

        return redirect()->back()->with('status' , 'You Delete Category');
    }

    public function restore($categoryId){
        $category = $this->restoreCategory($categoryId);
        return redirect()->back()->with('status' , 'You Have restored Category');
    }
    
}