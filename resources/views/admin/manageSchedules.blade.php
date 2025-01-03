@extends('admin.sidemenu')

@section('content')
<div class="page-wrapper">
    <div class="content">
        <div class="row">
            <div class="bg-success"> 
                <h2 class="p-2">Manage Schedules</h2>
            </div>
        </div>
        <div class="text-end">
            <a href="{{ route('showSendEmailForm') }}" class="btn btn-sm btn-primary m-2">Inform the Doctor <i class="fa-fa-email"></i></a>
            <a href="{{ route('schedules.create') }}" class="btn btn-sm btn-danger m-2">Create Schedules <i class="fa-solid fa-edit"></i></a>
        </div>

        <div class="row">
            <div class="col-lg-12 mt-3">
                @if(session('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Doctor Name</th>
                                <th>Department</th>
                                <th>Available Days</th>
                                <th>From</th>
                                <th>To</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($schedules as $schedule)
                            <tr>
                                <td>{{ $schedule->id }}</td>
                                <td>Dr. {{ $schedule->doctor->first_name }} {{ $schedule->doctor->last_name }}</td> 
                                <td>{{ $schedule->department->name }}</td> 
                                <td>{{ $schedule->available_days }}</td>
                                <td>{{ \Carbon\Carbon::parse($schedule->start_time)->format('h:i A') }}</td>
                                <td>{{ \Carbon\Carbon::parse($schedule->end_time)->format('h:i A') }}</td>
                                <td>
                                    @if($schedule->status == 1)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-danger">Inactive</span>
                                    @endif
                                </td>
                                <td>

                                    <form method="POST" action="{{ route('admin.update-schedule-status', $schedule->id) }}" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-sm {{ $schedule->status == '1' ? 'btn-warning' : 'btn-success' }}">
                                            {{ $schedule->status == '1' ? 'Deactivate' : 'Activate' }}
                                        </button>
                                    </form>

                                    {{-- @if(!($schedule->status == 1))
                                        <button class="btn btn-sm btn-primary" onclick="editSchedule({{ $schedule->id }}) ">Edit</button>
                                    @endif --}}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    document.getElementById('schedulesLink').classList.add('active');
</script>


@endsection
