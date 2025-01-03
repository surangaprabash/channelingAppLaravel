<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="stylesheet" href="/bootstrap-5.0.2-dist/css/bootstrap.min.css">
    <script src="/bootstrap-5.0.2-dist/js/bootstrap.js"></script>


    <script src="../assets/js/jquery-3.5.1.min.js"></script>

    <link rel="stylesheet" href="../assets/css/maicons.css">
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    <link rel="stylesheet" href="../assets/vendor/owl-carousel/css/owl.carousel.css">
    <link rel="stylesheet" href="../assets/vendor/animate/animate.css">
    <link rel="stylesheet" href="../assets/css/theme.css">

    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/vendor/owl-carousel/js/owl.carousel.min.js"></script>
    <script src="../assets/vendor/wow/wow.min.js"></script>
    <script src="../assets/js/theme.js"></script>

</head>
<body>
 
    @include('nav')

    <div class="page-hero bg-image overlay-dark" style="background-image: url('{{ asset('assets/img/hospital-improvement-ideas-1024x452.jpeg') }}');">
        <div class="hero-section">
          <div class="container text-center wow zoomIn">
            <span class="subhead">BEST MEDICAL AND</span>
            <h1 class="display-4">HEALTH CARE CENTER</h1>
          </div>
        </div>
      </div>
    
      <div class="page-section pb-0">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-lg-6 py-3 wow fadeInUp">
              <h1>Welcome to Your Health <br> Center</h1>
              <p class="text-grey mb-4">
                Our 24-hour Heart Centre is the first in the region, with the facility to perform emergency Angioplasty & Cardiac Interventions including bypass surgeries with proven track records of excellent results. 
                On call 24 hours a day, 7 days a week our Accident & Emergency service is by far the best choice in the region for all emergency care services which include ambulance retrieval services with fully qualified & trained paramedics and a medical team.
                <br><br>
                Our 24 hours Stroke Management Unit and neurosurgical facilities including brain and spinal surgeries is headed by the best of medical experts in the region. The Mother & Baby Care Centre fulfils a long-felt need for expectant mothers in Kandy to obtain advice related to pre, post-natal care as well as services related to sub fertility and wide array of fertility procedures.
                <br><br>
                We offer comprehensive and unique care for all types of Kidney diseases with latest modalities of dialysis and Kidney Transplant performed by the finest in the field. Asiri Hospital Kandy employs the latest technology available in the country for its MRI, CT, Ultrasound scanners to provide the most precise findings in routine and special and interventional radiological procedures.
              </p>
              <a href="/about" class="btn btn-primary">Learn More</a>
            </div>
            <div class="col-lg-6 wow fadeInRight" data-wow-delay="400ms">
              <div class="img-place custom-img-1">
                <img src="{{ asset('assets/img/cover.jpg') }}" alt="Welcome Image">
              </div>
            </div>
          </div>
        </div>
      </div>
    
      <div class="page-section">
        <div class="container">
          <h1 class="text-center mb-5 wow fadeInUp">Our Doctors</h1>
          <div class="owl-carousel wow fadeInUp" id="doctorSlideshow">
            <div class="item">
              <div class="card-doctor">
                <div class="header">
                  <img src="{{ asset('assets/img/doctors/doctor_1.jpg') }}" alt="Dr. Jayalath Bandara">
                  <div class="meta">
                    <a href="#"><span class="mai-call"></span></a>
                    <a href="#"><span class="mai-logo-whatsapp"></span></a>
                  </div>
                </div>
                <div class="body">
                  <p class="text-xl mb-0">Dr.Jayalath Bandara</p>
                  <span class="text-sm text-grey">Cardiology</span>
                </div>
              </div>
            </div>
            <div class="item">
              <div class="card-doctor">
                <div class="header">
                  <img src="{{ asset('assets/img/doctors/doctor_2.jpg') }}" alt="Dr. Piumi Ranathunga">
                  <div class="meta">
                    <a href="#"><span class="mai-call"></span></a>
                    <a href="#"><span class="mai-logo-whatsapp"></span></a>
                  </div>
                </div>
                <div class="body">
                  <p class="text-xl mb-0">Dr.Piumi Ranathunga</p>
                  <span class="text-sm text-grey">Dental</span>
                </div>
              </div>
            </div>
            <div class="item">
              <div class="card-doctor">
                <div class="header">
                  <img src="{{ asset('assets/img/doctors/doctor_3.jpg') }}" alt="Dr. Upul Kumara">
                  <div class="meta">
                    <a href="#"><span class="mai-call"></span></a>
                    <a href="#"><span class="mai-logo-whatsapp"></span></a>
                  </div>
                </div>
                <div class="body">
                  <p class="text-xl mb-0">Dr.Upul Kumara</p>
                  <span class="text-sm text-grey">Anesthesiologists</span>
                </div>
              </div>
            </div>
            <div class="item">
              <div class="card-doctor">
                <div class="header">
                  <img src="{{ asset('assets/img/doctors/doctor_4.jpg') }}" alt="Dr. Thanuja Kumari">
                  <div class="meta">
                    <a href="#"><span class="mai-call"></span></a>
                    <a href="#"><span class="mai-logo-whatsapp"></span></a>
                  </div>
                </div>
                <div class="body">
                  <p class="text-xl mb-0">Dr.Thanuja Kumari</p>
                  <span class="text-sm text-grey">Family Physicians</span>
                </div>
              </div>
            </div>
            <div class="item">
              <div class="card-doctor">
                <div class="header">
                  <img src="{{ asset('assets/img/doctors/doctor_5.jpg') }}" alt="Dr. Ranjith Madugalla">
                  <div class="meta">
                    <a href="#"><span class="mai-call"></span></a>
                    <a href="#"><span class="mai-logo-whatsapp"></span></a>
                  </div>
                </div>
                <div class="body">
                  <p class="text-xl mb-0">Dr. Ranjith Madugalla</p>
                  <span class="text-sm text-grey">Cardiologists</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>


      @include('footer')

</body>
</html>