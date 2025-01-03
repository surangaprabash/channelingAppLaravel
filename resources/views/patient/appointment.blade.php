@extends('patient.sidemenu')

@section('content')

<div class="container mt-2">

    <div class="bg-success"> 
        <h2 class="p-2">Your Appointments</h2>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif


    @if ($appointments->isEmpty())
        <p>You have no appointments.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Department</th>
                    <th>Created At</th>
                    <th>Status</th>
                    <th>Appointment Date</th>
                    <th>More</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($appointments as $index => $appointment)
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td>{{ $appointment->department->name }}</td>
                        <td>{{ $appointment->created_at->format('Y-m-d') }}</td>
                        <td class="text-center">

                            @if ($appointment->examine == 2)
                            
                                <span class="p-1 rounded bg-success  text-white">Examined</span>

                            @elseif ($appointment->examine == 3)
                            
                                <span class="p-1 rounded bg-danger  text-white">Absent</span>

                            @else
                                <span class="p-1 rounded {{ $appointment->appointment_status == 1 ? 'bg-success' : ($appointment->appointment_status == 2 ? 'bg-primary' : ($appointment->appointment_status == 3 ? 'bg-danger' : 'bg-secondary')) }} text-white">
                                    {{ $appointment->status_label }}
                                </span>
                            @endif

                        </td>
                        <td>{{ $appointment->appointment_date }}</td>
                        <td class="text-center">
                            @if ($appointment->appointment_status == 2 && $appointment->examine == 1)
                                <button class="btn btn-info view-appointment" data-bs-toggle="modal" data-bs-target="#viewappointmentdata" data-appointment="{{ json_encode($appointment) }}">View</button>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>

<!-- Modal -->
<div class="modal fade" id="viewappointmentdata" tabindex="-1" aria-labelledby="viewappointmentdataLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="viewappointmentdataLabel">Appointment Details</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Ticket Number:</strong> <span id="ticket-number"></span></p>
                <p><strong>Department:</strong> <span id="department"></span></p>
                <p><strong>Appointment Date:</strong> <span id="appointment-date"></span></p>
                <p><strong>Time:</strong> <span id="appointment-time"></span></p>
                <p><strong>Doctor:</strong> <span id="doctor"></span></p>
                <p><strong>Message:</strong> <span id="appointment-message"></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="printAppointment()">Print</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.view-appointment').forEach(button => {
            button.addEventListener('click', function() {
                const appointment = JSON.parse(this.getAttribute('data-appointment'));
                
                document.getElementById('ticket-number').textContent = appointment.ticket_number;
                document.getElementById('department').textContent = appointment.department.name;
                document.getElementById('appointment-date').textContent = appointment.fixed_date;
                document.getElementById('appointment-time').textContent = appointment.time;
                document.getElementById('doctor').textContent = "Dr. "+appointment.doctor.first_name+" "+appointment.doctor.last_name;
                document.getElementById('appointment-message').textContent = appointment.message;
            });
        });
    });

    function printAppointment() {
        const printContent = document.querySelector('#viewappointmentdata .modal-body').innerHTML;
        const originalContent = document.body.innerHTML;
        document.body.innerHTML = printContent;
        window.print();
        document.body.innerHTML = originalContent;
        window.location.reload(); // Reload the page to reset the content
    }
</script>


<script>
    document.getElementById('appointmentsLink').classList.add('active');
</script>

@endsection
