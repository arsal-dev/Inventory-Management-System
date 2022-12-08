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
                            <i class="fa fa-cart-arrow-down me-1"></i>
                            Add New Order
                        </div>
                        <div>
                            <button class="btn btn-primary" id="add-product"><i class="fa fa-arrow-circle-down"></i> Add Products</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="" id="form">
                            <div class="form-group row">
                                <div class="col-6">
                                    <label for="product">Product</label>
                                    <select name="product" id="product" class="form-control product">
                                        <option></option>
                                        @foreach ($products as $product)
                                            <option value="{{ $product->id }}" qty="{{ $product->quantity }}" price="{{ $product->price }}">{{ $product->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-4">
                                    <label for="qty">Quantity</label>
                                    <input type="number" name="quantity" class="form-control quantity" id="qty">
                                </div>
                                <div class="col-2">
                                    <label for="price">Price</label>
                                    <input type="number" class="form-control totalPrice" disabled id="price">
                                </div>
                            </div>
                        </form>
                        <div class="d-flex border-top mt-5" style="justify-content: space-between">
                            <div>
                                <i class="fa fa-calculator me-1"></i>
                                Total Price: <span id="grandTotal" class="text-success">0</span>
                            </div>
                            <div>
                                <button class="btn btn-primary" id="add-product">Add Order</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        @include('partials.footer')
    </div>
</div>
<script>
    window.addEventListener('load', function(){
        addRow();
        updateQty();
        updatePrice();
    });

    function addRow(){
        let addProduct = document.getElementById('add-product');
        let form = document.getElementById('form');
        addProduct.addEventListener('click', function(){
            form.innerHTML += `<div class="form-group row mt-2">
                                    <div class="col-6">
                                        <label for="product">Product</label>
                                        <select name="product" id="product" class="form-control product">
                                                <option></option>
                                            @foreach ($products as $product)
                                                <option value="{{ $product->id }}" qty="{{ $product->quantity }}" price="{{ $product->price }}">{{ $product->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-4">
                                        <label for="qty">Quantity</label>
                                        <input type="number" name="quantity" class="form-control quantity" id="qty">
                                    </div>
                                    <div class="col-2">
                                        <label for="price">Price</label>
                                        <input type="number" class="form-control totalPrice" disabled id="price">
                                    </div>
                                </div>`;
                                updateQty();
        });
    }


    function updateQty(){
        let product = document.querySelectorAll('.product');     
        for(let i = 0; i < product.length; i++){
            product[i].addEventListener('change', function(){
                let selected = this.options[this.selectedIndex];
                let qty = selected.getAttribute('qty');
                let price = selected.getAttribute('price');
                this.parentElement.nextSibling.nextSibling.children[1].setAttribute('qty', qty);
                this.parentElement.nextSibling.nextSibling.children[1].setAttribute('price', price);
            });
        }
        updatePrice();
    }

    function updatePrice(){
        let quantity =  document.querySelectorAll('.quantity');
        for(let i = 0; i < quantity.length; i++){
            quantity[i].addEventListener('change', function(){
                let qty = parseInt(this.getAttribute('qty'));
                let price = parseInt(this.getAttribute('price'));
                if(this.value  > qty){
                    this.value = qty;
                }

                let totalPrice = price * this.value;
                this.parentElement.nextSibling.nextSibling.children[1].value = totalPrice;

                let totalPriceInput = document.querySelectorAll('.totalPrice');
                let grandTotal = 0;
                for(let i = 0; i < totalPriceInput.length; i++){
                    // console.log(parseInt(totalPriceInput[i].value));
                    grandTotal += parseInt(totalPriceInput[i].value);
                }
                document.getElementById('grandTotal').innerHTML = grandTotal;
            });
        }
    }
</script>
@endsection