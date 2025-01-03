@extends('doctor.sidemenu')

@section('content')

<div class="container mt-2">

    <div class="bg-success"> 
        <h2 class="p-2">Welcome to the YouHeal -Hospital</h2>
    </div>

    <div class="row mt-4">
        <div class="col-md-4">
            <div class="card text-white bg-dark mb-3">
                <div class="card-body">
                    <h5 class="card-title">My Profile</h5>
                    <p class="card-text"></p>
                    <a href="{{ route('doctor.profile.show') }}" class="btn btn-light">Profile</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-info mb-3">
                <div class="card-body">
                    <h5 class="card-title">My Appointment</h5>
                    <p class="card-text"></p>
                    <a href="{{ route('doctor.appointments') }}" class="btn btn-light">Appointment</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-danger mb-3">
                <div class="card-body">
                    <h5 class="card-title">Patients Details</h5>
                    <p class="card-text"></p>
                    <a href="{{ route('doctor.patients.search') }}" class="btn btn-light">View</a>
                </div>
            </div>
        </div>

    </div>


</div>



<script>
    document.getElementById('dashboardLink').classList.add('active');
</script>

@endsection