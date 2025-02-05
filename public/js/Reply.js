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


    $('.reply-btn').on('click', function() {
        const commentId = $(this).closest('.comment').attr('id').split('-')[1];
        const replySection = $(this).siblings('.display-reply');

        if(replySection.is(':empty')) {
            $.ajax({
                url : '/reply/' + commentId,
                type : 'GET',
                success : function(response) {
                    const replies = response.replies;
                // console.log('reply', replies.data[0].name);
                    replies.forEach(reply => {
                        replySection.append(`
                            <div class="reply p-2 border rounded mb-2" style="background-color: #f1f1f1;">
                                <p><strong style="font-weight: 800; color: #000;">${reply.name}</strong></p>
                                <small>${new Date(reply.created_at).toLocaleDateString()}</small>
                                <p>${reply.reply}</p>
                            </div>
                        `);
                    });
                }
            });
        }

        replySection.toggle();
    });

    $(document).ready(function(){
        $('.reply-btn').each(function(){
            const commentId = $(this).data('id');
            console.log('commentId', commentId);

            if(commentId) {
                $.ajax({
                    url: '/reply/' + commentId,
                    type: 'GET',
                    success: function(response) {
                        const repliesCount = response.repliesCount;
                        $('#reply-count-' + commentId).text(repliesCount);
                    },
                    error:function() {
                        console.log('error');
                    }
                })
            }
        })
    })

});