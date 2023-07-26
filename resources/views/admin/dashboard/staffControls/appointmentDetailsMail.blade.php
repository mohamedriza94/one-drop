<!DOCTYPE html>
<html>
<head>
    <title>Appointment Details</title>
</head>
<body>
    
    <h1 style="color:red">LIFE SAVER</h1>
    <hr><br>
    <h3>Appointment Details</h3><br>
    <p>Your have been scheduled for a Medical Appointment following your request to become a Donor at Life Saver. 
        Below are your Appointment Details. Please be present on time at the given venue.</p><br><br>

    <p><b>Appointment No.: </b>{{ $appointmentMailNo }}</p>
    <p><b>Appointment Date: </b>{{ $appointmentMailDate }}</p>
    <p><b>Appointment Time: </b>{{ $appointmentMailTime }}</p>
    <p><b>Appointment Venue: </b>{{ $appointmentMailVenue }}</p><br>
    <p>--------------------------------------------------</p>
</body>
</html> 