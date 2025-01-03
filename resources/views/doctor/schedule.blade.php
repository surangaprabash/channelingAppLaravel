@extends('doctor.sidemenu')

@section('content')

<div class="container mt-2">

    <div class="bg-success"> 
        <h2 class="p-2">My Schedule</h2>
    </div>

    @if($schedules->isEmpty())
        <p>No schedules available.</p>
    @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Available Days</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($schedules as $schedule)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $schedule->available_days }}</td>
                        <td>{{ \Carbon\Carbon::createFromFormat('H:i:s', $schedule->start_time)->format('h:i A') }}</td>
                        <td>{{ \Carbon\Carbon::createFromFormat('H:i:s', $schedule->end_time)->format('h:i A') }}</td>
                        <td class="text-center">
                            <!-- Button to view message -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#messageModal{{ $schedule->id }}">
                                View Message
                            </button>

                            <div class="modal fade" id="messageModal{{ $schedule->id }}" tabindex="-1" aria-labelledby="messageModalLabel{{ $schedule->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="messageModalLabel{{ $schedule->id }}">Message</h5>
                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        {{ $schedule->message }}
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                  </div>
                                </div>
                              </div>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>

<script>
    document.getElementById('scheduleLink').classList.add('active');
</script>


@endsection
