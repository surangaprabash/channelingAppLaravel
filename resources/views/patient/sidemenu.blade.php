<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ config('app.name', 'Laravel') }}</title>


  <link rel="stylesheet" href="/css/adminhome.css">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

  <script src="https://kit.fontawesome.com/caaacab037.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@3.0.1/dist/css/multi-select-tag.css">
    <script src="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@3.0.1/dist/js/multi-select-tag.js"></script>

  <link rel="stylesheet" type="text/css" href="/css/select2.min.css">

  <style>
    .nav-pills li a:hover{
        background-color: rgb(107, 107, 204);
    }
</style>

</head>

<body>

    @include('doctor.nav')


    <div class="container-fluid">
        <div class="row">
            <div class="d-flex flex-column justify-content-between col-md-2 bg-dark min-vh-100">
                <div class="mt-4">
                    <a href="#" class="text-white text-decoration-none d-flex align-item-center ms-4">
                        <span class="fs-5">Patient</span>
                    </a>
                    <hr class="text-white"/>
                    <ul class="nav nav-pills flex-column mt-2 mt-sm-0" id="menu">

                        <li class="nav-item">
                            <a href="{{ route('dashboard') }}" class="nav-link text-white"  id="dashboardLink">
                                <i class="fa-solid fa-gauge"></i>
                                <span class="ms-2">Dashboard</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('patient.myReport') }}" class="nav-link text-white"  id="myReportLink">
                                <i class="fa-solid fa-circle-info"></i>
                                <span class="ms-2">My Reports</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('patient.appointments.view') }}" class="nav-link text-white"  id="appointmentsLink">
                                <i class="fa-solid fa-calendar-check"></i>
                                <span class="ms-2">Appointment</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('patient.appointments.create') }}" class="nav-link text-white" id="createLink">
                                <i class="fa-solid fa-calendar"></i>
                                <span class="ms-2">Create Appointments</span>
                            </a>
                        </li>
                        

                        <li class="nav-item">
                            <a href="{{ route('patient.profile.show') }}" class="nav-link text-white" id="profileLink">
                                <i class="fa-solid fa-user"></i>
                                <span class="ms-2">Profile</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- content area -->
            <div class="content col-md-10">
                @yield('content') 
            </div>
        </div>
    </div>
</body>

</html>
