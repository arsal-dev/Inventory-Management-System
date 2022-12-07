@extends('layouts.layout')

@section('content')
<div id="layoutSidenav">
    @include('partials.navbar')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Products</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Add Products</li>
                </ol>
                <div class="card mb-4">
                    <div class="card-header d-flex" style="justify-content: space-between">
                        <div>
                            <i class="fas fa-table me-1"></i>
                            Products
                        </div>
                        <div>
                            <a href="/products" class="btn btn-primary">View Products</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('products.update', $product['product']->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="form-group">
                                <label for="image">Product Image</label>
                                <input type="file" name="image" class="form-control" id="image">

                                <img src="{{ asset('images/product-images/'.$product['product']->image) }}" width="250px" class="img-fluid mt-2 border" alt="">

                                @error('image')
                                    <p class="text-danger text-sm">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="name">Product Name</label>
                                <input type="text" name="name" id="name" class="form-control mt-2 @error('name') is-invalid @enderror" placeholder="Enter Product Name" value="{{ $product['product']->name }}">

                                @error('name')
                                    <p class="text-danger text-sm">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group mt-3">
                                <label for="price">Price</label>
                                <input type="number" id="price" class="form-control mt-2 @error('price') is-invalid @enderror" name="price" placeholder="Enter Product Price" value="{{ $product['product']->price }}">

                                @error('price')
                                    <p class="text-danger text-sm">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group mt-3">
                                <label for="quantity">Quantity</label>
                                <input type="number" id="quantity" class="form-control mt-2 @error('quantity') is-invalid @enderror" name="quantity" placeholder="Enter Product quantity" value="{{ $product['product']->quantity }}">

                                @error('quantity')
                                    <p class="text-danger text-sm">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group mt-3">
                                <label for="category">Category</label>
                                <select name="category" class="form-control" id="category">
                                    <option value=""></option>
                                    @foreach ($product['categories'] as $category)
                                        @if ($category->name == $product['product']->category)
                                            <option selected value="{{ $category->name }}">{{ $category->name }}</option>
                                        @else
                                            <option value="{{ $category->name }}">{{ $category->name }}</option>
                                        @endif
                                    @endforeach
                                </select>

                                @error('category')
                                    <p class="text-danger text-sm">{{ $message }}</p>
                                @enderror
                            </div>
                            <input type="submit" class="btn btn-primary mt-3">
                        </form>
                    </div>
                </div>
            </div>
        </main>
        @include('partials.footer')
    </div>
</div>
@endsection
