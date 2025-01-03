@extends('doctor.sidemenu')

@section('content')
<div class="container">

    <div class="bg-success"> 
        <h2 class="p-2">Examination of the patient</h2>
    </div>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Patient Details</h5>
            <p><strong>Ticket Number:</strong> {{ $appointment->ticket_number }}</p>
            <p><strong>Patient Name:</strong> {{ $patient->first_name }} {{ $patient->last_name }}</p>
            <p><strong>Age:</strong> {{ \Carbon\Carbon::parse($patient->birth_day)->age }} years</p>
            <p><strong>Address:</strong> {{ $patient->address }}</p>
            <p><strong>Phone:</strong> {{ $patient->telephone }}</p>
            <p><strong>Email:</strong> {{ $patient->email }}</p>
            <p><strong>Examine Doctor:</strong> Dr. {{ $doctor->first_name }} {{ $doctor->last_name }}</p>
        </div>
    </div>

    <form method="POST" action="{{ route('doctor.appointments.saveExamineData', $appointment) }}" class="mt-4">
        @csrf
        <div class="form-group">
            <label for="health_description">Health Description</label>
            <textarea class="form-control" id="health_description" name="health_description" rows="3" required></textarea>
        </div>
        <div class="form-group">
            <label for="medicine_advice">Medicine/Health Advice</label>
            <textarea class="form-control" id="medicine_advice" name="medicine_advice" rows="3" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary mt-2 mb-4">Save</button>
    </form>
</div>
@endsection
