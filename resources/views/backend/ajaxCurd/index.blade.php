<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Ajax Curd</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
                <div class="card my-3">
                    <div class="card-head m-3 d-flex justify-content-between">
                        <h3>Ajax Curd</h3>
                        <a href="" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#addModal">Create</a>
                    </div>
                    <input type="text" class="form-control col-md-6" name="search" id="search"
                        placeholder="Search Here.....">
                    <hr>
                    <div class="card-body">
                        <div class="table-data">
                            <table class="table table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th>Sl</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Image</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 1;
                                    @endphp
                                    @foreach ($ajax as $item)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td>{{ $item->phone }}</td>
                                            <td>
                                                @if ($item->image)
                                                    @php
                                                        $images = json_decode($item->image, true);
                                                    @endphp
                                                    @foreach ($images as $img)
                                                        <img src="{{ asset($img) }}" width="50" height="50"
                                                            alt="">
                                                    @endforeach
                                                @endif

                                            </td>
                                            <td>
                                                <a href="" data-bs-toggle="modal" data-bs-target="#editModal"
                                                    data-id="{{ $item->id }}" data-name="{{ $item->name }}"
                                                    data-email="{{ $item->email }}" data-phone="{{ $item->phone }}"
                                                    class="btn btn-info update_ajax">
                                                    <i class="fa fa-pen-to-square">
                                                    </i>
                                                </a>
                                                <a href="" class="btn btn-danger delete-btn"
                                                    data-id="{{ $item->id }}"><i class="fa-solid fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {!! $ajax->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->

    @include('backend.include.editModal')
    @include('backend.include.addModal')
    @include('backend.include.ajax-js')
</body>

</html>
