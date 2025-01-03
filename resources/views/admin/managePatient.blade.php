@extends('admin.sidemenu')

@section('content')

<div class="container mt-5">
    <h2>Manage Patients</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="d-flex justify-content-end mb-3">
        <form method="GET" action="{{ route('admin.patients.index') }}" class="d-flex">
            <input class="form-control me-2" type="search" name="search" placeholder="Search by ID, name or email" value="{{ $search }}">
            <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
    </div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Patient ID</th>
                <th>Patient Name</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($patients as $index => $patient)
                <tr class="{{ $patient->user_id == $search || $patient->email == $search || $patient->first_name . ' ' . $patient->last_name == $search ? 'highlight' : '' }}">
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $patient->user_id }}</td>
                    <td>{{ $patient->first_name }} {{ $patient->last_name }}</td>
                    <td>{{ $patient->status }}</td>
                    <td>
                        <form method="POST" action="{{ route('admin.patients.updateStatus', $patient->id) }}" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-warning">{{ $patient->status === 'active' ? 'Deactivate' : 'Activate' }}</button>
                        </form>
                        <button type="button" class="btn btn-primary" onclick="editPatient({{ $patient->id }})">Edit</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>


<!-- Edit Patient Modal -->
<div class="modal fade" id="editPatientModal" tabindex="-1" aria-labelledby="editPatientModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="" id="editPatientForm">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="editPatientModalLabel">Edit Patient</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit_firstname" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="edit_firstname" name="firstname" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_lastname" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="edit_lastname" name="lastname" required>
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
                        <label for="edit_birthday" class="form-label">Birthday</label>
                        <input type="date" class="form-control" id="edit_birthday" name="birthday" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_address" class="form-label">Address</label>
                        <textarea class="form-control" id="edit_address" name="address" required></textarea>
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
function editPatient(id) {
    fetch(`/dashboard/patients/${id}/edit`)
        .then(response => response.json())
        .then(data => {
            document.getElementById('edit_firstname').value = data.first_name;
            document.getElementById('edit_lastname').value = data.last_name;
            document.getElementById('edit_email').value = data.email;
            document.getElementById('edit_phone').value = data.telephone;
            document.getElementById('edit_gender').value = data.gender;
            document.getElementById('edit_birthday').value = data.birth_day;
            document.getElementById('edit_address').value = data.address;
            document.getElementById('edit_status').value = data.status;
            document.getElementById('editPatientForm').setAttribute('action', `/dashboard/patients/${id}/update`);
            var editPatientModal = new bootstrap.Modal(document.getElementById('editPatientModal'));
            editPatientModal.show();
        })
        .catch(error => console.error('Error fetching patient details:', error));
}
</script>

<script>
    document.getElementById('patientLink').classList.add('active');
    document.getElementById('patientLink2').classList.add('active');

    document.addEventListener('DOMContentLoaded', function() {
        var dropdownMenu = document.getElementById('sidemenu1');
        dropdownMenu.classList.add('show');
        dropdownMenu.classList.add('collapse');
        dropdownMenu.style.display = 'block';
    });
</script>

@endsection
