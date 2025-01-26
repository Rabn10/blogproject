<div class="services_section layout_padding">
    <div class="container">
       <h1 class="services_taital">Blog Posts </h1>
       <p class="services_text">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration</p>
       <div class="services_section_2">
          <div class="row">
            @foreach($post as $post)
             <div class="col-md-4" style="padding:30px">
                <div><img style="margin-bottom: 20px; height: 400px; width: 400px" src="/postimages/{{$post->image}}"></div>

                <h4 style="text-align: center"><b>{{$post->title}}</b></h4>

                  <p style="text-align: center">Posted by: <b>{{$post->name}}</b></p>

                <div class="btn_main"><a href="{{url('post_details',$post->id)}}">Read More</a></div>
             </div>
            @endforeach
          </div>
       </div>
    </div>
 </div>