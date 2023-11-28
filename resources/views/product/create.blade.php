@extends('layouts.master')
@section('content')
    <form class="col-8 mx-auto" action="{{ route('products.store') }}" method="POST">
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
            <input type="text" value="{{ old('code') }}" name="code" class="form-control"
                placeholder="Code" aria-label="Code" aria-describedby="basic-addon2">
            {{-- <span class="input-group-text" id="basic-addon2">@example.com</span> --}}
            @error('code')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>



        <button type="submit" class="btn btn-success">Save</button>

    </form>
@endsection
