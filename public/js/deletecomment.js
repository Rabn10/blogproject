$(document).on('click', '.delete-comment', function (e){
    e.preventDefault();
    console.log('button clicked');
    const commentId = $(this).data('id');

    if(confirm('Are you sure you want to delete this comment?')) {
        $.ajax({
            url: '/comment/' + commentId,
            type: 'DELETE',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                if(response.success) {
                    alert(response.message);
                    $('#comment-' + commentId).remove();
                } else {
                    alert(response.message);
                }
            }
        })
    }
})