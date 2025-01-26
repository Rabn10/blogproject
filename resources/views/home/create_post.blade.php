<!DOCTYPE html>
<html lang="en">
   <head>
      <!-- basic -->
        <style type="text/css">
            .div_deg{
            text-align: center
        }

        .title_deg{
            font-size: 30px;
            font-weight: bold;
            padding: 30px;
        }

        label 
        {   
            display: inline-block;
            width: 200px;
            font-size: 18px;
            font-weight: bold;
        }

        .field_deg{
            padding: 25px;
        }
        </style>

      @include('home.homecss')
   </head>
   <body>

    @include('sweetalert::alert')

      <!-- header section start -->
      <div class="header_section">
         @include('home.header')
      </div>

      <div class="div_deg">
        <h1 class="title_deg">Create Post</h1>
        <form action="{{ url('user_post') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="field_deg">
                <label>Title: </label>
                <input type="text" name="title" placeholder="Title">
            </div>
            <div class="field_deg">
                <label>Description: </label>
                <textarea name="description" placeholder="Description"></textarea>
            </div>
            <div class="field_deg">
                <label>Add Image: </label>
                <input type="file" name="image" >
            </div>
            <div class="field_deg">
                <input type="submit" value="Add Post" class="btn btn-primary">
            </div>
        </form>
      </div>

         @include('home.footer')
   </body>
</html>