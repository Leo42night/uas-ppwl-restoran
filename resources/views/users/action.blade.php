<a href="{{ route('users.edit', $model) }}" class="btn btn-warning btn-sm">Edit</a>
<button href="{{ route('users.destroy', $model) }}" class="btn btn-danger btn-sm" id="delete">Delete</button>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $('button#delete').on('click', function(e) {
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
