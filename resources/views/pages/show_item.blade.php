@extends('layouts.master')

@section('content')
    <div class="row" style="margin:30px 0">
        <h1 style="text-align: center">
            Inventory Manager
        </h1>

        <h3 style="text-align: center">
            <a href="{{URL::to('/')}}">Home</a> > Item Viewer
        </h3>
    </div>

    <div class="row">
        <div class="container-fluid">
            <div class="col-md-2">
                <h3>Item Details</h3>

                <div>
                    <div>
                        <strong>Name:</strong>
                        <h4>{{$item->name}}</h4>
                    </div>

                    <div>
                        <strong>Price:</strong>
                        <h3>{{$item->price}}</h3>
                    </div>

                    <div>
                        <strong>Category:</strong>
                        <h4>{{$item->category->name}}</h4>
                    </div>

                    <div>
                        <strong>Current Available Stock:</strong>
                        <h4>{{$item->stock->where('status','Available')->count()}}</h4>
                    </div>

                    <div>
                        <strong>Created At:</strong>
                        <h4>{{$item->created_at}}</h4>
                    </div>

                    <div>
                        <strong>Updated At:</strong>
                        <h4>{{$item->updated_at->diffForHumans()}}</h4>
                    </div>

                </div>
            </div>

            <div class="col-md-8">
                <h3 style="text-align: center">Item Stock List({{$item->stock->count()}})</h3>

                <div>
                    {{ Form::open([ 'url'=>['/items/'.$item->id.'/stock'], 'method'=>'POST']) }}

                    <div class="form-group">
                        <h5 style="text-align: center">Add New Stock</h5>
                        <div class="row">
                            <div class="col-md-2 col-md-offset-1">
                                <label id="new-stock">How Much?</label>
                            </div>
                            <div class="col-md-4">
                                <input id="new-stock" type="number" name="size" class="form-control"  required/>
                            </div>
                            <div class="col-md-5">
                                <button class="btn btn-default" type="submit">Add</button>
                            </div>
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>

                <div style="background-color: white">
                    <div class="alert alert-info">
                        Each item added to stock has a unique code that can be converted  into a bar/QR code.<br>
                        <strong>Payment</strong>: To make a payment for a layaway, simply deposit an amount towards the price of any stock item.
                    </div>
                    @if($item->stock->count())
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <td>#</td>
                                    <td>Code</td>
                                    <td>Status</td>
                                    <td>Deposit</td>
                                    <td>Depositor</td>
                                    <td>CreatedAt</td>
                                    <td>UpdatedAt</td>
                                    <td>Actions</td>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($item->stock->sortByDesc('created_at') as $key => $value)
                                        <tr>
                                            <td>{{++$loop->index.'.'}}</td>
                                            <td>{{$value->code}}</td>
                                            <td><span class="badge">{{$value->status}}</span></td>
                                            <td>{{$value->deposit}}</td>
                                            <td>{{$value->depositor}}</td>
                                            <td>{{$value->created_at}}</td>
                                            <td>{{$value->updated_at->diffForHumans()}}</td>
                                            <td>
                                                @if($value->status != 'Sold')
                                                    <button class="btn btn-primary" data-toggle="modal" data-target="#deposit-modal-{{$value->id}}">Deposit</button>
                                                @endif
                                            </td>
                                        </tr>

                                            @if($value->status != 'Sold')
                                                @include('pages.deposit_modal')
                                            @endif
                                        @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <h3 style="text-align: center;padding:20px">Sadly, No stock added yet</h3>
                    @endif
                </div>
            </div>

            <div class="col-md-2">
                <h3>Comments({{$item->comments->count()}})</h3>
                <div style="background-color: white">
                    @if($item->comments->count() > 0)
                        <div style="padding:10px">
                            @foreach($item->comments as $comment)
                                <div style="border:1px solid gainsboro;border-radius: 2px; padding:5px;margin: 10px 0">
                                    <strong>{{$comment->username}}</strong><br>
                                    {{$comment->text}}
                                    <br>
                                    <div class="text-muted" style="font-size:10px;text-align: right">{{$comment->created_at->diffForHumans()}}</div>
                                </div>
                                @endforeach
                        </div>
                    @else
                        <h4 style="padding:5px">*Sigh*, No comments</h4>
                    @endif

                    <div style="padding:10px">

                        {{ Form::open([ 'url'=>['/items/'.$item->id.'/comments'], 'method'=>'POST']) }}

                        <div class="form-group">
                            <label for="username">Your Name</label>
                            <input type="text" id="username" name="username" class="form-control"/>
                        </div>

                        <div class="form-group">
                            <label for="new-comment">Leave a Comment!</label>
                            <textarea id="new-comment" name="text" class="form-control"></textarea>
                        </div>

                        <button class="btn btn-default" type="submit" style="margin:10px">Post</button>
                        {{ Form::close() }}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection