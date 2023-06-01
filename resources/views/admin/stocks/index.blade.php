@extends('layouts.admin.master')
@section('page_content')

    <head>
        <title>{{ __('text.stock') }}</title>
        <style>
            .duplicate {
                border-color: red;
            }

        </style>
    </head>
    <h2>{{ __('text.stock') }}</h2>

    @if (session('success'))
        <div class="success-message" style="color: green;">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('stocks.store') }}">
        @csrf

        <table id="products-table">
            <thead>
                <tr>
                    <th style="padding-left:2%">{{ __('text.product') }}</th>
                    <th style="padding-left:2%">{{ __('text.quantity') }}</th>
                    <th style="padding-left:2%">{{ __('text.currentStock') }}</th>
                    <th style="padding-left:2%">{{ __('text.action') }}</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <select class="form-control mx-2" name="products[]" class="product-select">
                            <option value="">Select Product</option>
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <input class="form-control mx-2" type="number" name="quantities[]" min="1">
                    </td>
                    <td>
                        <input class="form-control mx-2" type="text" name="current_stocks[]" class="current-stock"
                            readonly>
                    </td>
                    <td>
                        <button type="button" class="remove-row btn btn-danger ms-2">{{ __('text.remove') }}</button>
                    </td>
                </tr>
            </tbody>
        </table>

        <button type="button" id="add-row" class="add-product btn btn-primary m-2">{{ __('text.addProductCreate') }}</button>
        <button type="submit" class="submit btn btn-success">{{ __('text.save') }}</button>

        @if ($errors->any())
            <div class="error-message" style="color: red;">
                @foreach ($errors->all() as $error)
                    {{ $error }}<br>
                @endforeach
            </div>
        @endif
    </form>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Add new row
            $('#add-row').click(function() {
                var newRow = `
                    <tr>
                        <td>
                            <select name="products[]" class="product-select mx-2 form-control">
                                <option value="">Select Product</option>
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <input class="form-control mx-2" type="number" name="quantities[]" min="1">
                        </td>
                        <td>
                            <input class="form-control mx-2" type="text" name="current_stocks[]" class="current-stock" readonly>
                        </td>
                        <td>
                            <button type="button" class="remove-row btn btn-danger ms-2">{{ __('text.remove') }}</button>
                        </td>
                    </tr>
                `;
                $('#products-table tbody').append(newRow);
            });

            // Remove row
            $(document).on('click', '.remove-row', function() {
                $(this).closest('tr').remove();
            });

            // Fetch and populate current stock on product selection change
            $(document).on('change', '.product-select', function() {
                var productSelect = $(this);
                var currentStockField = productSelect.closest('tr').find('.current-stock');
                var productId = productSelect.val();

                if (productId !== '') {
                    // Send AJAX request to fetch current stock for the selected product
                    $.ajax({
                        url: '/products/' + productId + '/stock',
                        method: 'GET',
                        success: function(response) {
                            currentStockField.val(response.stock);
                        }
                    });
                } else {
                    currentStockField.val('');
                }
            });

            // Validate duplicate products
            $(document).on('change', '.product-select', function() {
                var productSelects = $('.product-select');
                var duplicateProducts = false;
                var selectedProducts = [];

                productSelects.each(function() {
                    var productSelect = $(this);
                    var productId = productSelect.val();

                    if (productId !== '') {
                        if (selectedProducts.includes(productId)) {
                            productSelect.addClass('duplicate');
                            duplicateProducts = true;
                        } else {
                            productSelect.removeClass('duplicate');
                            selectedProducts.push(productId);
                        }
                    } else {
                        productSelect.removeClass('duplicate');
                    }
                });

                if (duplicateProducts) {
                    $('button[type="submit"]').prop('disabled', true);
                } else {
                    $('button[type="submit"]').prop('disabled', false);
                }
            });
        });

    </script>
@endsection
