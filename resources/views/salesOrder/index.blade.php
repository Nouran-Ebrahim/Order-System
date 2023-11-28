@extends('layouts.master')
@section('content')
     <div class="row mt-2 mb-5">
        <h1 class="col-5">Sales order report</h1>
        <div class="col-4">
            <a class="btn btn-primary" href="{{ route('salesOrders.create') }}" role="button">Create</a>
        </div>
    </div>

    @if (session('Delete'))
        <div class="alert alert-danger" role="alert">
            Sales order Deleted Successfully
        </div>
    @endif
    @if (session('created'))
        <div class="alert alert-success" role="alert">
            Sales order  Created Successfully
        </div>
    @endif
    @if (session('updated'))
        <div class="alert alert-success" role="alert">
            Sales order  Updated Successfully
        </div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th scope="col">Header#</th>
                <th scope="col">Customer</th>
                <th scope="col">Price List</th>
                <th scope="col">Order Number</th>
                <th scope="col">Date</th>
                <th scope="col">Operations</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($headers as $header)
                <tr>

                    <td>{{ $header->id }}</td>
                    <td>{{ $header->customer->name }}</td>
                    <td>{{ $header->priceList->name }}</td>
                    <td>{{ $header->order_number }}</td>
                    <td><a href="{{ route('salesOrders.show', $header->id) }}">{{ $header->date }}</a></td>
                    <td>
                        <div class="d-flex  justify-content-around">
                            <div>
                                <a class="btn btn-primary" href="{{ route('salesOrders.edit', $header->id) }}"
                                    role="button">Edit</a>
                            </div>
                            <form action="{{ route('salesOrders.destroy', $header->id) }}" method="Post">
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
