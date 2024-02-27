@extends('layouts.main')
@section('content')

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.0.0-beta3/css/all.min.css" integrity="sha384-..." crossorigin="anonymous">

</head>
<style>
    /* Add this CSS to your styles file or in a <style> tag in your HTML */

    .card {
        border: 1px solid #ccc;
        border-radius: 8px;
        margin: 10px;
        padding: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        width: 300px;
        transition: transform 0.2s;
        flex: 1;
        width: calc(33.33% - 20px);
        /* 20px for margin and gap */
        box-sizing: border-box;
        margin-bottom: 20px;
    }

    .card:nth-child(4),
    .card:nth-child(5),
    .card:nth-child(6) {
        margin-top: 20px;
        /* Add a margin at the top of the cards in the second row */
        order: 1;
        /* Change the order of cards in the second row */
    }


    .card-header {
        background-color: #3498db;
        color: #fff;
        padding: 8px;
        border-radius: 8px 8px 0 0;
    }

    .card-body {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
    }

    .card-body img {
        width: 100px;
        height: auto;
        border-radius: 4px;
    }

    .card-footer {
        background-color: #ecf0f1;
        padding: 8px;
        border-radius: 0 0 8px 8px;
    }

    .card-container {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        justify-content: space-between;
        /* Adjust the gap as needed */
    }



    .plus {
        background-color: #ecf0f1;
        cursor: pointer;
        border-radius: 8px;
        margin-right: 8px;
    }

    .plus:hover {
        background-color: #ccc;
    }

    .message-container {
        width: 100%;
        height: 30px;
        background-color: #3498db;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 15px;
    }

    .message {
        color: #333;
        /* Adjust the text color as needed */
    }

    .form-container {
        display: inline-block;
        margin-right: 2px;
        /* Adjust as needed */
    }
</style>

@if(session()->has('message'))
<div class="message-container">
    <p class="message">{{ session('message') }}</p>
</div>
@endif

<p>Total:{{$data['total']}} @if($data['total']>0) $ @endif
</p>

<p>item:
    @if($data['totalQuantity'])
    {{$data['totalQuantity']}}
    @else
    0
    @endif
</p>
<div class="card-container">
    @foreach($data['users'] as $user)
    @foreach($user->productss as $product)
    <div class="card">
        <div class="card-header">
            <h3>{{ $product->name }}</h3>
        </div>
        <div class="card-body">
            @foreach($product->images as $image)
            <img src="{{ asset('/image/'. $image->images) }}" alt="Product Image">
            @endforeach
        </div>
        <div class="card-footer">
            <p>User: {{ $product->user->name }}</p>

            <p>Description:
                {{ $product->description}}
            </p>
            <p>Price: {{ $product->price }}$</p>

            <div class="form-container">
                <form action="{{ route('delete.cart', $product) }}" method="post">
                    @csrf
                    <button class="plus">
                        <i class="fa-solid fa-minus"></i> Delete to Cart
                    </button>
                </form>
            </div>

            <div class="form-container">

                <form action="{{route('increment.cart',$product)}}" method="post">
                    @csrf
                    <button class="plus" type="submit">
                        <i class="fa-solid fa-plus"></i>
                    </button>
                </form>

                {{$product->pivot->quantity}}
                @if($product->pivot->quantity > 1)

                <form action="{{route('decrement.cart',$product)}}" method="post">
                    @csrf
                    <button class="plus" type="submit">
                        <i class="fa-solid fa-minus"></i>
                    </button>
                </form>

                @endif
            </div>
        </div>
    </div>
    @endforeach
    @endforeach

</div>

@endsection