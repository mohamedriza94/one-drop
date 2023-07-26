<!DOCTYPE html>
<html>
<head>
    <title>BLOOD RECEIVAL RECEIPT</title>
</head>
<body>
    <div style="background: #f6f8ff; border:solid; border-radius:10px; padding:50px; border-color:rgb(26, 141, 235);">

        <h2 style="color:rgb(255, 0, 0)">LIFE SAVER - BLOOD RECEIVAL RECEIPT</h2>

        <hr style="border-radius:10px; border-color:rgb(250, 132, 132)"><br>

        <p><b>Request No. :</b> &nbsp; {{ $invrequestNo }}</p>
        <p><b>Date :</b> &nbsp; {{ $invdate }}</p>
        <p><b>Time :</b> &nbsp; {{ $invtime }}</p>
        
        <span>----------------------------------------------------------------------------------------------------------------</span>
        
        <h4 style="color:rgb(26, 141, 235)"><u>PATIENT DETAILS</u></h4>

        <p><b>Name :</b> &nbsp; {{ $invfullname }}</p>
        <p><b>NIC No. :</b> &nbsp; {{ $invnic }} </p>
        <p><b>Email :</b> &nbsp; {{ $invemail }}</p>
        <p><b>Telephone :</b> &nbsp; {{ $invtelephone }}</p>

        <span>----------------------------------------------------------------------------------------------------------------</span>
        
        <h4 style="color:rgb(26, 141, 235)"><u>BLOOD DETAILS</u></h4>

        <p><b>Bag No. :</b> &nbsp; {{ $invbagNo }}</p>
        <p><b>Group :</b> &nbsp; {{ $invbloodGroup }}</p>
        <p><b>Expiry Date :</b> &nbsp; {{ $invexpiryDate }}</p>
        
        <span>----------------------------------------------------------------------------------------------------------------</span>
        
        <h4 style="color:rgb(26, 141, 235)"><u>HANDLING STAFF DETAILS</u></h4>

        <p><b>Name :</b> &nbsp; {{ $invstaffName }}</p>
        <p><b>Telephone :</b> &nbsp; {{ $invstaffTelephone }}</p>

        <span>----------------------------------------------------------------------------------------------------------------</span>
    
    </div>
</body>
</html> 