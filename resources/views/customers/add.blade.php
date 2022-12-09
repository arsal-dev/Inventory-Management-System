@extends('layouts.layout')

@section('content')
<div id="layoutSidenav">
    @include('partials.navbar')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Customers</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Add Customers</li>
                </ol>
                <div class="card mb-4">
                    <div class="card-header d-flex" style="justify-content: space-between">
                        <div>
                            <i class="fas fa-table me-1"></i>
                            Customers
                        </div>
                        <div>
                            <a href="/customers" class="btn btn-primary">View Customers</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('customers.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="name">Customer Name</label>
                                <input type="text" name="name" id="name" class="form-control mt-2 @error('name') is-invalid @enderror" placeholder="Enter Customer Name" value="{{ old('name') }}">

                                @error('name')
                                    <p class="text-danger text-sm">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group mt-3">
                                <label for="number">Phone Number</label>
                                <input type="number" id="number" class="form-control mt-2 @error('number') is-invalid @enderror" name="number" placeholder="Enter Phone Number" value="{{ old('number') }}">

                                @error('number')
                                    <p class="text-danger text-sm">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group mt-3">
                                <label for="address">Current Address</label>
                                <textarea name="address" class="form-control @error('address') is-invalid @enderror" id="address" cols="30" rows="6"></textarea>

                                @error('address')
                                    <p class="text-danger text-sm">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group mt-3">
                                <label for="balance">Balance</label>
                                <input type="number" id="balance" class="form-control mt-2 @error('balance') is-invalid @enderror" name="balance" placeholder="Enter Customer Balance" value="{{ old('balance') }}">

                                @error('balance')
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
