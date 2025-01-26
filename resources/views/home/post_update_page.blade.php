<!DOCTYPE html>
<html lang="en">
   <head>
      <!-- basic -->
      <base href="/public">
      @include('home.homecss')

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
   </head>
   <body>
      <!-- header section start -->
      @include('sweetalert::alert')
      <div class="header_section">
         @include('home.header')
      </div>

      <div class="div_deg">
        <h1 class="title_deg">Update Post</h1>
        <form action="{{ url('update_post_data', $post->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="field_deg">
                <label>Title: </label>
                <input type="text" name="title" value={{ $post->title }}>
            </div>
            <div class="field_deg">
                <label>Description: </label>
                <textarea name="description">{{ $post->description }}</textarea>
            </div>
            <div class="field_deg">
                <label>Current Image: </label>
                <img style="margin: auto" height="150" width="250" src="postimages/{{ $post->image }}">
            </div>
            <div class="field_deg">
                <label>Add Image: </label>
                <input type="file" name="image" >
            </div>
            <div class="field_deg">
                <input type="submit" value="Update Post" class="btn btn-primary">
            </div>
        </form>
      </div>


         @include('home.footer')
   </body>
</html>