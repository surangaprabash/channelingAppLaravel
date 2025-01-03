@extends('admin.sidemenu')

@section('content')
<div class="container mt-2">

    <div class="bg-success"> 
        <h2 class="p-2">Manage Appointments</h2>
    </div>

    <!-- Search Bar -->
    <form action="{{ route('appointments.search') }}" method="GET" class="mb-4">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Search by ticket number, user name, or user ID">
            <button type="submit" class="btn btn-primary">Search</button>
        </div>
    </form>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif


    <!-- Appointments Table -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>User ID</th>
                <th>Doctor ID</th>
                <th>Appointment Date</th>
                <th>Time</th>
                <th>Examine</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($appointments as $index => $appointment)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $appointment->user->user_id }}</td>
                <td>{{ $appointment->doctor->user_id  }}</td>
                <td>{{ $appointment->appointment_date }}</td>
                <td>{{ $appointment->time }}</td>
                <td>
                    @if ($appointment->examine == 1)
                        <span class="badge bg-primary p-2">Pending</span>
                    @elseif ($appointment->examine == 2)
                        <span class="badge bg-success p-2">Presented</span>
                    @elseif ($appointment->examine == 3)
                        <span class="badge bg-danger p-2">Not Present</span>
                    @endif
                </td>
                <td>
                    @if (!($appointment->examine == 2))
                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $appointment->id }}">Edit <i class="fa-solid fa-edit"></i></button>
                    @endif
                    <!-- Add more actions as needed -->

                    <!-- Edit Modal -->
                    <div class="modal fade" id="editModal{{ $appointment->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $appointment->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editModalLabel{{ $appointment->id }}">Edit Appointment</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="{{ route('appointments.update', $appointment->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="user_id" class="form-label">Patient Name</label>
                                            <input type="text" class="form-control" id="user_id" name="user_id" value="{{ $appointment->user->first_name }} {{ $appointment->user->last_name }}" readonly>
                                        </div>
                                        <div class="mb-3">
                                            <label for="doctor_id" class="form-label">Doctor</label>
                                            <select class="form-select" id="doctor_id" name="doctor_id">
                                                @foreach ($doctors as $doctor)
                                                    <option value="{{ $doctor->id }}" @if($doctor->user_id == $appointment->doctor->user_id) selected @endif>
                                                        Dr. {{ $doctor->first_name }} {{ $doctor->last_name }}
                                                    </option>
                                                @endforeach
                                                
                                            </select>
                                            
                                        </div>
                                        <div class="mb-3">
                                            <label for="appointment_date" class="form-label">Appointment Date</label>
                                            <input type="date" class="form-control" id="appointment_date" name="appointment_date" value="{{ $appointment->appointment_date }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="time" class="form-label">Time</label>
                                            <input type="time" class="form-control" id="time" name="time" value="{{ $appointment->time }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="examine" class="form-label">Examine</label>
                                            <select class="form-select" id="examine" name="examine">
                                                <option value="1" @if($appointment->examine == 1) selected @endif>Pending</option>
                                                <option value="3" @if($appointment->examine == 3) selected @endif>Not Present</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
    document.getElementById('appointmentLink').classList.add('active');
</script>


@endsection
