@extends('layouts.layout')

@section('content')
<div id="layoutSidenav">
    @include('partials.navbar')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Orders</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">New Order</li>
                </ol>
                <div class="card mb-4">
                    <div class="card-header d-flex" style="justify-content: space-between">
                        <div>
                            <i class="fas fa-table me-1"></i>
                            Add New Order
                        </div>
                        <div>
                            <button class="btn btn-primary" id="add-product">Add Products</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="" id="form">
                            <div class="form-group row">
                                <div class="col-6">
                                    <label for="product">Product</label>
                                    <select name="product" id="product" class="form-control">
                                        <option></option>
                                        @foreach ($products as $product)
                                            <option value="{{ $product->id }}" qty="{{ $product->quantity }}">{{ $product->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-4">
                                    <label for="qty">Quantity</label>
                                    <input type="number" name="quantity" class="form-control" id="qty">
                                </div>
                                <div class="col-2">
                                    <label for="price">Price</label>
                                    <input type="number" class="form-control" id="price">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>
        @include('partials.footer')
    </div>
</div>
<script>
    let addProduct = document.getElementById('add-product');
    let form = document.getElementById('form');
    addProduct.addEventListener('click', function(){
        form.innerHTML += `<div class="form-group row mt-2">
                                <div class="col-6">
                                    <label for="product">Product</label>
                                    <select name="product" id="product" class="form-control">
                                            <option></option>
                                        @foreach ($products as $product)
                                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-4">
                                    <label for="qty">Quantity</label>
                                    <input type="number" name="quantity" class="form-control" id="qty">
                                </div>
                                <div class="col-2">
                                    <label for="price">Price</label>
                                    <input type="number" class="form-control" id="price">
                                </div>
                            </div>`;
    });



    let product = document.getElementById('product');
    product.addEventListener('change', function(){
        let selected = this.options[this.selectedIndex];
        console.log(selected.getAttribute('qty'));
    });

    // let qty = document.getElementById('qty');
    // qty.addEventListener('change', function(){
    //     let productQty = this.getAttribute('data-id');
    //     if(this.value > productQty){
    //         this.value = productQty;
    //     }
    // });
</script>
@endsection