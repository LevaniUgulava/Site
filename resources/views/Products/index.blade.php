@extends('layouts.main')
@section('content')

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-... (complete integrity hash)" crossorigin="anonymous" referrerpolicy="no-referrer" />

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
        /* Adjust the gap as needed */
    }

    .plus {
        background-color: #ecf0f1;
        cursor: pointer;
        border-radius: 8px;
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

    .added {
        background-color: #3498db;
        width: 140px;
        text-align: center;
        line-height: 30px;
        border-radius: 8px;
        cursor: pointer;


    }

    .added:hover {
        background-color: #096dfa;
    }

    .button-container {
        text-align: center;
        /* Adjust alignment as needed */
    }

    .delete,
    .edit,
    .private,
    .unprivate {
        display: inline-block;

        /* Adjust spacing between buttons as needed */
    }

    .delete {
        background-color: #B21807;
        cursor: pointer;
        color: #ccc;
        border: none;
        width: 30px;
        height: 30px;
        border-radius: 8px;

    }

    .delete:hover {
        background-color: red;
    }

    .edit {
        background-color: #5cb85c;
        cursor: pointer;
        color: white;
        border: none;
        width: 30px;
        height: 30px;

        border-radius: 8px;

    }

    .edit:hover {
        background-color: lightgreen;
    }

    .private {
        background-color: #ff9800;
        cursor: pointer;
        color: white;
        border: none;
        width: 30px;
        height: 30px;
        border-radius: 8px;

    }

    .private:hover {
        background-color: #ffc107;
    }

    .unprivate {
        background-color: #ffc107;
        cursor: pointer;
        color: white;
        width: 30px;
        height: 30px;
        border: none;
        border-radius: 8px;

    }

    .unprivate:hover {
        background-color: #ff9800;
    }
</style>


@if(session()->has('message'))
<div class="message-container">
    <p class="message">{{ session('message') }}</p>
</div>
@endif

<h1>Your Products:</h1>
<div class="card-container">
    @foreach($products as $product)
    <div class="card">
        <div class="card-header">
            <h3>{{ $product->name }}</h3>
        </div>
        <div class="card-body">
            @foreach($product->images as $image)
            <img src="{{ asset('/image/' . $image->images) }}" alt="Product Image">
            @endforeach
        </div>
        <div class="card-footer">
            <p>User: {{ $product->user->name }}</p>

            <p>Description:
                {{ $product->description}}
            </p>
            <p>Price: {{ $product->price }}$</p>
            <div class="button-container">
                <div class="delete">
                    <form action="{{route('delete.product',$product)}}" method="post" onsubmit="return confirm('Delete Prdouct?')">
                        @csrf
                        @method('DELETE')
                        <button class="delete">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </form>
                </div>
                <div class="edit">
                    <a href="{{route('edit.product',$product)}}">
                        <button class="edit">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </button>
                    </a>
                </div>

                @if($product->active === 1)
                <div class="unprivate">
                    <form action="{{route('unprivate',$product)}}" method="POST">
                        @csrf
                        <button class="unprivate">
                            <i class="fa-solid fa-unlock"></i>
                        </button>
                    </form>
                </div>
                @else
                <div class="private">
                    <form action="{{route('private',$product)}}" method="POST">
                        @csrf
                        <button class="private">
                            <i class="fa-solid fa-lock"></i>
                        </button>
                    </form>
                </div>
                @endif

            </div>
        </div>
    </div>

    @endforeach
</div>

@endsection