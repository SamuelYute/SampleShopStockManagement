<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ItemResource;
use Illuminate\Http\Request;

/**
 * Class CategoryController
 * @package App\Http\Controllers
 */
class CategoryController extends Controller
{
    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getAll()
    {
        return CategoryResource::collection(Category::all());
    }

    public function get(Category $category)
    {
        return new CategoryResource($category);
    }

    public function getItems(Category $category)
    {
        return ItemResource::collection($category->items);
    }

    public function store(Request $request)
    {
        $this->validate($request,[
           'name' => 'required|unique:categories|max:15'
        ]);

        $category = new Category;
        $category->name = $request->name;

        $category->save();

        if(\Illuminate\Support\Facades\Request::is('api*'))
        {
            return new CategoryResource($category);
        }
        else{
            return redirect()->back();
        }
    }

    public function update(Request $request, Category $category)
    {
        $this->validate($request,[
            'name' => 'required|unique:categories,name,'.$category->id.'.|max:15'
        ]);

        $category->name = $request->name;

        $category->save();

        if(\Illuminate\Support\Facades\Request::is('api*'))
        {
            return new CategoryResource($category);
        }
        else{
            return redirect()->back();
        }
    }

    public function destroy(Category $category)
    {
        $category->delete();

        if(\Illuminate\Support\Facades\Request::is('api*'))
        {
            return true;
        }
        else{
            return redirect()->back();
        }
    }
}
