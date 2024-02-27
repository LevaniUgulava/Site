@extends('layouts.main')
@section('content')
<style>
    input {
        width: 100%;
        padding: 8px;
        box-sizing: border-box;
    }

    textarea {
        width: 100%;
        padding: 20px;
        box-sizing: border-box;
    }

    .file {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        box-sizing: border-box
    }

    button {
        width: 100%;
        padding: 8px;
        box-sizing: border-box;
        background-color: wheat;
        border-radius: 8px;
        cursor: pointer;
    }

    button:hover {
        background-color: gray;
    }

    .message-container {
        width: 100%;
        height: 30px;
        background-color: wheat;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 15px;
    }

    .message {
        color: #333;
        /* Adjust the text color as needed */
    }
</style>

@if(session()->has('message'))
<div class="message-container">
    <p class="message">{{ session('message') }}</p>
</div>
@endif

<form action="{{route('store')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <label>Name:</label>
    <input type="text" name="name" class="form-control">
    <label>Description:</label>
    <textarea name="description"></textarea>
    <label>Price:</label>
    <input type="number" name="price" class="form-control">
    <label>Images:</label>
    <input type="file" name="image[]" multiple class="file">
    <button>
        ADD
    </button>
</form>

@endsection