@extends('admin.sidemenu')

@section('content')

<div class="container mt-2 p-3 rounded" style="background-color: rgb(155, 155, 146);">

    <div style="background-color: rgb(78, 10, 127);"> 
        <h2 class="p-2 text-white">Add Doctor</h2>
    </div>

    <form method="POST" action="{{ route('admin.doctors.store') }}">
        @csrf
        <div class="row">
            <div class="mb-1 col-4">
                <label for="first_name" class="form-label">First Name</label>
                <input type="text" class="form-control" id="first_name" name="first_name" required>
            </div>
            <div class="mb-1 col-4">
                <label for="last_name" class="form-label">Last Name</label>
                <input type="text" class="form-control" id="last_name" name="last_name" required>
            </div>

            <div class="mb-1 col-4">
                <label for="short_biography" class="form-label">Short Biography</label>
                <input class="form-control" id="short_biography" name="short_biography" required placeholder="MBBS">
            </div>
        </div>

        <div class="row">
            <div class="mb-1 col-4">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" class="form-control" id="phone" name="phone" required>
            </div>
            <div class="mb-1 col-4">
                <label for="gender" class="form-label">Gender</label>
                <select class="form-control" id="gender" name="gender" required>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                </select>
            </div>
            <div class="mb-3 col-4">
                <label for="status" class="form-label">Status</label>
                <select class="form-control" id="status" name="status" required>
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
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

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
    
        <button type="submit" class="btn btn-primary">Add Doctor</button>

    </form>
</div>


<script>
    document.getElementById('doctorLink').classList.add('active');
    document.getElementById('doctorLink1').classList.add('active');

    document.addEventListener('DOMContentLoaded', function() {
        var dropdownMenu = document.getElementById('sidemenu2');
        dropdownMenu.classList.add('show');
        dropdownMenu.classList.add('collapse');
        dropdownMenu.style.display = 'block';
    });
</script>

@endsection
