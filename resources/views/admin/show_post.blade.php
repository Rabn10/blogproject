<!DOCTYPE html>
<html>
  <head>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
    @include('admin.css')

    <style type="text/css">
      .title_deg{
        font-size: 30px;
        font-weight: bold;
        color: #fff;
        padding: 30px;
        text-align: center;
      }

      .table_deg{
        border: 1px solid #fff;
        width: 80%;
        text-align: center;
        margin-left: 70px;
      }

      .th_deg {
        background-color: skyblue;
      }

      .img_deg{
        height: 100px;
        width: 150px;
        padding: 10px;
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
            <h1 class="title_deg">All Post</h1>

            @if(session()->has('message'))
            <div class="alert alert-danger">

                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                {{ session()->get('message') }}
            </div>
        @endif


            <table class="table_deg">
                <tr class="th_deg">
                    <th>Post title</th>
                    <th>Description</th>
                    <th>Post By</th>
                    <th>Post Status</th>
                    <th>UserType</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>

                @foreach($post as $post)

                <tr>
                    <td>{{$post->title}}</td>
                    <td>{{$post->description}}</td>
                    <td>{{$post->name}}</td>
                    <td>{{$post->post_status}}</td>
                    <td>{{$post->usertype}}</td>
                    <td>
                        <img class="img_deg" src="postimages/{{$post->image}}" />
                    </td>
                    <td>
                      <a href="{{url('edit_page', $post->id)}}" class="btn btn-success">Edit</a>
                        <a href="{{url('delete_post', $post->id)}}" class="btn btn-danger" onclick="confirmation(event)">Delete</a>
                    </td>

                </tr>

                @endforeach

            </table>


        </div>  

        
        @include('admin.footer')

        <script type="text/javascript">
          function confirmation(e){
            e.preventDefault();
            var url = e.currentTarget.getAttribute('href');

            console.log('url', url);

            swal({
              title: "Are you sure to delete this",

              text: "you will not be able to recover this data",

              icon: "warning",

              buttons: true,

              dangerMode: true,
            })
            .then((willcancle)=>{
              if(willcancle){
                window.location.href = url;
              }
            })
          }

        </script>

  </body>
</html>