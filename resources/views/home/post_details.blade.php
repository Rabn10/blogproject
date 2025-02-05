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
         .reply-btn{
            margin-left: 1rem;
         }
      </style>
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      <script src={{ asset('js/deletecomment.js') }}></script>
      <script src={{ asset('js/reply.js') }}></script>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


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
                  <div class="comment mb-3 position-relative p-2 border rounded" style="background-color: #f9f9f9;" id="comment-{{$comments->id}}">

                    <!-- Three Dots Menu -->
                        <div class="dropdown position-absolute" style="top: 5px; right: 10px;">
                            <button class="btn btn-link p-0" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="text-decoration: none; color: #000;">
                            &#x22EE;  <!-- Vertical Ellipsis (three dots) -->
                            </button>
                            <ul class="dropdown-menu">
                                @if(Auth::user() && Auth::id() == $comments->user_id)
                                <li><button class="edit-comment btn btn-primary btn-sm">Edit</button></li>
                                <li><button class="delete-comment btn btn-danger btn-sm" data-id="{{ $comments->id }}">Delete</button></li>
                                @elseif(Auth::check())
                                <li><a class="dropdown-item report-comment" href="#" data-id="{{$comments->id}}">Report</a></li>
                                @endif
                            </ul>
                        </div>


                        <p><strong style="color: #000">{{$comments->name}}</strong></p>
                        <small>{{$comments->created_at->format('M d, Y')}}</small>
                        <div class="comment-text">
                            <p style="color: #000;">{{$comments->comment}}</p>
                         </div>
                         
                         <div class="edit-section" style="display: none;">
                            <textarea class="form-control edit-comment-area">{{$comments->comment}}</textarea>
                            <button class="btn btn-success btn-sm mt-2 save-btn" data-id="{{ $comments->id }}">Save</button>
                            <button class="btn btn-secondary btn-sm mt-2 cancel-btn">Cancel</button>
                         </div>
                        
                        <button class="comment-like-btn {{$user && $comments->isCommentLikedByUser($user->id) ? 'liked' : ''}}" data-id="{{$comments->id}}" >
                            <i class="far fa-thumbs-up"></i>  (<span class="like-count">{{$comments->like_count}}</span>)
                        </button>

                        {{-- show reply --}}
                        <button class="reply-btn" data-id="{{ $comments->id }}">
                            <i class="far fa-comment reply-count">(<span class="reply-count" id="reply-count-{{ $comments->id }}">0</span>)</i> 
                        </button>

                       


                        {{-- reply section --}}
                        <button class="reply reply-btn">Reply</button>
                        <div class="reply-section" style="display: none;">
                            <textarea class="form-control reply-area"></textarea>
                            <button class="btn btn-primary btn-sm mt-2 save-reply-btn" data-id="{{ $comments->id }}">Reply</button>
                            <button class="btn btn-secondary btn-sm mt-2 cancel-reply-btn">Cancel</button>
                         </div> 

                         {{-- display reply --}}
                         <div class="display-reply" style="display: none;"></div>
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