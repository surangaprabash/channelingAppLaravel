@extends('patient.sidemenu')
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
                    <a href="{{ route('patient.profile.show') }}" class="btn btn-light">Profile</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-info mb-3">
                <div class="card-body">
                    <h5 class="card-title">My Appointment</h5>
                    <p class="card-text"></p>
                    <a href="{{ route('patient.appointments.view') }}" class="btn btn-light">Appointment</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-danger mb-3">
                <div class="card-body">
                    <h5 class="card-title">My Reports</h5>
                    <p class="card-text"></p>
                    <a href="{{ route('patient.myReport') }}" class="btn btn-light">View</a>
                </div>
            </div>
        </div>

       
            <div class="col-md-12 mb-3">
                <div class="card text-white bg-secondary">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title">Doctor Available Days</h5>
                            <a href="{{ route('patient.appointments.create') }}" class="btn btn-success">Book an appointment</a>
                        </div>
                    </div>
                    <div class="card-body">
                        
                        <table class="table table-bordered text-white">
                            <tr>
                                <th>Department</th>
                                <th>Doctor</th>
                                <th>Available Days</th>
                                <th>From</th>
                                <th>To</th>
                            </tr>
                            @foreach($schedules as $schedule)
                            <tr>
                                <td>{{ $schedule->department->name }}</td> 
                                <td>Dr. {{ $schedule->doctor->first_name }} {{ $schedule->doctor->last_name }}</td> 
                                <td>{{ $schedule->available_days }}</td>
                                <th style="background-color: {{ \Carbon\Carbon::createFromFormat('H:i:s', $schedule->start_time)->format('A') == 'AM' ? '#d3f8d3' : '#f8d3d3' }};">
                                    {{ \Carbon\Carbon::parse($schedule->start_time)->format('h:i A') }}
                                </th>
                                <th style="background-color: {{ \Carbon\Carbon::createFromFormat('H:i:s', $schedule->end_time)->format('A') == 'AM' ? '#d3f8d3' : '#f8d3d3' }};">
                                    {{ \Carbon\Carbon::parse($schedule->end_time)->format('h:i A') }}
                                </th>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>

    </div>


</div>

<script>
    document.getElementById('dashboardLink').classList.add('active');
</script>
@endsection
