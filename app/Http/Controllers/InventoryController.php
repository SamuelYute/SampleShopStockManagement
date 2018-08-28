<?php

namespace App\Http\Controllers;

use App\Category;
use App\Item;
use Illuminate\Support\Facades\Request;

class InventoryController extends Controller
{

    public function index()
    {
        $categories = Category::all();
        return view('index',compact('categories'));
    }

    public function showItem(Item $item)
    {
        return view('pages.show_item',compact('item'));
    }

}
