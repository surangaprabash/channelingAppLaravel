@extends('admin.sidemenu')

@section('content')
<div class="container mt-2">

    <div class="bg-success"> 
        <h2 class="p-2">Notify the doctor </h2>
    </div>
    
    <form action="{{ route('admin.sendEmailToDoctor') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="doctor">Select Doctor</label>
            <select class="form-control" id="doctor" name="doctor_id" required>
                @foreach($doctors as $doctor)
                    <option value="{{ $doctor->id }}">{{ 'Dr. ' . $doctor->first_name . ' ' . $doctor->last_name . ' (' . $doctor->email . ')' }}</option>
                @endforeach
            </select>
        </div>
        <div class="row">
            <div class="form-group col-6">
                <label for="from_time">From Time</label>
                <input type="time" class="form-control" id="from_time" name="from_time" required>
            </div>
            <div class="form-group col-6">
                <label for="to_time">To Time</label>
                <input type="time" class="form-control" id="to_time" name="to_time" required>
            </div>
        </div>
        <div class="form-group">
            <label for="department">Department</label>
            <input type="text" class="form-control" id="department" name="department" required>
        </div>
        <div class="form-group">
            <label for="additional_department">Additional Department (Optional)</label>
            <input type="text" class="form-control" id="additional_department" name="additional_department">
        </div>
        <div class="form-group">
            <label for="message">Additional Message (Optional)</label>
            <textarea class="form-control" id="message" name="message" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Send Email</button>
    </form>
</div>
@endsection
