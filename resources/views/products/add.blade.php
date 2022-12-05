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
                            <a href="/Products" class="btn btn-primary">View Products</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('products.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="name">Product Name</label>
                                <input type="text" name="name" id="name" class="form-control mt-2 @error('name') is-invalid @enderror" placeholder="Enter Product Name" value="{{ old('name') }}">

                                @error('name')
                                    <p class="text-danger text-sm">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group mt-3">
                                <label for="price">Price</label>
                                <input type="number" id="price" class="form-control mt-2 @error('price') is-invalid @enderror" name="price" placeholder="Enter Product Price" value="{{ old('price') }}">

                                @error('price')
                                    <p class="text-danger text-sm">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group mt-3">
                                <label for="quantity">Quantity</label>
                                <input type="number" id="quantity" class="form-control mt-2 @error('quantity') is-invalid @enderror" name="quantity" placeholder="Enter Product quantity" value="{{ old('quantity') }}">

                                @error('quantity')
                                    <p class="text-danger text-sm">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group mt-3">
                                <label for="category">Category</label>
                                <select name="category" class="form-control" id="category">
                                    <option value=""></option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
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
