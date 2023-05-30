<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    //redirect category list page
    public function categoryList()
    {
        $category = Category::when(request('key'), function ($query) {
            $query->where('name', 'like', '%' . request('key') . '%');
        })
            ->orderBy('created_at', 'desc')->paginate(5);
        // $category->appends($request()->all());
        return view('admin.category.list', compact("category"));
    }

    //direct category create page
    public function createPage()
    {
        return view('admin.category.create');
    }

    //create category
    public function create(Request $request)
    {
        $this->categoryValidationCheck($request);
        $data = $this->getCategoryData($request);
        Category::create($data);
        return redirect()->route('category#List')->with(['createSuccess' => 'category created successfully']);
    }

    //delete category
    public function delete($id)
    {
        Category::where('id', $id)->delete();
        return back()->with(['deleteSuccess' => 'Category deleted successfully']);
    }

    //edit category
    public function editPage($id)
    {$category = Category::where('id', $id)->first();
        return view('admin.category.edit', compact('category'));
    }

    //update category
    public function update(Request $request)
    {
        $id = $request->categoryId;

        $this->categoryValidationCheck($request);
        $data = $this->getCategoryData($request);

        Category::where('id', $id)->update($data);
        return redirect()->route('category#List');
    }

    //request category data
    private function getCategoryData($request)
    {
        return [
            'name' => $request->categoryName,
        ];
    }

    //validation category check
    private function categoryValidationCheck($request)
    {
        Validator::make($request->all(), [
            'categoryName' => 'required|unique:categories,name,' . $request->categoryId,
        ])->validate();
    }
}