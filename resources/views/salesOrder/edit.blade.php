@extends('layouts.master')
@section('content')
    <form class="form form-horizontal invoice-repeater " action="{{ route('salesOrders.update', $SalesOrder->id) }}"
        method="POST">
        {{ csrf_field() }}
        @method('put')
        <div class="row">
            <h2>Header</h2>
            <label for="basic-url" class="form-label">Order Number</label>
            <div class="input-group mb-3">
                <input type="text" value="{{ $SalesOrder->order_number }}" name="order_number" class="form-control"
                    placeholder="order_number" aria-label="order_number" aria-describedby="basic-addon2">
                @error('order_number')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <label for="basic-url" class="form-label">Date</label>
            <div class="input-group mb-3">
                <input type="date" value="{{ $SalesOrder->date }}" name="date" class="form-control" placeholder="date"
                    aria-label="date" aria-describedby="basic-addon2">
                @error('date')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <label for="basic-url" class="form-label">Customer</label>
            <div class="input-group mb-3">
                <select name="customer_id" class="form-control" required>
                    @foreach ($viewModel->customers() as $customer)
                        <option @if ($customer->id == $SalesOrder->customer_id) selected @endif value="{{ $customer->id }}">
                            {{ $customer->code }}</option>
                    @endforeach
                </select>
                @error('customer_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <label for="basic-url" class="form-label">Price List</label>
            <div class="input-group mb-3">
                <select id="priceList" name="price_list_id" class="form-control" required>
                    @foreach ($viewModel->pricLists() as $list)
                        <option @if ($list->id == $SalesOrder->price_list_id) selected @endif value="{{ $list->id }}">
                            {{ $list->name }}</option>
                    @endforeach
                </select>
                @error('price_list_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <h2 id="linesTilte">Lines</h2>
            <div data-repeater-list="lines" id="repeaterContainer">
                @foreach ($SalesOrder->lines as $line)
                    <div data-repeater-item class="lines">
                        <div class="row d-flex align-items-end">
                            <div class="col-md-1 col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="itemtitle">Price</label>
                                    <input step="0.01" id='price' type="number" value="{{ $line->price }}"
                                        name="price" class="form-control price" placeholder="price" aria-label="price"
                                        aria-describedby="basic-addon2">
                                    @error('lines.*.price')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-2 col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="itemtitle">Quantity</label>
                                    <input min="1" type="number" value="{{ $line->quantity }}" name="quantity"
                                        class="form-control quantity" placeholder="quantity" aria-label="quantity"
                                        aria-describedby="basic-addon2">
                                    @error('lines.*.quantity')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-1 col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="itemtitle">Total</label>
                                    <input step="0.01" type="number" name="total" value="{{ $line->total }}"
                                        class="form-control total" placeholder="total" aria-label="total"
                                        aria-describedby="basic-addon2">
                                    @error('lines.*.total')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4 col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="itemquantity">Description</label>
                                    <input id="description" type="text" value="{{ $line->description }}"
                                        name="description" class="form-control description" placeholder="description"
                                        aria-label="description" aria-describedby="basic-addon2">
                                    @error('lines.*.description')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-2 col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="itemquantity">Product</label>
                                    <select name="product_id" class="form-control product" id="product" required>
                                        @foreach ($viewModel->products() as $product)
                                            <option @if ($product->id == $line->product_id) selected @endif
                                                value="{{ $product->id }}">{{ $product->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('lines.*.product_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-2 col-12 mb-50">
                                <div class="mb-1">
                                    <button class="btn btn-outline-danger text-nowrap px-1" data-repeater-delete
                                        type="button">
                                        <i data-feather="x" class="me-25"></i>
                                        <span>Delete</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <hr />
                    </div>
                @endforeach
            </div>
            <div class="row">
                <div class="col-12">
                    <button id="myButton" class="btn btn-icon btn-primary" type="button" data-repeater-create>
                        <i data-feather="plus" class="me-25"></i>
                        <span>Add New</span>
                    </button>
                </div>
            </div>
            <div class="col-sm-9 offset-sm-3">
                <button type="submit" class="btn btn-primary me-1">Submit</button>
            </div>


        </div>
    </form>
@endsection
@section('js')
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="{{ asset('') }}js/jquery.repeater.min.js"></script>
    <script>


        function priceListData(id) {
            $.ajax({
                url: '{{ url('ajax_priceListData') }}',
                type: 'POST',
                data: {
                    "id": id,
                    "_token": "{{ csrf_token() }}"
                },
                success: function(data) {
                    // console.log(data);
                    $('.price').val('');
                    $('.description').val('');

                    $('.description').val(data.description);
                    $('.price').val(data.price);

                },
                error: function(error) {
                    console.log(error);
                }
            });
        }
        $(function() {
            'use strict';
            $('.invoice-repeater, .repeater-default').repeater({
                show: function() {
                    var index = $(this).index(); // Get the index of the added item
                    // console.log('Item added at index: ' + index);
                    $(this).slideDown();
                    populateOptions2($(this));

                },
                hide: function(deleteElement) {
                    if (confirm('Are you sure you want to delete this element?')) {
                        $(this).slideUp(deleteElement);
                    }
                }
            });
            // Calculate total on input change
            $('#repeaterContainer').on('input', '.price, .quantity', function() {
                calculateTotals();
            });

            // Initial calculation
            calculateTotals();

            // Function to calculate totals for each item
            function calculateTotals() {
                $('#repeaterContainer .lines').each(function() {
                    var price = $(this).find('.price').val() || 0;
                    var quantity = $(this).find('.quantity').val() || 0;
                    var total = price * quantity;

                    $(this).find('.total').val(total);
                });
            }

            var id = $('#priceList').val();
            // products(id);
            priceListData(id);



            function populateOptions2(repeaterItem) {
                var price = repeaterItem.find('.price');
                var description = repeaterItem.find('.description');
                var id = $('#priceList').val();
                $.ajax({
                    url: '{{ url('ajax_priceListData') }}',
                    type: 'POST',
                    data: {
                        "id": id,
                        "_token": "{{ csrf_token() }}"
                    },
                    success: function(data) {
                        price.val('');
                        description.val('');

                        description.val(data.description);
                        price.val(data.price);
                    },
                    error: function(error) {
                        console.error('Error fetching options:', error);
                    }
                })
            };
        });
        $('#priceList').change(function() {
            // console.log($(this).val());
            var id = $(this).val();
            $('.total').val('')
            $('.quantity').val('')
            priceListData(id);

        })
    </script>
@endsection
