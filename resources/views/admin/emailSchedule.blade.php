<!DOCTYPE html>
<html>
<head>
    <title>Your Schedule</title>
</head>
<body>
    <p>Hello {{ $details['doctor_name'] }},</p>
    <p>Patient check-up hours today:</p>
    <p>
        Date: {{ \Carbon\Carbon::now()->toDateString() }}<br>
        Time: From {{ \Carbon\Carbon::parse($details['from_time'])->format('h:i A') }} to {{ \Carbon\Carbon::parse($details['to_time'])->format('h:i A') }}<br>
        Department: {{ $details['department'] }}
    </p>
    @if (!empty($details['additional_department']))
        <p>
            Department: {{ $details['additional_department'] }}
        </p>
    @endif
    @if (!empty($details['additional_message']))
        <p>
            {!! nl2br(e($details['additional_message'])) !!}
        </p>
    @endif
    <p>Thank you,</p>
    <p>{{ config('app.name') }}</p>
</body>
</html>
