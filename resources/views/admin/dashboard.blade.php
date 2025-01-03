@extends('admin.sidemenu')

@section('content')

<h1 class="mt-2">Welcome to the Admin Panel</h1>

<div class="row mt-4">
    <div class="col-md-4">
        <div class="card text-white bg-primary mb-3">
            <div class="card-body">
                <h5 class="card-title">Total Patients</h5>
                <p class="card-text">{{ $totalPatients }}</p>
                <a href="{{ route('admin.patients.index') }}" class="btn btn-light">Manage Patients</a>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-white bg-success mb-3">
            <div class="card-body">
                <h5 class="card-title">Total Doctors</h5>
                <p class="card-text">{{ $totalDoctors }}</p>
                <a href="{{ route('admin.doctors.index') }}" class="btn btn-light">Manage Doctors</a>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-white bg-secondary mb-3">
            <div class="card-body">
                <h5 class="card-title">Total Departments</h5>
                <p class="card-text">{{ $totalDepartments }}</p>
                <a href="{{ route('admin.create-department') }}" class="btn btn-light">Manage Departments</a>
            </div>
        </div>
    </div>
</div>


<script>
    document.getElementById('dashboardLink').classList.add('active');
</script>


@endsection
