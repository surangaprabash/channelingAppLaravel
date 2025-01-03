<x-mail::message>

<body>
    <h1>Appointment Confirmed</h1>
    <p>Your appointment has been confirmed. Below are the details:</p>
    <p>Ticket Number: {{ $appointment->ticket_number }}</p>
    <p>Department: {{ $appointment->department->name }}</p>
    <p>Appointment Date: {{ $appointment->appointment_date }}</p>
    <p>Time: {{ $appointment->time }}</p>
    <p>Doctor: {{ $appointment->doctor->first_name }} {{ $appointment->doctor->last_name }}</p>
    <p>Message: {{ $appointment->message }}</p>
</body>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
