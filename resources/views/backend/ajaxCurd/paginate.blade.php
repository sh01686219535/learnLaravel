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
                            @php
                                $images = json_decode($item->image, true);
                            @endphp
                            @foreach ($images as $img)
                                <img src="{{ asset($img) }}" width="50" height="50"
                                    alt="">
                            @endforeach
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