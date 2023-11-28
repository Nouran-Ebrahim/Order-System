@extends('layouts.master')
@section('content')
    <div class="row mt-2 mb-5">
        <h1 class="col-5">Products</h1>
        <div class="col-4">
            <a class="btn btn-primary" href="{{ route('products.create') }}" role="button">Create</a>
        </div>
    </div>
    @if (session('Delete'))
        <div class="alert alert-danger" role="alert">
            Product Deleted Successfully
        </div>
    @endif
    @if (session('created'))
        <div class="alert alert-success" role="alert">
            Product Created Successfully
        </div>
    @endif
    @if (session('updated'))
        <div class="alert alert-success" role="alert">
            Product Updated Successfully
        </div>
    @endif

    <table class="table">
        <thead>
            <tr>
                {{-- <th scope="col">#</th> --}}
                <th scope="col">Name</th>
                <th scope="col">Code</th>

                <th scope="col">Operations</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>

                    <td>{{ $product->name }}</td>
                    <td>{{ $product->code }}</td>

                    <td>
                        <div class="d-flex  justify-content-around">
                            <div>
                                <a class="btn btn-primary" href="{{ route('products.edit', $product->id) }}"
                                    role="button">Edit</a>
                            </div>
                            <form action="{{ route('products.destroy', $product->id) }}" method="Post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger">Delete</button>

                            </form>
                        </div>



                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
