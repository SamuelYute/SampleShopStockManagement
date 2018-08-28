<?php

namespace App\Http\Controllers;

use App\Http\Resources\ItemResource;
use App\Http\Resources\ItemStockResource;
use App\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{

    public function getAll()
    {
        return ItemResource::collection(Item::all());
    }

    public function get(Item $item)
    {
        return new ItemResource($item);
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|unique:items|max:15',
            'price' => 'required|numeric|max:999999|min:0',
            'category' => 'required|exists:categories,id'
        ]);

        $item = new Item;
        $item->name = $request->name;
        $item->price = (double)$request->price;

        $item->category()->associate($request->category);

        $item->save();

        if(\Illuminate\Support\Facades\Request::is('api*'))
        {
            return new ItemResource($item);
        }
        else{
            return redirect()->back();
        }
    }

    public function update(Request $request, Item $item)
    {
        $this->validate($request,[
            'name' => 'required|unique:items,name,'.$item->id.'.|max:15',
            'price' => 'required|numeric|max:999999|min:0',
            'category' => 'required|exits:categories',
        ]);

        $item->name = $request->name;
        $item->price = (double)$request->price;

        $item->category()->associate($request->category);

        $item->save();

        if(\Illuminate\Support\Facades\Request::is('api*'))
        {
            return new ItemResource($item);
        }
        else{
            return redirect()->back();
        }
    }

    public function destroy(Item $item)
    {
        return $item->delete();
    }
}
