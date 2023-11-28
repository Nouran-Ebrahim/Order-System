@extends('layouts.master')
@section('css')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/css/bootstrap-select.min.css" integrity="sha512-mR/b5Y7FRsKqrYZou7uysnOdCIJib/7r5QeJMFvLNHNhtye3xJp1TdJVPLtetkukFn227nKpXD9OjUc09lx97Q==" crossorigin="anonymous"
  referrerpolicy="no-referrer" />
@endsection
@section('content')
    <form class="col-8 mx-auto" action="{{ route('PriceList.store') }}" method="POST">
        @csrf
        @method('post')
        <label for="basic-url" class="form-label mt-5">Name</label>
        <div class="input-group mb-3">
            {{-- <span class="input-group-text" id="basic-addon1">@</span> --}}
            <input type="text" name="name" value="{{ old('name') }}" class="form-control" placeholder="Name"
                aria-label="Username" aria-describedby="basic-addon1">
            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <label for="basic-url" class="form-label">Code</label>
        <div class="input-group mb-3">
            <input type="text" value="{{ old('code') }}" name="code" class="form-control" placeholder="Code"
                aria-label="Code" aria-describedby="basic-addon2">
            {{-- <span class="input-group-text" id="basic-addon2">@example.com</span> --}}
            @error('code')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <label for="basic-url" class="form-label">Description</label>
        <div class="input-group mb-3">
            <input type="text" value="{{ old('description') }}" name="description" class="form-control"
                placeholder="description" aria-label="description" aria-describedby="basic-addon2">
            {{-- <span class="input-group-text" id="basic-addon2">@example.com</span> --}}
            @error('description')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <label for="basic-url" class="form-label">Price</label>
        <div class="input-group mb-3">
            <input step="0.01" type="number" value="{{ old('price') }}" name="price" class="form-control" placeholder="price"
                aria-label="price" aria-describedby="basic-addon2">
            {{-- <span class="input-group-text" id="basic-addon2">@example.com</span> --}}
            @error('price')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <label for="basic-url" class="form-label">Product</label>
        <div class="input-group mb-3">
            <select class="selectpicker col-12"   name="product_id[]" multiple>
                @foreach ($viewModel->products() as $product)
                    <option style="color: black !important" value="{{ $product->id }}">{{ $product->name }}</option>
                @endforeach

            </select>

            @error('product_id')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-success">Save</button>

    </form>
@endsection
@section('js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/js/bootstrap-select.min.js" integrity="sha512-FHZVRMUW9FsXobt+ONiix6Z0tIkxvQfxtCSirkKc5Sb4TKHmqq1dZa8DphF0XqKb3ldLu/wgMa8mT6uXiLlRlw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection
