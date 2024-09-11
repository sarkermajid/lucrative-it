@extends('layouts.app')

@section('content')


  <main id="main">



    <!-- ======= Services Section ======= -->
    <section id="services" class="services section-bg">
      <div class="container pt-5" data-aos="fade-up">

        <div class="row">



             <!-- ======= Contact Section ======= -->
    <div class="map-section pt-5">
      {{-- <iframe width="100%" height="600" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?q={{settings('site_lat',$settings)}},{{settings('site_lon',$settings)}}&amp;hl=es&amp;z=14&amp;output=embed"> --}}
      </iframe>
    </div>

    <section id="contact" class="contact">
      <div class="container">

        <div class="row justify-content-center" data-aos="fade-up">

          <div class="col-lg-10">

            <div class="info-wrap">
              <div class="row">
                <div class="col-lg-4 info">
                  <i class="bi bi-geo-alt"></i>
                  <h4>Address</h4>
                  <p>Shahbag, dhaka</p>
                </div>

                <div class="col-lg-4 info mt-4 mt-lg-0">
                  <i class="bi bi-envelope"></i>
                  <h4>Email:</h4>
                  <p>rabiul0420@gmail.com<br></p>
                </div>

                <div class="col-lg-4 info mt-4 mt-lg-0">
                  <i class="bi bi-phone"></i>
                  <h4>Call:</h4>
                  <p>01833683530<br></p>
                </div>
              </div>
            </div>

          </div>

        </div>



      </div>
    </section><!-- End Contact Section -->
        </div>

      </div>
    </section><!-- End Services Section -->






  </main><!-- End #main -->
@endsection


@section('js')



@endsection
