@extends('layouts.layout')

@section('content')
<div id="layoutSidenav">
    @include('partials.navbar')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Products</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Edit Products</li>
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
                        <form action="{{ route('products.update', $category->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <div class="form-group">
                                <label for="name">Category Name</label>
                                <input type="text" name="name" id="name" class="form-control mt-2 @error('name') is-invalid @enderror" placeholder="Enter Category Name" value="{{ $category->name }}">

                                @error('name')
                                    <p class="text-danger text-sm">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group mt-3">
                                <label for="desc">Category Description</label>
                                <input type="text" id="desc" class="form-control mt-2 @error('desc') is-invalid @enderror" name="desc" placeholder="Enter Category Description" value="{{ $category->desc }}">

                                @error('desc')
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
