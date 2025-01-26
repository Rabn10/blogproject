<!DOCTYPE html>
<html lang="en">
   <head>
      <!-- basic -->
      @include('home.homecss')

      <style type="text/css">
         .post_deg{
            padding: 30px;
            text-align: center;
         }

        .title_deg{
            font-size: 30px;
            font-weight: bold;
            padding: 15px;
            color: #000;
        }

        .des_deg{
            font-size: 18px;
            font-weight: bold;
            padding: 15px;
        }

        .img_deg {
            height: 300px;
            width: 300px;
            padding: 30px;
            margin: auto;
        }

      </style>   

   </head>
   <body>
      <!-- header section start -->
      <div class="header_section">
         @include('home.header')

      </div>

      @if(session()->has('message'))
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
             {{session()->get('message')}}
        </div>
      @endif

      @foreach($post as $post)
      <div class="post_deg">
          <img class="img_deg" src="/postimages/{{$post->image}}" alt="">
          <h4 class="title_deg">{{$post->title}}</h4>
        <p class="des_deg">{{$post->description}}</p>
        <a onClick="return confirm('Are you sure you want to delete this post?')" href="{{url('my_post_del', $post->id)}}" class="btn btn-danger">Delete</a>
        <a href="{{url('post_update_page', $post->id)}}" class="btn btn-primary">Edit</a>
      </div>
      @endforeach


      <!-- footer section start -->
         @include('home.footer')
   </body>
</html>