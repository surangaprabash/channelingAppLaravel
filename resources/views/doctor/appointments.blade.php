@extends('doctor.sidemenu')

@section('content')
<div class="container">

    <div class="bg-success"> 
        <h2 class="p-2">My Appointments</h2>
    </div>

    <form method="GET" action="{{ route('doctor.appointments') }}">
        <div class="input-group mb-3">
            <input type="text" name="search" class="form-control" placeholder="Search by ticket number or patient name" value="{{ request('search') }}">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="submit">Search</button>
            </div>
        </div>
    </form>

    @if(session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    @if($appointments->isEmpty())
        <p>No appointments available.</p>
    @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Ticket Number</th>
                    <th>Patient Name</th>
                    <th>Department</th>
                    <th>Appointment Date</th>
                    <th>Time</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($appointments as $appointment)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $appointment->ticket_number }}</td>
                        <td>{{ $appointment->patient->first_name }} {{ $appointment->patient->last_name }}</td>
                        <td>{{ $appointment->department->name }}</td>
                        <td>{{ $appointment->appointment_date }}</td>
                        <td>{{ \Carbon\Carbon::createFromFormat('H:i:s', $appointment->time)->format('h:i A') }}</td>
                        <td>
                            @if($appointment->examine == 1)
                                New
                            @elseif($appointment->examine == 2)
                                Examined
                            @elseif($appointment->examine == 3)
                                Absent
                            @endif
                        </td>
                        <td>
                            {{-- <form action="{{ route('doctor.appointments.updateStatus') }}" method="POST" style="display:inline;">
                                @csrf
                                <input type="hidden" name="appointment_id" value="{{ $appointment->id }}">
                                <input type="hidden" name="status" value="2">
                                <button type="submit" class="btn btn-success btn-sm">Examine</button>
                            </form> --}}

                            @if($appointment->examine == 1)
                                <a href="{{ route('doctor.appointments.examine', $appointment->id) }}" class="btn btn-success btn-sm">Examine</a>

                                <form action="{{ route('doctor.appointments.updateStatus') }}" method="POST" style="display:inline;">
                                    @csrf
                                    <input type="hidden" name="appointment_id" value="{{ $appointment->id }}">
                                    <input type="hidden" name="status" value="3">
                                    <button type="submit" class="btn btn-danger btn-sm">Absent</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination links -->
        <div class="d-flex justify-content-center">
            {{ $appointments->links() }}
        </div>
    @endif
</div>

<script>
    document.getElementById('appointmentsLink').classList.add('active');
</script>

@endsection

