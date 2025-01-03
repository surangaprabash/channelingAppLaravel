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

    @include('admin.nav')


    <div class="container-fluid">
        <div class="row">
            <div class="d-flex flex-column justify-content-between col-md-2 bg-dark min-vh-100">
                <div class="mt-4">
                    <a href="#" class="text-white text-decoration-none d-flex align-item-center ms-4">
                        <span class="fs-5">Admin</span>
                    </a>
                    <hr class="text-white"/>
                    <ul class="nav nav-pills flex-column mt-2 mt-sm-0" id="menu">
                        <li class="nav-item">
                            <a href="{{ route('dashboard') }}" class="nav-link text-white" id="dashboardLink">
                                <i class="fa-solid fa-gauge"></i>
                                <span class="ms-2">Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-item  py-2 py-sm-0 disabled">
                            <a href="#sidemenu1" data-bs-toggle="collapse" class="nav-link text-white" id="patientLink">
                                <i class="fa-solid fa-bed-pulse"></i>
                                <span class="ms-2">Patients</span>
                              <i class="fa fa-caret-down ms-2"></i>
                            </a>
                            <ul class="nav nav-pills collapse flex-column mt-2 mt-sm-0 bg-secondary" id="sidemenu1">
                                <li class="nav-item">
                                    <a href="{{ route('admin.patients.create') }}" class="nav-link text-white" id="patientLink1">
                                        <span class="ms-2">Add Patients</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.patients.index') }}" class="nav-link text-white" id="patientLink2">
                                        <span class="ms-2">Manage Patients</span>
                                    </a>
                                </li>

                            </ul>
                        </li>

                        <li class="nav-item  py-2 py-sm-0 disabled">
                            <a href="#sidemenu2" data-bs-toggle="collapse" class="nav-link text-white" id="doctorLink">
                                <i class="fa-solid fa-user-doctor"></i>
                                <span class="ms-2">Doctors</span>
                              <i class="fa fa-caret-down ms-2"></i>
                            </a>
                            <ul class="nav nav-pills collapse flex-column mt-2 mt-sm-0 bg-secondary" id="sidemenu2">
                                <li class="nav-item">
                                    <a href="{{ route('admin.doctors.create') }}" class="nav-link text-white" id="doctorLink1">
                                        <span class="ms-2">Add Doctor</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.doctors.index') }}" class="nav-link text-white" id="doctorLink2">
                                        <span class="ms-2">Manage Doctor</span>
                                    </a>
                                </li>

                            </ul>
                        </li>

                        {{-- doctor shedule --}}
                        <li class="nav-item">
                            <a href="{{ route('schedules.index') }}" class="nav-link text-white" id="schedulesLink">
                                <i class="fa-solid fa-calendar"></i>
                                <span class="ms-2">Doctor Schedule</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('new.appointments.index') }}" class="nav-link text-white" id="newAppLink">
                                <i class="fa-solid fa-calendar-check"></i>
                                <span class="ms-2">Confirm Appointment</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('appointments.index') }}" class="nav-link text-white" id="appointmentLink">
                                <i class="fa-solid fa-calendar-check"></i>
                                <span class="ms-2">Appointment</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.create-department') }}" class="nav-link text-white" id="departmentLink">
                                <i class="fa-solid fa-building"></i>
                                <span class="ms-2">Department</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.profile.show') }}" class="nav-link text-white" id="profileLink">
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
