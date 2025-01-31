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
      </style>

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
              <button>
               <i class="far fa-thumbs-up"></i>  <span class="like-count">1</span>
            </button>
            <button>
               <i class="far fa-comment"></i> <span class="comment-count">1</span>
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
                     <button class="btn btn-sm btn-primary like-btn" >
                        <i class="far fa-thumbs-up"></i>  (<span class="like-count">1</span>)
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