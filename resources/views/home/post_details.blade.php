<!DOCTYPE html>
<html lang="en">
   <head>
      <!-- basic -->
      <base href="/public">
      @include('home.homecss')

      <style>
         .blog-description {
            text-align: justify;
            padding: 0 20rem 0 20rem;
            font-size: 20px;
            color: #000;
         }

         .comment-title{
            font-size: 20px;
            font-weight: bold;
         }
         .icon {
            display: flex;
            gap: 2rem;
            justify-content: center;
            font-size: 20px;
            /* align-items: center; */
            /* margin-top: 20px; */
         }

         .liked {
            color: blue;
         }
      </style>
      <meta name="csrf-token" content="{{ csrf_token() }}">

   </head>
   <body>
      <!-- header section start -->
      <div class="header_section">
         @include('home.header')
      </div>

      <div style="text-align: center;"  class="col-md-12">
         <div><img style="padding: 20px; margin: auto" src="/postimages/{{$post->image}}" height="500px" width="500px"></div>
         <h1><b>{{$post->title}}</b></h1>

         {{-- <p class="blog-description">{{$post->description}}</p> --}}
         <p class="blog-description">{!! nl2br(e($post->description)) !!}</p>

           <p>Posted by: <b>{{$post->name}}</b></p>
           <div class="icon">
            @php
                $user = Auth::user();
            @endphp

              <button class="like-btn {{$user && $post->isLikedByUser($user->id) ? 'liked' : ''}}" data-id="{{$post->id}}" >
               <i class="far fa-thumbs-up"></i>  <span class="like-count">{{$post->like_count}}</span>
            </button>
            <button>
               <i class="far fa-comment"></i> <span class="comment-count">{{$commentCount}}</span>
            </button>
           </div>
      </div>
      <hr/>
      <div class="d-flex justify-content-center mt-4">
         <div class="card w-50 p-3">
             <div class="card-body">
                 <h5 class="comment-title">Comments</h5>
     
                 <form action="{{ url('comment') }}" method="post">
                     @csrf
                     <input type="hidden" name="post_id" value="{{ $post->id }}"/>
     
                     <div class="d-flex align-items-center">
                         <textarea class="form-control me-2 border border-secondary" style="height: 3rem;" name="comment"  rows="3" placeholder="Write your comment..." required></textarea>
                         <button type="submit" class="btn btn-primary">Comment</button>
                     </div>
                 </form>
             </div>
             <hr/>
             <div class="comments-section mt-4">
               @foreach($comment as $comments)
                  <div class="comment mb-3">
                     <p><strong style="color: #000">{{$comments->name}}</strong></p>
                     <small>{{$comments->created_at->format('M d, Y')}}</small>
                     <p style="color: #000">{{$comments->comment}}</p>
                     <button class="comment-like-btn {{$user && $comments->isCommentLikedByUser($user->id) ? 'liked' : ''}}" data-id="{{$comments->id}}" >
                        <i class="far fa-thumbs-up"></i>  (<span class="like-count">{{$comments->like_count}}</span>)
                    </button>
                    <button class="btn btn-sm btn-secondary reply-btn">
                     <i class="far fa-comment"></i> Replies
                  </button>    
                  </div>
                  <hr/>
               @endforeach
            </div>
      
         </div>
     </div>
         @include('home.footer')
   </body>
</html>

<script>

$(document).ready(function() {
    $(".like-btn").on("click", function() {
        let button = $(this);
        let postId = button.data("id");

        $.ajax({
            url: "/post-like/" + postId,
            type: "POST",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function(response) {
                if (response.success) {
                    button.find(".like-count").text(response.likes);

                    if (response.liked) {
                        button.addClass("liked");
                    } else {
                        button.removeClass("liked");
                    }
                } else if (response.message === "Unauthorized") {
                    alert("Please log in to like posts.");
                }
            }
        });
    });
});

$(document).ready(function(){
    $('.comment-like-btn').on('click', function(){
        let button = $(this);
        let commentId = button.data('id');

        $.ajax({
            url: '/comment-like/' + commentId,
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.success) {
                    button.find('.like-count').text(response.likes);

                    if (response.liked) {
                        button.addClass('liked');
                    } else {
                        button.removeClass('liked');
                    }
                } else if (response.message === 'Unauthorized') {
                    alert('Please log in to like comments.');
                }
            }
        })
    })
})


</script>