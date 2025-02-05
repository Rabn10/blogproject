$(document).ready(function () {
    $(document).on('click', '.reply', function () {
        const replyDiv = $(this).closest('.comment');
        const replySection = replyDiv.find('.reply-section');

        //show the textarea
        replySection.show();
    });

    //cancle reply
    $(document).on('click', '.cancel-reply-btn', function () {
        const replyDiv = $(this).closest('.comment');
        const replySection = replyDiv.find('.reply-section');

        //hide the textarea
        replySection.hide();
    });

    //save reply
    $(document).on('click', '.save-reply-btn', function (e) {
        e.preventDefault();
        const replyDiv = $(this).closest('.comment');
        const replySection = replyDiv.find('.reply-section');
        const replyText = replyDiv.find('.reply-area');
        const commentId = $(this).data('id');

        //hide the textarea
        replySection.hide();
        const reply = replyText.val();

        //send an ajax request to save the reply
        $.ajax({
            url : '/reply',
            type : 'POST',
            data : {
                _token : $('meta[name="csrf-token"]').attr('content'),
                comment_id : commentId,
                reply : reply
            },
            success : function (data) {
                replyText.val('');
                replyDiv.find('.replies').append(data.html);
            }
        })

    })
});