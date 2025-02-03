$(document).ready(function () {
    // Delete Comment
    $(document).on('click', '.delete-comment', function (e) {
        e.preventDefault();
        console.log('button clicked');
        const commentId = $(this).data('id');

        if (confirm('Are you sure you want to delete this comment?')) {
            $.ajax({
                url: '/comment/' + commentId,
                type: 'DELETE',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    if (response.success) {
                        alert(response.message);
                        $('#comment-' + commentId).remove();
                    } else {
                        alert(response.message);
                    }
                }
            });
        }
    });

    // Edit Comment
    $(document).on('click', '.edit-comment', function () {
        const commentDiv = $(this).closest('.comment');
        const commentText = commentDiv.find('.comment-text');
        const editSection = commentDiv.find('.edit-section');

        // Show the textarea and hide the comment text
        commentText.hide();
        editSection.show();
    });

    // Cancel Edit
    $(document).on('click', '.cancel-btn', function () {
        const commentDiv = $(this).closest('.comment');
        const commentText = commentDiv.find('.comment-text');
        const editSection = commentDiv.find('.edit-section');

        // Restore original view
        commentText.show();
        editSection.hide();
    });

    // Save Edited Comment
    $(document).on('click', '.save-btn', function (e) {
        e.preventDefault();
        const commentDiv = $(this).closest('.comment');
        const commentText = commentDiv.find('.comment-text');
        const editSection = commentDiv.find('.edit-section');
        const updatedText = editSection.find('.edit-comment-area').val();
        const commentId = $(this).data('id');

        // Update the comment text
        commentText.html(`<p style="color: #000;">${updatedText}</p>`);

        // Hide the textarea and show the updated comment
        commentText.show();
        editSection.hide();

        // Send an AJAX request to update the comment
        $.ajax({
            url: '/comment/' + commentId,
            type: 'PUT',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                comment: updatedText
            },
            success: function (response) {
                if (response.success) {
                    alert(response.message);
                } else {
                    alert(response.message);
                }
            }
        });

    });
});
