@extends('admin.sidemenu')

@section('content')
<div class="container mt-2">

    <div class="bg-success"> 
        <h2 class="p-2">Appointment Requests</h2>
    </div>
    
    <div class="d-flex justify-content-end mb-3">
        <span class="badge bg-info text-white p-3 fs-5">New Appointments: {{ $newAppointmentCount }}</span>
    </div>
    
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Created At</th>
                <th>User</th>
                <th>Doctor</th>
                <th>Department</th>
                <th>Appointment Date</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($appointments as $index => $appointment)
                <tr>
                    <td>{{ $appointments->firstItem() + $index }}</td>
                    <td>{{ $appointment->created_at->format('Y-m-d') }}<br>{{ $appointment->created_at->format('H:i') }}</td>
                    <td>{{ $appointment->user->user_id }}</td>
                    <td>{{ $appointment->doctor->user_id }}</td>
                    <td>{{ $appointment->department->name }}</td>
                    <td>{{ $appointment->appointment_date }}</td>
                    <td class="align-middle">
                        @switch($appointment->appointment_status)
                            @case(1)
                                <span class="badge bg-success">New</span>
                                @break
                            @case(2)
                                <span class="badge bg-primary">Confirmed</span>
                                @break
                            @case(3)
                                <span class="badge bg-danger">Rejected</span>
                                @break
                            @default
                                <span class="badge bg-secondary">Unknown</span>
                        @endswitch
                    </td>
                    <td class="align-middle">
                        @if ($appointment->appointment_status == 1)

                        <a href="{{ route('appointments.confirmApp', $appointment->id) }}" class="btn btn-primary btn-sm">Confirm</a>

                          
                            <form action="{{ route('appointments.reject', $appointment->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm">Reject</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $appointments->links() }}
</div>

<script>
    document.getElementById('newAppLink').classList.add('active');
</script>

@endsection
