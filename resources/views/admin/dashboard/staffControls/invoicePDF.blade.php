<!DOCTYPE html>
<html>
<head>
    <title>BLOOD RECEIVAL RECEIPT</title>
</head>
<body>
    <div style="background: #dfe4f5; border:solid; border-radius:5px; padding:50px;">
        <h1 style="color:red">ONE DROP</h1>
        <hr><br>
        <h3 style="color:#025abf">BLOOD RECEIVAL RECEIPT</h3><hr style="border: black;">
        <p><b>Request No. :</b> &nbsp; {{ $invrequestNo }} &nbsp;&nbsp;|&nbsp;&nbsp;<b>Date :</b> &nbsp; {{ $invdate }}
            &nbsp;&nbsp;|&nbsp;&nbsp;<b>Time :</b> &nbsp; {{ $invtime }}</p>
        <span>-------------------------------------------------------------------------------------------------------</span>
        <p><b>Patient Name :</b> &nbsp; {{ $invfullname }}</p>
        <span>-------------------------------------------------------------------------------------------------------</span>
        <p><b>NIC No. :</b> &nbsp; {{ $invnic }}</p>
        <span>-------------------------------------------------------------------------------------------------------</span>
        <p><b>Patient Email :</b> &nbsp; {{ $invemail }} &nbsp;&nbsp;|&nbsp;&nbsp;<b>Patient Telephone :</b> &nbsp; {{ $invtelephone }}</p> 
        <span>-------------------------------------------------------------------------------------------------------</span>
        <p><b>Blood Bag No. :</b> &nbsp; {{ $invbagNo }}</p>
        <span>-------------------------------------------------------------------------------------------------------</span>
        <p><b>Blood Group :</b> &nbsp; {{ $invbloodGroup }} &nbsp;&nbsp;|&nbsp;&nbsp;<b>Blood Expiry Date :</b> &nbsp; {{ $invexpiryDate }}</p>
        <span>-------------------------------------------------------------------------------------------------------</span>
        <p><b>Handling Staff Member :</b> &nbsp; {{ $invstaffName }}</p>
        <span>-------------------------------------------------------------------------------------------------------</span>
        <p><b>Handling Staff Member Telephone :</b> &nbsp; {{ $invstaffTelephone }}</p>
    </div>
</body>
</html> 