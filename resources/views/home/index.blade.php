    @extends('layouts.homeLayout')
    @section('content')
    <section class="home-slider ftco-degree-bg">
      <div class="slider-item">
        <div class="overlay"></div>
        <div class="container">
          <div class="row slider-text align-items-center justify-content-center">
            <div class="col-md-10 ftco-animate text-center">
              <h1 class="mb-4">
                <strong class="typewrite" data-period="4000" 
                data-type='[ "It’s all coming.", 
                            "All your money in one place"]'>
                  <span class="wrap"></span>
                </strong>
              </h1>
              <p>When you’re on top of your money, life is good. We help you effortlessly manage your finances in one place.</p>
              <p>
                <a href="https://vimeo.com/45830194" class="btn btn-primary btn-outline-white px-4 py-3 popup-vimeo">
                <!-- <span class="ion-ios-play mr-2"></span> -->
                 Watch Video</a>

                <a href="#" class="btn btn-primary btn-outline-white px-4 py-3">Sign Up</a>

              </p>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- END slider -->

    <section class="ftco-section-featured ftco-animate">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="carousel owl-carousel">
              <div class="item">
                <a href="portfolio.html">
                  <img src="{{asset('UI/homePage/images/dashboard_full_1.jpg')}}" class="img-fluid" alt="">
                </a>
              </div>
              <div class="item">
                <a href="portfolio.html">
                  <img src="{{asset('UI/homePage/images/dashboard_full_2.jpg')}}" class="img-fluid" alt="">
                </a>
              </div>
              <div class="item">
                <a href="portfolio.html">
                  <img src="{{asset('UI/homePage/images/dashboard_full_3.jpg')}}" class="img-fluid" alt="">
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="ftco-section">
      <div class="container-fluid">
        <div class="row no-gutters justify-content-center mb-5 pb-5">
          <div class="col-md-7 text-center heading-section ftco-animate">
            <span class="subheading">About</span>
            <h2>About App</h2>
          </div>
        </div>
        <div class="row no-gutters">
        <div class="block-3 d-md-flex ftco-animate">
            <a href="portfolio.html" class="image" style="background-image: url({{asset('UI/homePage/images/work-1.jpg')}}); "></a>
            <div class="text">
              <h4 class="subheading">Easy Access</h4>
              <h2 class="heading"><a href="#">All your money in one place</a></h2>
              <p>We bring together all of your income, bills and more, so you can conveniently manage your finances from one dashboard,you See  all of your bills and money at a glance</p>
            </div>
          </div>

          <div class="block-3 d-md-flex ftco-animate">
            <a href="portfolio.html" class="image order-2" style="background-image: url({{asset('UI/homePage/images/work-2.jpg')}}); "></a>
            <div class="text order-1">
              <h4 class="subheading">Get Notifications</h4>
              <h2 class="heading"><a href="#">Effortlessly stay on top of bills</a></h2>
              <p>Bills are now easier than ever to track. Simply add them to your dashboard to see and monitor them all at once.Receive reminders for upcoming bills so you can plan ahead, Never miss a payment with alerts when bills are due</p>
            </div>
          </div>

        </div>
      </div>
    </section>    

    <section class="ftco-section ftco-degree-bg">
      <div class="container">
        <div class="row justify-content-center mb-5 pb-5">
          <div class="col-md-7 text-center heading-section ftco-animate">
            <span class="subheading">Our Features</span>
            <h2>Intuitive features, powerful results</h2>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6 col-lg-3 d-flex align-self-stretch ftco-animate">
            <div class="media block-6 services d-block text-center">
              <div class="d-flex justify-content-center"><div class="icon color-1 d-flex justify-content-center mb-3"><span class="align-self-center icon-file"></span></div></div>
              <div class="media-body p-2">
                <h3 class="heading">All-in-one finances</h3>
                <p>We bring all of your money to one place, from balances and bills to credit score.</p>
              </div>
            </div>      
          </div>
          <div class="col-md-6 col-lg-3 d-flex align-self-stretch ftco-animate">
            <div class="media block-6 services d-block text-center">
              <div class="d-flex justify-content-center"><div class="icon color-2 d-flex justify-content-center mb-3"><span class="align-self-center icon-credit-card"></span></div></div>
              <div class="media-body p-2">
                <h3 class="heading">Unlimited credit scores</h3>
                <p>Check your free credit score as many times as you like, and get tips to help improve it.</p>
              </div>
            </div>      
          </div>
          <div class="col-md-6 col-lg-3 d-flex align-self-stretch ftco-animate">
            <div class="media block-6 services d-block text-center">
              <div class="d-flex justify-content-center"><div class="icon color-3 d-flex justify-content-center mb-3"><span class="align-self-center icon-security"></span></div></div>
              <div class="media-body p-2">
                <h3 class="heading">serious about security</h3>
                <p>We’re committed to keeping your data secure. With multiple safety measures.</p>
              </div>
            </div>    
          </div>

          <div class="col-md-6 col-lg-3 d-flex align-self-stretch ftco-animate">
            <div class="media block-6 services d-block text-center">
              <div class="d-flex justify-content-center"><div class="icon color-4 d-flex justify-content-center mb-3"><span class="align-self-center icon-track_changes"></span></div></div>
              <div class="media-body p-2">
                <h3 class="heading">budget tracker</h3>
                <p>We’ll show you exactly how your spending decisions affect the money you have</p>
              </div>
            </div>      
          </div>
        </div>
      </div>
    </section>

    <section class="ftco-section-parallax ftco-degree-bg">
      <div class="parallax-img d-flex align-items-center">
        <div class="container">
          <div class="row d-flex justify-content-center">
            <div class="col-md-10 text-center heading-section heading-section-white ftco-animate">
              <h2 class="h1 font-weight-bold">From budgets and bills to free credit score and more, you’ll discover the effortless way to stay on top of it all.</h2>
              <p>
              <a href="#" class="btn btn-primary btn-outline-white mt-3 py-3 px-4">Sign Up</a>
              <a href="#" class="btn btn-primary btn-outline-white mt-3 py-3 px-4">Login</a>
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>



    <section class="ftco-section testimony-section ftco-degree-bg">
      <div class="container">
        <div class="row justify-content-center mb-5 pb-5">
          <div class="col-md-7 text-center heading-section ftco-animate">
            <span class="subheading">Customer Says</span>
            <h2>Our satisfied customer says</h2>
          </div>
        </div>
        <div class="row ftco-animate">
          <div class="col-md-12">
            <div class="carousel-testimony owl-carousel ftco-owl">
              <div class="item text-center">
                <div class="testimony-wrap p-4 pb-5">
                  <div class="user-img mb-4" style="background-image: url({{asset('UI/homePage/images/person_1.jpg')}}); ">
                    <span class="quote d-flex align-items-center justify-content-center">
                      <i class="icon-quote-left"></i>
                    </span>
                  </div>
                  <div class="text">
                    <p class="mb-5">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                    <p class="name">Dennis Green</p>
                    <span class="position">Marketing Manager</span>
                  </div>
                </div>
              </div>
              <div class="item text-center">
                <div class="testimony-wrap p-4 pb-5">
                  <div class="user-img mb-4" style="background-image: url({{asset('UI/homePage/images/person_2.jpg')}}); ">
                    <span class="quote d-flex align-items-center justify-content-center">
                      <i class="icon-quote-left"></i>
                    </span>
                  </div>
                  <div class="text">
                    <p class="mb-5">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                    <p class="name">Dennis Green</p>
                    <span class="position">Interface Designer</span>
                  </div>
                </div>
              </div>
              <div class="item text-center">
                <div class="testimony-wrap p-4 pb-5">
                  <div class="user-img mb-4" style="background-image: url({{asset('UI/homePage/images/person_3.jpg')}}); ">
                    <span class="quote d-flex align-items-center justify-content-center">
                      <i class="icon-quote-left"></i>
                    </span>
                  </div>
                  <div class="text">
                    <p class="mb-5">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                    <p class="name">Dennis Green</p>
                    <span class="position">UI Designer</span>
                  </div>
                </div>
              </div>
              <div class="item text-center">
                <div class="testimony-wrap p-4 pb-5">
                  <div class="user-img mb-4"style="background-image: url({{asset('UI/homePage/images/person_1.jpg')}}); ">
                    <span class="quote d-flex align-items-center justify-content-center">
                      <i class="icon-quote-left"></i>
                    </span>
                  </div>
                  <div class="text">
                    <p class="mb-5">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                    <p class="name">Dennis Green</p>
                    <span class="position">Web Developer</span>
                  </div>
                </div>
              </div>
              <div class="item text-center">
                <div class="testimony-wrap p-4 pb-5">
                  <div class="user-img mb-4" style="background-image: url({{asset('UI/homePage/images/person_1.jpg')}}); ">
                    <span class="quote d-flex align-items-center justify-content-center">
                      <i class="icon-quote-left"></i>
                    </span>
                  </div>
                  <div class="text">
                    <p class="mb-5">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                    <p class="name">Dennis Green</p>
                    <span class="position">System Analytics</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    
    <!-- <section class="ftco-section ftco-counter ftco-degree-bg" id="section-counter">
      <div class="container">
        <div class="row justify-content-center mb-5 pb-5">
          <div class="col-md-7 text-center heading-section heading-section-white ftco-animate">
            <h2>Our achievements</h2>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6 col-lg-4 d-flex justify-content-center counter-wrap ftco-animate">
            <div class="block-18 text-center">
              <div class="text">
                <strong class="number" data-number="1000">0</strong>
                <span>Customers are satisfied with our professional support</span>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-4 d-flex justify-content-center counter-wrap ftco-animate">
            <div class="block-18 text-center">
              <div class="text">
                <strong class="number" data-number="12000">0</strong>
                <span>Amazing preset options to be mixed and combined</span>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-4 d-flex justify-content-center counter-wrap ftco-animate">
            <div class="block-18 text-center">
              <div class="text">
                <strong class="number" data-number="10000">0</strong>
                <span>Average response time on live chat support channel</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section> -->

    <section class="ftco-section ftco-degree-bg">
      <div class="container">
        <div class="row justify-content-center mb-5 pb-5">
          <div class="col-md-7 text-center heading-section ftco-animate">
            <span class="subheading">Blog</span>
            <h2>Recent Blog</h2>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4 ftco-animate">
            <div class="blog-entry">
              <a href="blog-single.html" class="block-20" style="background-image: url({{asset('UI/homePage/images/image_1.jpg')}}); ">
              </a>
              <div class="text p-4 d-block">
                <div class="meta mb-3">
                  <div><a href="#">July 12, 2018</a></div>
                  <div><a href="#">Admin</a></div>
                  <!-- <div><a href="#" class="meta-chat"><span class="icon-chat"></span> 3</a></div> -->
                </div>
                <h3 class="heading"><a href="#">Even the all-powerful Pointing has no control about the blind texts</a></h3>
              </div>
            </div>
          </div>
          <div class="col-md-4 ftco-animate">
            <div class="blog-entry" data-aos-delay="100">
              <a href="blog-single.html" class="block-20" style="background-image: url({{asset('UI/homePage/images/image_2.jpg')}}); ">
              </a>
              <div class="text p-4">
                <div class="meta mb-3">
                  <div><a href="#">July 12, 2018</a></div>
                  <div><a href="#">Admin</a></div>
                  <!-- <div><a href="#" class="meta-chat"><span class="icon-chat"></span> 3</a></div> -->
                </div>
                <h3 class="heading"><a href="#">Even the all-powerful Pointing has no control about the blind texts</a></h3>
              </div>
            </div>
          </div>
          <div class="col-md-4 ftco-animate">
            <div class="blog-entry" data-aos-delay="200">
              <a href="blog-single.html" class="block-20" style="background-image: url({{asset('UI/homePage/images/image_3.jpg')}}); ">
              </a>
              <div class="text p-4">
                <div class="meta mb-3">
                  <div><a href="#">July 12, 2018</a></div>
                  <div><a href="#">Admin</a></div>
                  <!-- <div><a href="#" class="meta-chat"><span class="icon-chat"></span> 3</a></div> -->
                </div>
                <h3 class="heading"><a href="#">Even the all-powerful Pointing has no control about the blind texts</a></h3>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="ftco-section contact-section ftco-degree-bg">
      <div class="container bg-light">
        <div class="row d-flex mb-5 contact-info">
          <div class="col-md-12 mb-4">
            <h2 class="h4">Contact Information</h2>
          </div>
          <div class="w-100"></div>
          <div class="col-md-3">
            <p><span>Address:</span> 198 West 21th Street, Suite 721 New York NY 10016</p>
          </div>
          <div class="col-md-3">
            <p><span>Phone:</span> <a href="tel://1234567920">+ 1235 2355 98</a></p>
          </div>
          <div class="col-md-3">
            <p><span>Email:</span> <a href="mailto:info@yoursite.com">info@yoursite.com</a></p>
          </div>
          <div class="col-md-3">
            <p><span>Website</span> <a href="#">yoursite.com</a></p>
          </div>
        </div>
        <div class="row block-9">
          <div class="w-100">
            <form action="#">
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Your Name">
              </div>
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Your Email">
              </div>
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Subject">
              </div>
              <div class="form-group">
                <textarea name="" id="" cols="30" rows="7" class="form-control" placeholder="Message"></textarea>
              </div>
              <div class="form-group">
                <input type="submit" value="Send Message" class="btn btn-primary py-3 px-5">
              </div>
            </form>
          
          </div>
        </div>
      </div>
    </section>
    

  @endsection