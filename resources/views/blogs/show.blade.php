@extends('layouts.homeLayout')
@section('content')
<section class="home-slider ftco-degree-bg">
      <div class="slider-item bread-wrap" style="background-image: url('images/bg_1.jpg');" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
          <div class="row slider-text justify-content-center align-items-center">
            <div class="col-md-10 col-sm-12 ftco-animate mb-4 text-center">
              <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home</a></span> <span class="mr-2"><a href="blog.html">Blog</a></span> <span>Single Blog</span></p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="ftco-section ftco-degree-bg">
      <div class="container">
        <div class="row">
          <div class="col-md-8 ftco-animate">
              @isset($blog)
            <h2 class="mb-3">{{$blog->title}}</h2>
            <p>{{$blog->body}}</p>
            <p>
            <img src="{{asset('$blog->blog_image')}}" alt="" class="img-fluid">
            </p>
                          <div class="tagcloud">
                <a href="#" class="tag-cloud-link">Life</a>
                <a href="#" class="tag-cloud-link">Sport</a>
                <a href="#" class="tag-cloud-link">Tech</a>
                <a href="#" class="tag-cloud-link">Travel</a>
              </div>
            </div>
            
            <div class="about-author d-flex p-5 bg-light">
              <div class="bio align-self-md-center mr-5">
                <img src="images/person_1.jpg" alt="Image placeholder" class="img-fluid mb-4">
              </div>
              <div class="desc align-self-md-center">
                <h3>{{$blog->user->name}}</h3>
              </div>
            </div>


            <div class="pt-5 mt-5">
              <h3 class="mb-5">
              {{$blog->comments_count}}
              Comments
              </h3>
              <ul id="comment-list">
                <comment-component></comment-component>
                @isset($blog->comments)
                @foreach($blog->comments as $comment)
               <li class="comment">
                   <div class="vcard bio">
                     <img src="images/person_1.jpg" alt="Image placeholder">
                   </div>
                   <div class="comment-body">
                     <h3>{{$comment->user->name}}</h3>
                     <div class="meta">{{$comment->created_at}}</div>
                     <p>{{$comment->body}}</p>
                     <p><a href="#" class="reply">Reply</a></p>
                   </div>
                 </li>
                 @endforeach
                 @endisset
              </ul>
              <!-- END comment-list -->
              
              <div class="comment-form-wrap pt-5">
                <h3 class="mb-5">Leave a comment</h3>
                  <div class="form-group">
                    <label for="message">Comment</label>
                    <textarea  id="inputComment" cols="30" rows="10" class="form-control"></textarea>
                    <button id="postComment" class="btn py-3 px-4 btn-primary">Post A Comment</button>
                </div>
              </div>
            </div>
@endisset
          </div> <!-- .col-md-8 -->
          <div class="col-md-4 sidebar ftco-animate">
            <div class="sidebar-box">
              <form action="#" class="search-form">
                <div class="form-group">
                  <span class="icon fa fa-search"></span>
                  <input type="text" class="form-control" placeholder="Type a keyword and hit enter">
                </div>
              </form>
            </div>
            <div class="sidebar-box ftco-animate">
              <div class="categories">
                <h3>Categories</h3>
                <li><a href="#">Food <span>(12)</span></a></li>
                <li><a href="#">Dish <span>(22)</span></a></li>
                <li><a href="#">Desserts <span>(37)</span></a></li>
                <li><a href="#">Drinks <span>(42)</span></a></li>
                <li><a href="#">Ocassion <span>(14)</span></a></li>
              </div>
            </div>

            <div class="sidebar-box ftco-animate">
              <h3>Recent Blog</h3>
              <div class="block-21 mb-4 d-flex">
                <a class="blog-img mr-4" style="background-image: url(images/image_1.jpg);"></a>
                <div class="text">
                  <h3 class="heading"><a href="#">Even the all-powerful Pointing has no control about the blind texts</a></h3>
                  <div class="meta">
                    <div><a href="#"><span class="icon-calendar"></span> July 12, 2018</a></div>
                    <div><a href="#"><span class="icon-person"></span> Admin</a></div>
                    <div><a href="#"><span class="icon-chat"></span> 19</a></div>
                  </div>
                </div>
              </div>
              <div class="block-21 mb-4 d-flex">
                <a class="blog-img mr-4" style="background-image: url(images/image_2.jpg);"></a>
                <div class="text">
                  <h3 class="heading"><a href="#">Even the all-powerful Pointing has no control about the blind texts</a></h3>
                  <div class="meta">
                    <div><a href="#"><span class="icon-calendar"></span> July 12, 2018</a></div>
                    <div><a href="#"><span class="icon-person"></span> Admin</a></div>
                    <div><a href="#"><span class="icon-chat"></span> 19</a></div>
                  </div>
                </div>
              </div>
              <div class="block-21 mb-4 d-flex">
                <a class="blog-img mr-4" style="background-image: url(images/image_3.jpg);"></a>
                <div class="text">
                  <h3 class="heading"><a href="#">Even the all-powerful Pointing has no control about the blind texts</a></h3>
                  <div class="meta">
                    <div><a href="#"><span class="icon-calendar"></span> July 12, 2018</a></div>
                    <div><a href="#"><span class="icon-person"></span> Admin</a></div>
                    <div><a href="#"><span class="icon-chat"></span> 19</a></div>
                  </div>
                </div>
              </div>
            </div>

            <div class="sidebar-box ftco-animate">
              <h3>Tag Cloud</h3>
              <div class="tagcloud">
                <a href="#" class="tag-cloud-link">dish</a>
                <a href="#" class="tag-cloud-link">menu</a>
                <a href="#" class="tag-cloud-link">food</a>
                <a href="#" class="tag-cloud-link">sweet</a>
                <a href="#" class="tag-cloud-link">tasty</a>
                <a href="#" class="tag-cloud-link">delicious</a>
                <a href="#" class="tag-cloud-link">desserts</a>
                <a href="#" class="tag-cloud-link">drinks</a>
              </div>
            </div>

            <div class="sidebar-box ftco-animate">
              <h3>Paragraph</h3>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus itaque, autem necessitatibus voluptate quod mollitia delectus aut, sunt placeat nam vero culpa sapiente consectetur similique, inventore eos fugit cupiditate numquam!</p>
            </div>
          </div>

        </div>
      </div>
    </section> <!-- .section -->
<script>
  document.getElementById('postComment').addEventListener('click',function(){
    let comment = document.getElementById('inputComment').value;
    if(comment != '' || comment != null){
      $.ajax({
    headers: {
       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             },
  type: 'POST',
   url:"{{route('blogs.comment',['id'=>$blog->id])}}",
   data:{'comment':comment},
       success:function(response){
        if($.isEmptyObject(response.error)){
            // console.log(response);
            renderResponse(response);
            // alert(response.success);
        }else{
          alert(false);
            // printErrorMsgEvent(response.error);
        }
       }
    }); 
    }

  });
  function renderResponse(commentData){
    // <li class="comment">
    //               <div class="vcard bio">
    //                 <img src="images/person_1.jpg" alt="Image placeholder">
    //               </div>
    //               <div class="comment-body">
    //                 <h3>John Doe</h3>
    //                 <div class="meta">June 27, 2018 at 2:21pm</div>
    //                 <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur quidem laborum necessitatibus, ipsam impedit vitae autem, eum officia, fugiat saepe enim sapiente iste iure! Quam voluptas earum impedit necessitatibus, nihil?</p>
    //                 <p><a href="#" class="reply">Reply</a></p>
    //               </div>
    //             </li>

    let commentContainer =document.getElementById('comment-list');
    let li = document.createElement('li');
    let imageDiv = document.createElement('div');
    let commentImage=new Image;
    let commentBodyDiv = document.createElement('div');
    let commentBodyDivH3 = document.createElement('h3');
    let commentBodyChiledDiv = document.createElement('div');
    let commentBodyDivbody =  document.createElement('p');
    let commentBodyDivReplyContainer =  document.createElement('p');
    let commentBodyDivReplyLink = document.createElement('a');
        commentBodyDivReplyLink.innerHTML = 'Reply';
        commentBodyDivH3.innerHTML = commentData.user.name;
        commentBodyChiledDiv.innerHTML=commentData.comment.created_at;
        commentBodyDivbody.innerHTML = commentData.comment.body;

        li.classList.add('comment');
        imageDiv.classList.add('vcard','bio');
        commentBodyDiv.classList.add('comment-body')
        imageDiv.appendChild(commentImage);
        commentBodyDivReplyContainer.appendChild(commentBodyDivReplyLink);
        commentBodyDiv.appendChild(commentBodyDivH3);
        commentBodyDiv.appendChild(commentBodyChiledDiv);
        commentBodyDiv.appendChild(commentBodyDivbody);
        commentBodyDiv.appendChild(commentBodyDivReplyContainer);
        li.appendChild(imageDiv);
        li.appendChild(commentBodyDiv);
        commentContainer.appendChild(li);
    
  }
</script>
@endsection