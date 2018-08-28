@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row" style="margin-top:30px">
            <h2 style="text-align: center">
                Welcome to the SHOP Inventory Manager
            </h2>
        </div>

        <div class="row">
            <div class="container">
                <div class="col-md-3 col-md-offset-4">
                    {{ Form::open([ 'url'=>['/items'], 'method'=>'POST']) }}
                    <div class="row">
                        <h3>New Item</h3>
                        <div class="container">
                            <div class="col-md-2">
                                <label for="item-name">Name</label>
                                <input id="item-name" type="text" name="name" class="form-control">
                            </div>
                            <div class="col-md-2">
                                <label for="item-price">Price</label>
                                <input id="item-price" type="number" name="price" class="form-control">
                            </div>
                            <div class="col-md-2">
                                <label for="item-category">Category</label>
                                <select id="item-category" name="category" class="form-control">
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <br>
                                <button class="btn btn-success" type="submit">Add</button>
                            </div>
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>

        <div id="home-page-wrapper">

        </div>
    </div>
@endsection