@extends('layouts.master')
@section('content')
    <div class="row mt-2 mb-5">
        <h1 class="col-5">PriceList</h1>
        <div class="col-4">
            <a class="btn btn-primary" href="{{ route('PriceList.create') }}" role="button">Create</a>
        </div>
    </div>
    @if (session('Delete'))
        <div class="alert alert-danger" role="alert">
            PriceList Deleted Successfully
        </div>
    @endif
    @if (session('created'))
        <div class="alert alert-success" role="alert">
            PriceList Created Successfully
        </div>
    @endif
    @if (session('updated'))
        <div class="alert alert-success" role="alert">
            PriceList Updated Successfully
        </div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Code</th>
                <th scope="col">Price</th>
                <th scope="col">Description</th>
                <th scope="col">Products</th>
                <th scope="col">Operations</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($PriceLists as $list)
                <tr>

                    <td>{{ $list->name }}</td>
                    <td>{{ $list->code }}</td>
                    <td>{{ $list->price }}</td>
                    <td>{{ $list->description }}</td>
                    <td>
                        @foreach ($list->products as $product)
                            {{ $product->name }}<br>
                        @endforeach
                    </td>
                    <td>
                        <div class="d-flex  justify-content-around">
                            <div>
                                <a class="btn btn-primary" href="{{ route('PriceList.edit', $list->id) }}"
                                    role="button">Edit</a>
                            </div>
                            <form action="{{ route('PriceList.destroy', $list->id) }}" method="Post">
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
