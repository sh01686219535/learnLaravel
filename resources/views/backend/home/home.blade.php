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
                        <a href="{{ route('ajax.curd') }}" class="btn btn-success">Ajax Curd</a>
                        <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Create
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
                        <x-form.form action="{{ route('userInformation') }}" method="post" has-files>
                            @csrf
                            <x-form.input name="title" value="dfsdfsdf" />
                            <x-form.input name="name" />
                            <x-form.input name="phone" type="number" />
                            <x-form.input name="email" type="email" />
                            <x-form.input name="password" type="password" />
                            <x-form.select :curd="$curd" name="curd_id" />
                            <x-form.input name="image" type="file" />
                            <x-form.textarea name="description" value="sdfsdfsdfsdf" />
                            <x-form.button> Submit</x-form.button>
                        </x-form.form>
                    </div>
                </div>
            </div>
        </div>
        <div class="py-12 my-5">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="row">
                    @foreach ($curd as $curds)
                        <div class="col-md-4">
                            <div class="card" style="width:18rem">
                                <img src="{{ asset($curds->image) }}" alt="">
                                <div class="card-body">
                                    <h1>{{ $curds->title }}</h1>
                                    <a href="{{ route('add-to-cart', $curds->id) }}" class="btn btn-danger mt-3">Add to
                                        Cart</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-md-12 col-lg-12 col-sm-12">
            <div class="card">
                <div class="card-head">
                    <div class="head-main d-flex justify-content-between m-3">
                        <h3>Event Curd</h3>
                        <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#eventModal">Event Create</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<!-- Modal -->
<div class="modal fade" id="eventModal" tabindex="-1" aria-labelledby="eventLabel" aria-hidden="true">
    <div class="modal-dialog">
        <x-form.error />
        <form action="{{route('event.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="eventLabel">Create Curd</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="response"></div>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" class="form-control my-2">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" class="form-control my-2">
                    </div>
                </div>
                <x-form.button>Submit</x-form.button>
                <a href="{{route('send-otp')}}" class="btn btn-primary">Send OTP</a>
            </div>
        </form>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <x-form.error />
        <form id="upload-form" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Create Curd</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="response"></div>
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" id="title" name="title" class="form-control my-2">
                    </div>
                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" id="image" name="image[]" multiple class="form-control my-2">
                    </div>
                </div>
                <x-form.button>Submit</x-form.button>
            </div>
        </form>
    </div>
</div>
@push('js')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
    $(document).ready(function() {
        $('#upload-form').submit(function(e) {
            e.preventDefault(); 

            const formData = new FormData(this);

            $.ajax({
                url: "{{ route('curd.store') }}",
                method: 'POST',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(res) {
                    if (res.status == 'success') {
                        $('#exampleModal').modal('hide');
                        $('#upload-form').[0].reset();
                        $('#response').html(`
                            <div class="alert alert-success alert-dismissible">
                                ${res.message}
                            </div>
                        `);
                    } else if(res.status == 'failed'){
                        $('#response').html(`
                            <div class="alert alert-danger alert-dismissible">
                                ${res.message}
                            </div>
                        `);
                    }
                },
                error: function(error) {
                    $('#response').html(`
                        <div class="alert alert-danger alert-dismissible">
                            There is some error while uploading the file.
                        </div>
                    `);
                },
            });
        });
    });
    </script>
@endpush
{{-- action="{{ route('curd.store') }}" --}}
