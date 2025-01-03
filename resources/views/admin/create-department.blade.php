@extends('admin.sidemenu')

@section('content')

<div class="container mt-2">

    <div class="bg-success"> 
        <h2 class="p-2">Create Department</h2>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.store-department') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Department Name</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

    <h2 class="mt-5">Manage Departments</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Department Name</th>
                <th>Status</th>
                <th>Created Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($departments as $index => $department)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $department->name }}</td>
                    <td>{{ $department->status }}</td>
                    <td>{{ $department->created_at }}</td>
                    <td>
                        <form method="POST" action="{{ route('admin.update-department-status', $department->id) }}" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-warning">{{ $department->status === 'active' ? 'Deactivate' : 'Activate' }}</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
    document.getElementById('departmentLink').classList.add('active');
</script>


@endsection
