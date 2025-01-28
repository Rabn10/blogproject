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
      </div>

         @include('home.footer')
   </body>
</html>