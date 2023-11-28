@extends('layouts.master')
@section('content')
    <h2 class="text-center mb-3 mt-3">Line Details</h2>
    <h4>Order # {{ $lines[0]->header->order_number }}</h4>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">products</th>
                <th scope="col">price</th>
                <th scope="col">quantity</th>
                <th scope="col">total</th>
                <th scope="col">description</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($lines as $line)
                <tr>

                    <td>{{ $line->product->name }}</td>
                    <td>{{ $line->price }}</td>
                    <td>{{ $line->quantity }}</td>
                    <td class="subtotal">{{ $line->total }}</td>
                    <td>{{ $line->description }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div id="total">
        Sum of Total: {{ $sum }}
    </div>
@endsection
@section('js')
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    {{-- <script>
        $(function() {
            'use strict';

            function getTotal() {
                var finailTotal = [];

                $('.subtotal').each(function() {
                    finailTotal.push(parseFloat($(this).text()));
                });

                return finailTotal;
            }
            var numbers = getTotal();
            // Initialize sum
            var sum = 0;

            // Iterate through the array and accumulate the sum
            $.each(numbers, function(index, value) {
                sum += value;
            });

            // Display the result
            $('#total').text('Sum of Total: ' + sum);
            // console.log(numbers);
        });
    </script> --}}
@endsection
