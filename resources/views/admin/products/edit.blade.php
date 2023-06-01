@extends('layouts.admin.master')
@section('page_content')
    <div class="container">
        <div class="row">
            <div class="col-2">
            </div>
            <div class="col-6">
                <h3>Edit Product</h3>
                <form action="{{ route('products.update', $product->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ $product->name }}"
                            required>
                    </div>

                    <!-- Add more form fields as needed -->

                    <button type="submit" class="btn btn-primary mt-2">Update</button>
                </form>
            </div>
        </div>

    </div>
@endsection
