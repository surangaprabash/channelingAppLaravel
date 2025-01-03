@extends('patient.sidemenu')

@section('content')

<div class="container mt-2">

    <div class="bg-success"> 
        <h2 class="p-2">My Medical Reports</h2>
    </div>


    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Ticket Number</th>
                <th>Doctor</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reports as $index => $report)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $report->ticket_number }}</td>
                    <td>Dr. {{ $report->doctor_first_name }} {{ $report->doctor_last_name }}</td>
                    <td>{{ $report->created_at->format('Y-m-d') }}</td>
                    <td>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#reportModal-{{ $report->id }}">View</button>
                    </td>
                </tr>

                <!-- Modal -->
                <div class="modal fade" id="reportModal-{{ $report->id }}" tabindex="-1" aria-labelledby="reportModalLabel-{{ $report->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h1 class="modal-title fs-5" id="reportModalLabel-{{ $report->id }}">Report Details</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                                <p><strong>Ticket Number:</strong> {{ $report->ticket_number }}</p>
                                <p><strong>Date:</strong> {{ $report->created_at->format('Y-m-d') }}</p>
                                <p><strong>Patient Name:</strong> {{ $report->patient_first_name }} {{ $report->patient_last_name }}</p>
                                <p><strong>Examining Doctor:</strong> Dr. {{ $report->doctor_first_name }} {{ $report->doctor_last_name }}</p>
                                <p><strong>Medicine Advice:</strong> {{ $report->medicine_advice }}</p>
                                <p><strong>Health Description:</strong> {{ $report->health_description }}</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                    </div>
                </div>

            @endforeach
        </tbody>
    </table>
</div>

<script>
    document.getElementById('myReportLink').classList.add('active');
</script>

@endsection
