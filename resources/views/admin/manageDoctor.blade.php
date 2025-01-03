@extends('admin.sidemenu')

@section('content')

<div class="container mt-5">
    <h2>Manage Doctors</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="d-flex justify-content-end mb-3">
        <form method="GET" action="{{ route('admin.doctors.index') }}" class="d-flex">
            <input class="form-control me-2" type="search" name="search" placeholder="Search by ID, name or email" value="{{ request()->input('search') }}">
            <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
    </div>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>#</th>
            <th>Doctor ID</th>
            <th>Doctor Name</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($doctors as $index => $doctor)
            <tr class="{{ $doctor->doctor_id == request()->input('search') || $doctor->email == request()->input('search') || $doctor->first_name . ' ' . $doctor->last_name == request()->input('search') ? 'highlight' : '' }}">
                <td>{{ $index + 1 }}</td>
                <td>{{ $doctor->user_id }}</td>
                <td>{{ $doctor->first_name }} {{ $doctor->last_name }}</td>
                <td>{{ $doctor->status }}</td>
                <td>
                    <form method="POST" action="{{ route('admin.doctors.updateStatus', $doctor->id) }}" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-warning">{{ $doctor->status === 'active' ? 'Deactivate' : 'Activate' }}</button>
                    </form>
                    <button type="button" class="btn btn-primary" onclick="editDoctor({{ $doctor->id }})">Edit</button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

<!-- Edit Doctor Modal -->
<div class="modal fade" id="editDoctorModal" tabindex="-1" aria-labelledby="editDoctorModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="" id="editDoctorForm">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="editDoctorModalLabel">Edit Doctor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit_first_name" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="edit_first_name" name="first_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_last_name" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="edit_last_name" name="last_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="edit_email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_phone" class="form-label">Phone</label>
                        <input type="text" class="form-control" id="edit_phone" name="phone" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_gender" class="form-label">Gender</label>
                        <select class="form-control" id="edit_gender" name="gender" required>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="edit_address" class="form-label">Address</label>
                        <textarea class="form-control" id="edit_address" name="address" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="edit_short_biography" class="form-label">Short Biography</label>
                        <textarea class="form-control" id="edit_short_biography" name="short_biography" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="edit_status" class="form-label">Status</label>
                        <select class="form-control" id="edit_status" name="status" required>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
function editDoctor(id) {
    fetch(`/dashboard/doctors/${id}/edit`)
        .then(response => response.json())
        .then(data => {
            document.getElementById('edit_first_name').value = data.first_name;
            document.getElementById('edit_last_name').value = data.last_name;
            document.getElementById('edit_email').value = data.email;
            document.getElementById('edit_phone').value = data.telephone;
            document.getElementById('edit_gender').value = data.gender;
            document.getElementById('edit_address').value = data.address;
            document.getElementById('edit_short_biography').value = data.short_biography;
            document.getElementById('edit_status').value = data.status;
            document.getElementById('editDoctorForm').setAttribute('action', `/dashboard/doctors/${id}/update`);
            var editDoctorModal = new bootstrap.Modal(document.getElementById('editDoctorModal'));
            editDoctorModal.show();
        })
        .catch(error => console.error('Error fetching doctor details:', error));
}
</script>

<script>
    document.getElementById('doctorLink').classList.add('active');
    document.getElementById('doctorLink2').classList.add('active');

    document.addEventListener('DOMContentLoaded', function() {
        var dropdownMenu = document.getElementById('sidemenu2');
        dropdownMenu.classList.add('show');
        dropdownMenu.classList.add('collapse');
        dropdownMenu.style.display = 'block';
    });
</script>

@endsection