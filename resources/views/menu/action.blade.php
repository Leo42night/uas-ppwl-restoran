<a href="{{ route('menu.edit', $model) }}" class="btn btn-warning btn-sm">Edit</a>
<button href="{{ route('menu.destroy', $model) }}" class="btn btn-danger btn-sm" id="delete{{ $model->id }}">Delete</button>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    var id = decodeURIComponent("{{ rawurlencode($model->id) }}");
    $('#delete'+id).on('click', function(e) {
        e.preventDefault();
        var href = $(this).attr('href');
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {

                document.getElementById('deleteForm').action = href
                document.getElementById('deleteForm').submit()
                
                Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                )
            }
        })
    })
</script>
