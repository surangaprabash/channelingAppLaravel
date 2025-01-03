@extends('admin.sidemenu')

@section('content')
<div class="container mt-2">

    <div class="bg-success"> 
        <h2 class="p-2">Confirm Appointment</h2>
    </div>

    <div class="text-end">
        <span class="bg-secondary ps-3 pe-3 text-white rounded">Created At {{ $appointment->created_at }}</span>
    </div>

    <form action="{{ route('appointments.confirm', $appointment->id) }}" method="POST">
        @csrf

        <input type="hidden" name="appointment_id" value="{{ $appointment->id }}">

        <div class="row">
            <div class="mb-3 col-6">
                <label for="ticket_number" class="form-label">Ticket Number</label>
                <input type="text" id="ticket_number" name="ticket_number" value="{{ $ticketId }}" class="form-control" readonly>
            </div>
    
            <div class="mb-3 col-6">
                <label for="department" class="form-label">Department</label>
                <input type="text" id="department" class="form-control" value="{{ $appointment->department->name }}" readonly>
            </div>
        </div>

    
        <div class="mb-3">
            <label for="emp_id" class="form-label">Patient ID</label>
            <input type="text" id="emp_id" class="form-control" value="{{ $appointment->user->user_id }}" readonly>
        </div>

        <div class="row">

            <div class="mb-3 col-6">
                <label for="appointment_date" class="form-label">Appointment Date</label>
                <input type="date" id="appointment_date" name="appointment_date" class="form-control" value="{{ $appointment->appointment_date }}" required>
            </div>
    
            <div class="mb-3 col-6">
                <label for="time" class="form-label">Appointment Time</label>
                <input type="time" class="form-control" name="time" required>
                {{-- <select name="time" id="time" class="form-control" required>
                    <option value="09:00" {{ $appointment->time == '09:00' ? 'selected' : '' }}>09:00 AM</option>
                    <option value="10:00" {{ $appointment->time == '10:00' ? 'selected' : '' }}>10:00 AM</option>
                    <!-- Add more options as needed -->
                </select> --}}
            </div>

        </div>

        <div class="mb-3">
            <label for="doctor_id" class="form-label">Doctor (change if not available)</label>
            <select name="doctor_id" id="doctor_id" class="form-control" required>
                @foreach($doctors as $doctor)
                    <option value="{{ $doctor->id }}" {{ $doctor->id == $appointment->doctor_id ? 'selected' : '' }}>
                        {{ $doctor->first_name }} {{ $doctor->last_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="message" class="form-label">Message</label>
            <textarea name="message" id="message" class="form-control" rows="3">{{ $appointment->message }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Confirm</button>
    </form>
</div>
@endsection
