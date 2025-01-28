<!DOCTYPE html>
<html lang="en">
   <head>
      <!-- basic -->
      <base href="/public">
      @include('home.homecss')

      <style type="text/css">
         .blog-title {
            /* text-align: center; */
            font-size: 30px;
            font-weight: bold;
         }
         .blogpost {
            display: flex;
            justify-content: space-between;
         }

         .search-blog {
            height: 40px;
            width: 66%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #000;
            margin-right: 10px;
         }

      </style>   

   </head>
   <body>
      <!-- header section start -->
      <div class="header_section">
         @include('home.header')
      </div>

      <div class="services_section layout_padding">
         <div class="container">
            <div class="blogpost">
                <h1 class="blog-title">Blog Posts</h1>
                <form>
                    <input type="text" name="search" placeholder="Search blog" class="search-blog">
                    <button type="submit" style="cursor: pointer;" class="btn btn-primary">
                        Search
                    </button>
                </form>
            </div>
            <div class="services_section_2">
               <div class="row">
                @foreach($post as $item)
                    <div class="col-md-4" style="padding:30px">
                        <div><img style="margin-bottom: 20px; height: 400px; width: 400px" src="/postimages/{{$item->image}}"></div>
                        <h4 style="text-align: center"><b>{{$item->title}}</b></h4>
                        <p style="text-align: center">Posted by: <b>{{$item->name}}</b></p>
                        <div class="btn_main"><a href="{{url('post_details',$item->id)}}">Read More</a></div>
                    </div>
                @endforeach
               </div>
               <div class="d-flex justify-content-center mt-4">
                  {{ $post->links() }}
               </div>
            </div>
         </div>
      </div>

      <!-- footer section start -->
         @include('home.footer')
   </body>
</html>