@extends('layouts.admin.master')
@section('page_content')
    <form method="POST" action="{{ route('products.store') }}">
        @csrf
        <div class="row">
            <div class="col-2">
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="name">{{ __('text.productName') }}</label>
                    <input type="text" name="name" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary mt-3">{{ __('text.createProduct') }}</button>
            </div>
        </div>

    </form>
@endsection
