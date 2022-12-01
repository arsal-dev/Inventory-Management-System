@extends('layouts.layout')

@section('content')
<div id="layoutSidenav">
    @include('partials.navbar')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Categories</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Categories</li>
                </ol>
                <div class="row">
                    <div class="card col-6">
                        <form class="mt-5 p-3">
                            @csrf
                            <div class="form-group">
                              <label for="name">Category Name</label>
                              <input type="text" class="form-control" id="name" aria-describedby="emailHelp" placeholder="Category Name">
                              {{-- <small class="form-text text-danger">We'll never share your email with anyone else.</small> --}}
                            </div>
                            <div class="form-group mt-3">
                              <label for="desc">Desc</label>
                              <textarea name="desc" id="desc" class="form-control" cols="30" rows="10"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">Submit</button>
                          </form>
                    </div>
                    <div class="card col-6 mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            DataTable Example
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Desc</th>
                                        <th>Created At</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Name</th>
                                        <th>Desc</th>
                                        <th>Created At</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach ($categories as $category)    
                                        <tr>
                                            <td>{{ $category->name }}</td>
                                            <td>{{ $category->desc }}</td>
                                            <td>{{ $category->created_at }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        @include('partials.footer')
    </div>
</div>
@endsection
