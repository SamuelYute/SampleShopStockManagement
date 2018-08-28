<?php

namespace App\Http\Controllers;

use App\Http\Resources\ItemStockResource;
use App\Item;
use App\ItemStock;
use Illuminate\Http\Request;

class ItemStockController extends Controller
{

    public function getWithStatus(Item $item, $status)
    {
        return ItemStockResource::collection($item->stock->status($status));
    }

    public function store(Request $request, Item $item)
    {
        $this->validate($request,[
            'size' => 'required|numeric|min:1'
        ]);

        for ($i = 0; $i < $request->size; $i++)
        {
            $itemStock = new ItemStock;
            $itemStock->code = $item->id.'-'.time().'-'.$i;
            $itemStock->deposit = (double)0;
            $itemStock->status = 'Available';

            $itemStock->item()->associate($item);

            $itemStock->save();
        }

        if(\Illuminate\Support\Facades\Request::is('api*'))
        {
            return new ItemStockResource($itemStock);
        }
        else{
            return redirect()->back();
        }
    }

    public function layAway(Request $request)
    {
        $this->validate($request,[
            'code' => 'required|exists:item_stocks',
            'depositor' => 'string|max:20',
            'amount' => 'required|numeric|max:999999|min:0.1',
        ]);

        $itemStock = ItemStock::where('code',$request->code)->first();

        $itemStock->depositor = $request->depositor;
        $item = $itemStock->item;

        if (($request->amount+$itemStock->deposit) > $item->price)
        {
            return redirect()->back();
        }

        $itemStock->deposit = (double)($itemStock->deposit+$request->amount);
        $itemStock->status = $itemStock->deposit < $item->price?'Layaway':'Sold';

        $itemStock->save();

        if(\Illuminate\Support\Facades\Request::is('api*'))
        {
            return new ItemStockResource($itemStock);
        }
        else{
            return redirect()->back();
        }
    }
}
