@extends('admin.sidemenu')

@section('content')

    <div class="container mt-2">

        <div class="bg-success"> 
            <h2 class="p-2">Add Patient</h2>
        </div>
        <form action="{{ route('admin.patients.store') }}" method="POST">
            @csrf

            <div class="row">
                <div class="mb-1 col-6">
                    <label for="firstname" class="form-label">First Name</label>
                    <input type="text" class="form-control" id="firstname" name="firstname" required>
                </div>
                <div class="mb-1 col-6">
                    <label for="lastname" class="form-label">Last Name</label>
                    <input type="text" class="form-control" id="lastname" name="lastname" required>
                </div>
            </div>

            <div class="row">
                <div class="mb-1 col-4">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="text" class="form-control" id="phone" name="phone" required>
                </div>
                <div class="mb-1 col-4">
                    <label for="birthday" class="form-label">Birthday</label>
                    <input type="date" class="form-control" id="birthday" name="birthday" required>
                </div>
                <div class="mb-1 col-4">
                    <label for="gender" class="form-label">Gender</label>
                    <select class="form-control" id="gender" name="gender" required>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="other">Other</option>
                    </select>
                </div>
            </div>

            <div class="mb-1">
                <label for="address" class="form-label">Address</label>
                <textarea class="form-control" id="address" name="address" required></textarea>
            </div>
            
            <div class="mb-1">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>

            <div class="row">
                <div class="mb-1 col-6">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="mb-3 col-6">
                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                </div>
            </div>
            
            <button type="submit" class="btn btn-primary">Add Patient</button>
        </form>
    </div>

    <script>
        document.getElementById('patientLink').classList.add('active');
        document.getElementById('patientLink1').classList.add('active');

        document.addEventListener('DOMContentLoaded', function() {
            var dropdownMenu = document.getElementById('sidemenu1');
            dropdownMenu.classList.add('show');
            dropdownMenu.classList.add('collapse');
            dropdownMenu.style.display = 'block';
        });
    </script>
    
   
    @endsection
