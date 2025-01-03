@extends('doctor.sidemenu')

@section('content')
<div class="container mt-2">

    <div class="bg-success"> 
        <h2 class="p-2">Search Previous Patient Data</h2>
    </div>


    <form method="GET" action="{{ route('doctor.patients.search') }}" class="mb-3">
        <div class="input-group">
            <input type="text" class="form-control" name="search" placeholder="Search by Email, Ticket Number, or Phone" value="{{ request()->input('search') }}">
            <button class="btn btn-outline-success" type="submit">Search</button>
        </div>
    </form>

    @if($examineData->count())
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Ticket Number</th>
                    <th>Patient Name</th>
                    <th>Treat Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($examineData as $index => $data)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $data->appointment->ticket_number }}</td>
                        <td>{{ $data->patient->first_name }} {{ $data->patient->last_name }}</td>
                        <td>{{ $data->created_at->format('Y-m-d') }}</td>
                        <td>
                            <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-id="{{ $data->id }}" data-bs-target="#detailsModal">View</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        
        {{ $examineData->links() }}
    @else
        <p>No patient data found.</p>
    @endif
</div>

<!-- Patient Details Modal -->
<div class="modal fade" id="detailsModal" tabindex="-1" aria-labelledby="detailsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailsModalLabel">Patient Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Patient details will be loaded here via AJAX -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('#detailsModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var id = button.data('id');
        
        $.ajax({
            url: '{{ route('doctor.patients.show', '') }}/' + id,
            method: 'GET',
            success: function(data) {
                var patientDetails = `
                    <p><strong>Ticket Number:</strong> ${data.appointment.ticket_number}</p>
                    <p><strong>Patient Name:</strong> ${data.patient.first_name} ${data.patient.last_name}</p>
                    <p><strong>Age:</strong> ${Math.floor((new Date() - new Date(data.patient.birth_day)) / (365.25 * 24 * 60 * 60 * 1000))} years</p>
                    <p><strong>Address:</strong> ${data.patient.address}</p>
                    <p><strong>Gender:</strong> ${data.patient.gender}</p>
                    <p><strong>Email:</strong> ${data.patient.email}</p>
                    <p><strong>Telephone:</strong> ${data.patient.telephone}</p>
                    <p><strong>Examine Doctor:</strong> ${data.doctor.first_name} ${data.doctor.last_name}</p>
                    <p><strong>Issued Medicine:</strong> ${data.medicine_advice}</p>
                    <p><strong>Health Description:</strong> ${data.health_description}</p>
                    <p><strong>Date:</strong> ${new Date(data.created_at).toLocaleDateString()}</p>
                `;
                $('#detailsModal .modal-body').html(patientDetails);
            },
            error: function(xhr, status, error) {
                console.error('Error fetching patient details:', error);
                $('#detailsModal .modal-body').html('<p>An error occurred while fetching patient details.</p>');
            }
        });
    });
});
</script>


<script>
    document.getElementById('patientsLink').classList.add('active');
</script>

@endsection
