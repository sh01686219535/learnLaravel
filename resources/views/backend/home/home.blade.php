@extends('backend.home.master')
@section('title')
    Dashboard
@endsection
@section('content')
    <div class="container m-5">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-head d-flex justify-content-between m-3">
                        <h3>Curd Operation</h3>
                        <a href="" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Create
                            Curd</a>
                    </div>
                    <hr>
                    <div class="card-body">
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>Title</th>
                                    <th>Image</th>
                                    <th>Create At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = 1  @endphp
                                @foreach ($curd as $curds)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $curds->title }}</td>
                                        <td>
                                            <img src="{{ asset($curds->image) }}" height="50" width="50"
                                                alt="">
                                        </td>
                                        <td>{{ date('d-M-y', strtotime($curds->created_at)) }}</td>
                                        <td>
                                            <a href="" class="btn btn-info" data-bs-toggle="modal"
                                                data-bs-target="#editModal{{ $curds->id }}">
                                                <i class="fa fa-edit"></i></a>

                                            <form action="{{ route('curd.destroy', $curds->id) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-danger"><i
                                                        class="fa fa-trash"></i></button>
                                            </form>
                                            <!-- Modal -->
                                            <div class="modal fade" id="editModal{{ $curds->id }}" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    @if ($errors->any())
                                                        <div class="alert alert-danger">
                                                            <ul>
                                                                @foreach ($errors->all() as $error)
                                                                    <li>{{ $error }}</li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    @endif
                                                    <form action="{{ route('curd.update', $curds->id) }}" method="post"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Create
                                                                    Curd</h1>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <label for="title">Title</label>
                                                                    <input type="text" id="title"
                                                                        value="{{ $curds->title }}" name="title"
                                                                        class="form-control my-2">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="image">Image</label>
                                                                    <input type="file" id="image" name="image"
                                                                        class="form-control my-2">
                                                                </div>
                                                            </div>
                                                            <x-form.button />
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <br> <br>
            <div class="col-md-12 col-lg-12 col-xl-12 col-sm-12 mt-3">
                <div class="card">
                    <x-form.error />
                    <div class="card-body">
                        <x-form.form action="{{route('userInformation')}}" method="post" has-files>
                            @csrf
                            <x-form.input name="title" value="dfsdfsdf"/>
                            <x-form.input name="name" />
                            <x-form.input name="phone" type="number" />
                            <x-form.input name="email" type="email" />
                            <x-form.input name="password" type="password" />
                            <x-form.select :curd="$curd" name="curd_id" />
                            <x-form.input name="image" type="file" />
                            <x-form.textarea name="description" value="sdfsdfsdfsdf"/>
                            <x-form.button> Submit</x-form.button>
                        </x-form.form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <x-form.error />
        <form action="{{ route('curd.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Create Curd</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" id="title" name="title" class="form-control my-2">
                    </div>
                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" id="image" name="image" class="form-control my-2">
                    </div>
                </div>
                <x-form.button>Submit</x-form.button>
            </div>
        </form>
    </div>
</div>
