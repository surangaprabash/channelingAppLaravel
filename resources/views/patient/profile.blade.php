@extends('patient.sidemenu')

@section('content')

    <div class="bg-primary">
        <h2 class="p-3">Patient Profile</h2>
        
    </div>

    <span class="bg-secondary text-white p-1 ">Patient ID : {{ $user->user_id }}</span>


    <form class="row g-3 mt-1" action="{{ route('profile.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group col-md-6">
            <label for="first_name">First Name</label>
            <input type="text" class="form-control" id="first_name" name="first_name" value="{{ $user->first_name }}" required>
        </div>

        <div class="form-group col-md-6">
            <label for="last_name">Last Name</label>
            <input type="text" class="form-control" id="last_name" name="last_name" value="{{ $user->last_name }}" required>
        </div>

        <div class="form-group col-md-4  mt-1">
            <label for="birth_day">Birth Day</label>
            <input type="date" class="form-control" id="birth_day" name="birth_day" value="{{ $user->birth_day }}" required>
        </div>

        <div class="form-group col-md-4  mt-1">
            <label for="gender">Gender</label>
            <select class="form-control" id="gender" name="gender" required>
                <option value="male" {{ $user->gender == 'male' ? 'selected' : '' }}>Male</option>
                <option value="female" {{ $user->gender == 'female' ? 'selected' : '' }}>Female</option>
                <option value="other" {{ $user->gender == 'other' ? 'selected' : '' }}>Other</option>
            </select>
        </div>

        <div class="form-group col-md-4  mt-1">
            <label for="telephone">Telephone</label>
            <input type="text" class="form-control" id="telephone" name="telephone" value="{{ $user->telephone }}" required>
        </div>

        <div class="form-group col-12  mt-1">
            <label for="address">Address</label>
            <input type="text" class="form-control" id="address" name="address" value="{{ $user->address }}" required>
        </div>

        <div class="form-group col-12  mt-1">
            <label for="email">Email (Not Editable)</label>
            <input type="email" class="form-control" id="email" value="{{ $user->email }}" disabled>
        </div>

        <div class="form-group col-12  mt-1">
            <button type="submit" class="btn btn-secondary mt-1 ">Update</button>
            <!-- Change Password Button -->
            <button type="button" class="btn btn-dark mt-1" data-bs-toggle="modal" data-bs-target="#passwordChange">
                Change Password
            </button>
        </div>
    </form>


<!-- Change Password Modal -->
<div class="modal fade" id="passwordChange" tabindex="-1" aria-labelledby="passwordChangeLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="passwordChangeLabel">Change Password</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <form action="{{ route('profile.change-password') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="modal-body">
                <div class="form-group">
                    <label for="current_password">Current Password</label>
                    <input type="password" class="form-control" id="current_password" name="current_password" required>
                </div>
                <div class="form-group">
                    <label for="new_password">New Password</label>
                    <input type="password" class="form-control" id="new_password" name="new_password" required>
                </div>
                <div class="form-group">
                    <label for="new_password_confirmation">Confirm New Password</label>
                    <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-secondary">Change Password</button>
            </div>
        </form>
      </div>
    </div>
  </div>


<script>
    document.getElementById('profileLink').classList.add('active');
</script>

@endsection