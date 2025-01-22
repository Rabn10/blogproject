<!DOCTYPE html>
<html>
  <head> 
    <base href="/public">
    @include('admin.css')

    <style type="text/css">

        .post_title{
            font-size: 30px;
            font-weight: bold;
            text-align: center;
            padding: 30px;
            color: #fff;
        }

        .div_center{
            text-align: center;
            padding: 30px;
        }

        label {
            display:inline-block;
            width: 200px;
        }

    </style>



  </head>
  <body>
    @include('admin.header')

    <div class="d-flex align-items-stretch">
      <!-- Sidebar Navigation-->
        @include('admin.sidebar')
      <!-- Sidebar Navigation end-->
      <div class="page-content">

        <h1 class="post_title">Edit Post</h1>

        @if(session()->has('message'))
            <div class="alert alert-success">

                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                {{ session()->get('message') }}
            </div>
        @endif

        <form action="{{url('update_post',$post->id)}}" method="POST" enctype="multipart/form-data">

            @csrf


            <div class="div_center">
                <label>Post Title</label>
                <input type="text" name="title" value="{{$post->title}}"/>
            </div>

            <div class="div_center">
                <label>Post Description</label>
                <textarea name="description">{{$post->description}}</textarea>
            </div>

            <div class="div_center">
                <label>Old Image:</label>
                <img src="/postimages/{{$post->image}}" width="100px" height="100px" style="margin:auto"/>
            </div>

            <div class="div_center">
                <label>Add Image</label>
                <input type="file" name="image"/>
            </div>

            <div class="div_center">
                <input type="submit" class="btn btn-primary" value="Update"/>
            </div>

        </form>

      </div>
        
        @include('admin.footer')
  </body>
</html>