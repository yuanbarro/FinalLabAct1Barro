<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::latest()->paginate('5');
        return view ('admin.category.category', compact('categories'));
    }

    //function for adding category
    public function AddCat(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'category_name' => 'required|unique:categories| max:255',
        ]);

        //contents to be displayed
        Category::create([
            'category_name' => $request->category_name,
            'user_id' => Auth::user()->id,
            'created_at' => Carbon::now()
        ]);
        return redirect()->back()->with('success', 'New Category Added');
    }

    public function Edit($id){
        $categories = Category::find($id);
        return view ('admin.category.editCategory', compact('categories'));
    }

    public function Update (Request $request, $id){
        $update = Category::find($id)->update([
            'category_name' => $request->category_name,
            'user_id' => Auth::user()->id
        ]);
        return Redirect ()->route('display.category')->with('success', 'Updated Successfulyy');
    }
}
