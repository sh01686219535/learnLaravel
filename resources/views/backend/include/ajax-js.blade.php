<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<script>
    $(document).ready(function() {
        $('#addFormData').submit(function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            $.ajax({
                url: "{{ route('add.curd') }}",
                method: 'post',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {
                    if (data.status == 'success') {
                        $("#addModal").modal('hide');
                        $("#addFormData")[0].reset();
                        $(".table").load(location.href + ' .table');
                    }
                },
                error: function(err) {
                    let error = err.responseJSON;
                    $('.errmesContainer').html('');
                    $.each(error.errors, function(index, value) {
                        $('.errmesContainer').append('<span class="text-danger">' +
                            value + '</span>' + '<br>');
                    });
                }
            });
        });
    });
    // edit
    $(document).ready(function() {
        $('.update_ajax').on('click', function(e) {
            e.preventDefault();
            let id = $(this).data('id');
            let name = $(this).data('name');
            let email = $(this).data('email');
            let phone = $(this).data('phone');
            $('#up_id').val(id);
            $('#up_name').val(name);
            $('#up_email').val(email);
            $('#up_phone').val(phone);
        });
    });
    // update
    $(document).ready(function() {
        $('.edit_curd').on('click', function(e) {
            e.preventDefault();
            let formData = new FormData();
            formData.append('up_id', $('#up_id').val());
            formData.append('up_name', $('#up_name').val());
            formData.append('up_email', $('#up_email').val());
            formData.append('up_phone', $('#up_phone').val());

            let files = $('#up_image')[0].files;
            for (let i = 0; i < files.length; i++) {
                formData.append('up_image[]', files[i]);
            }

            $.ajax({

                url: "{{ route('edit.curd') }}",
                method: 'post',
                data: formData,
                contentType: false,
                processData: false,
                success: function(data) {
                    if (data.status == 'success') {
                        $("#editModal").modal('hide');
                        $("#editFormData")[0].reset();
                        $(".table").load(location.href + ' .table');
                    }
                },
                error: function(err) {
                    let error = err.responseJSON;
                    $('.errmesContainer').html('');
                    $.each(error.errors, function(index, value) {
                        $('.errmesContainer').append('<span class="text-danger">' +
                            value + '</span>' + '<br>');
                    });
                }
            });
        });
    });
    // delete
    $(document).ready(function() {
        $('.delete-btn').on('click', function(e) {
            e.preventDefault();
            let id = $(this).data('id');
            if (confirm('Are you sure delete this')) {
                $.ajax({
                    url: "{{ route('delete.curd') }}",
                    method: 'post',
                    data: {
                        id: id
                    },
                    success: function(data) {
                        if (data.status == 'success') {
                            $(".table").load(location.href + ' .table');
                        }
                    },
                });
            }
        });
    });
    // pagination
    $(document).on('click', '.pagination a', function(e) {
        e.preventDefault();
        let page = $(this).attr('href').split('page=')[1]
        Ajax(page)
    });

    function Ajax(page) {
        $.ajax({
            url: "/pagination/paginate-data?page=" + page,
            success: function(data) {
                $(".table-data").html(data);
            },
        });
    }
    // search
    $(document).on('keyup', function(e) {
        e.preventDefault();
        let search_id = $('#search').val();
        $.ajax({
            url: "/ajax/search",
            method:'GET',
            data:{search_id:search_id},
            success: function(data) {
                $(".table-data").html(data);
                if (data.status == 'nothing found') {
                    $(".table-data").html('<span class="text-danger">'+'nothing found'+'</span>');   
                }
            },
        });
    });
</script>
