@extends('patient.sidemenu')

@section('content')

<div class="container mt-2">

    <div class="bg-success"> 
        <h2 class="p-2">Create New Appointment</h2>
    </div>

    <form action="{{ route('appointments.store') }}" method="POST">
        @csrf
        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
    
        <div class="mb-3">
            <label for="department" class="form-label">Department</label>
            <select name="department_id" id="department" class="form-control" required>
                <option value="" disabled selected>Select Department</option>
                @foreach($departments as $department)
                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                @endforeach
            </select>
        </div>
    
        <div class="mb-3">
            <label for="doctor" class="form-label">Doctor</label>
            <select name="doctor_id" id="doctor" class="form-control" required>
                <option value="" disabled selected>Select Doctor</option>
                @foreach($doctors as $doctor)
                    <option value="{{ $doctor->id }}">Dr. {{ $doctor->first_name }} {{ $doctor->last_name }}</option>
                @endforeach
            </select>
        </div>
    
        <div class="mb-3">
            <label for="appointment_date" class="form-label">Appointment Date</label>
            {{-- <input type="date" name="appointment_date" id="appointment_date" class="form-control" required> --}}
            <input type="date" name="appointment_date" id="appointment_date" class="form-control" required min="{{ date('Y-m-d', strtotime('+5 day')) }}">
       
        </div>
    
        <div class="mb-3">
            <label for="message" class="form-label">Message</label>
            <textarea name="message" id="message" class="form-control" rows="3"></textarea>
        </div>
    
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

</div>

<script>
    document.getElementById('createLink').classList.add('active');
</script>

@endsection