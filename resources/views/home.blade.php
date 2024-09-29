@extends('layouts.app')

@section('content')
    <!-- ======= Hero Section ======= -->
  <section id="hero">
    <div id="heroCarousel" data-bs-interval="5000" class="carousel slide carousel-fade" data-bs-ride="carousel">

      <div class="carousel-inner" role="listbox">


        @foreach ($sliders as $slider)
        <div class="carousel-item active" style="background-image: url(assets/img/slide/slide-1.jpg);">
          <div class="carousel-container">
            {{-- <div class="carousel-content animate__animated animate__fadeInUp">
              <h2>{{ $slider->title }} </h2>
              <p>{{ $slider->short_description}}</p>
              <div class="text-center"><a href="" class="btn-get-started">Read More</a></div>
            </div> --}}
          </div>
        </div>
        @endforeach

      </div>

      <a class="carousel-control-prev" href="#heroCarousel" role="button" data-bs-slide="prev">
        <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
      </a>

      <a class="carousel-control-next" href="#heroCarousel" role="button" data-bs-slide="next">
        <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
      </a>

      <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>

    </div>
  </section><!-- End Hero -->

  <main id="main">

    <!-- ======= About Us Section ======= -->
    <section id="about-us" class="about-us">
      <div class="container pt-5" data-aos="fade-up">

        <div class="row content pt-5">
          <div class="col-lg-12" data-aos="fade-right">
            <h2>Innovating Your Digital Future</h2>
            <p>At Lucrative IT, we are committed to turning your digital ambitions into tangible realities. With over a decade of experience, we excel in delivering innovative solutions that drive business growth. Our expertise spans various services, including compelling animation videos that engage audiences, intuitive UI/UX design that enhances user experience, and robust software and app development that powers your operations. We take a holistic approach to every project, ensuring it aligns perfectly with your business goals—partner with us to transform your digital presence and achieve lasting success in today’s fast-paced market.</p>
          </div>
          <div class="col-lg-12 pt-5" data-aos="fade-right">
            <h2>Your Vision, Our Expertise</h2>
            <p>Welcome to Lucrative IT, where your vision meets our unparalleled expertise. We provide a full
                spectrum of digital services designed to elevate your brand and streamline your operations.
                With over 10 years of industry experience, we specialize in creating visually stunning websites,
                highly functional mobile apps, and engaging animation videos. Our UI/UX design team ensures
                that your digital products are beautiful and user-friendly. Additionally, our technical consulting
                services help you navigate complex challenges with ease. Let’s collaborate to turn your vision
                into reality and set your business apart in the digital age.</p>
          </div>
        </div>

      </div>
    </section><!-- End About Us Section -->

    <!-- ======= Services Section ======= -->
    <section id="services" class="services section-bg">
      <div class="container" data-aos="fade-up">

        <div class="row">

          @foreach ($services as $service)
          <div class="col-lg-4 col-md-6 d-flex align-items-stretch pt-5" data-aos="zoom-in" data-aos-delay="100">
            <div class="icon-box iconbox-blue">
              <div class="icon">
                <svg width="100" height="100" viewBox="0 0 600 600" xmlns="http://www.w3.org/2000/svg">
                  <path stroke="none" stroke-width="0" fill="#f5f5f5" d="M300,521.0016835830174C376.1290562159157,517.8887921683347,466.0731472004068,529.7835943286574,510.70327084640275,468.03025145048787C554.3714126377745,407.6079735673963,508.03601936045806,328.9844924480964,491.2728898941984,256.3432110539036C474.5976632858925,184.082847569629,479.9380746630129,96.60480741107993,416.23090153303,58.64404602377083C348.86323505073057,18.502131276798302,261.93793281208167,40.57373210992963,193.5410806939664,78.93577620505333C130.42746243093433,114.334589627462,98.30271207620316,179.96522072025542,76.75703585869454,249.04625023123273C51.97151888228291,328.5150500222984,13.704378332031375,421.85034740162234,66.52175969318436,486.19268352777647C119.04800174914682,550.1803526380478,217.28368757567262,524.383925680826,300,521.0016835830174"></path>
                </svg>
                <i class="bx {{ $service->icon_class }}"></i>
              </div>
              <h4><a href="">{{ $service->title }}</a></h4>
              <p> {{ $service->short_description }}</p>
            </div>
          </div>
          @endforeach
        </div>

      </div>
    </section><!-- End Services Section -->

    <!-- ======= Portfolio Section ======= -->
    <section id="portfolio" class="portfolio">
      <div class="container">

        {{-- <div class="row" data-aos="fade-up">
          <div class="col-lg-12 d-flex justify-content-center">
            <ul id="portfolio-flters">
              <li data-filter="*" class="filter-active">All</li>
              @foreach ($portfolioTypes as $type )
              <li data-filter=".filter-{{ $type->title }}">{{ $type->title }}</li>
              @endforeach
            </ul>
          </div>
        </div> --}}

        <div class="section-title">
            <h2>Portfolio</h2>
        </div>

        <div class="row portfolio-container pt-5" data-aos="fade-up">
          @foreach ($portfolios as $portfolio)
          <div class="col-lg-4 col-md-6 portfolio-item filter-{{ $portfolio->type->title }}">
            <img src="{{ asset('images/portfolio/'.$portfolio->image) }}" class="img-fluid" alt="">
            <div class="portfolio-info">
              <h4>{{ $portfolio->title }}</h4>
              <img src="{{ asset('images/portfolio/'.$portfolio->image) }}" height="50" width="70" alt="">
              <a href="{{ asset('images/portfolio/'.$portfolio->image) }}" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="App 1"><i class="bx bx-plus"></i></a>
              <a href="{{ $portfolio->link }}" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </section><!-- End Portfolio Section -->


        <!-- ======= Our Clients Section ======= -->
        <section id="clients" class="clients">
          <div class="container" data-aos="fade-up">

            <div class="section-title">
              <h2>Clients</h2>
            </div>

            <!-- Carousel wrapper -->
            <div id="carouselExampleControls" data-mdb-carousel-init class="carousel slide text-center carousel-dark" data-mdb-ride="carousel">
              <div class="carousel-inner">
                @php $counter = 0; @endphp
                @foreach ($clientReviews as $clientReview)
                <div class="carousel-item @if($counter == 0) active @endif">
                  @if($clientReview->image)
                  <img class="rounded-circle shadow-1-strong mb-4"
                    src="{{ asset('images/client/'.$clientReview->image) }}" alt="avatar"
                    style="width: 100px;" />
                  @endif
                  <div class="row d-flex justify-content-center">
                    <div class="col-lg-8">
                      <h5 class="mb-3">{{ $clientReview->name }}</h5>
                      <p>{{ $clientReview->designation }}</p>
                      <p class="text-muted">
                        <i class="fas fa-quote-left pe-2"></i>
                        {{ $clientReview->review }}
                      </p>
                    </div>
                  </div>
                  <ul class="list-unstyled d-flex justify-content-center text-warning mb-0">
                    <li><i class="fas fa-star fa-sm"></i></li>
                    <li><i class="fas fa-star fa-sm"></i></li>
                    <li><i class="fas fa-star fa-sm"></i></li>
                    <li><i class="fas fa-star fa-sm"></i></li>
                    <li><i class="far fa-star fa-sm"></i></li>
                  </ul>
                </div>
                @php
                  $counter++;
                @endphp
                @endforeach
              </div>
              <button class="carousel-control-prev" type="button" data-mdb-target="#carouselExampleControls"
                data-mdb-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
              </button>
              <button class="carousel-control-next" type="button" data-mdb-target="#carouselExampleControls"
                data-mdb-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
              </button>
            </div>
            <!-- Carousel wrapper -->
</div>
</section><!-- End Our Clients Section -->


  </main><!-- End #main -->
@endsection


@section('js')



@endsection
