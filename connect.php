<?php $conn = oci_connect("ecommerce", "Saugat123#", '//localhost/xe'); 

if (!$conn) {
   $m = oci_error();
   echo $m['message'], "\n";
   exit; } else {
   print "Connected to Oracle!"; 
} 
   
   
   // echo "Display data";
   // $qry="SELECT * from USERINFO";
   // $stid=oci_parse($conn, $qry);
   // oci_execute($stid);
   // echo '<table border=1>';
   // while($row=oci_fetch_assoc($stid))
   // {
   // echo '<tr>';
   // echo '<td>'.$row['USERID'].'</td>';
   // echo '<td>'.$row['UNAME'].'</td>';
   // echo '<td>'.$row['UPASS'].'</td>';
   // echo '<td>'.$row['USTATUS'].'</td>';
   // echo '</tr>';
   
   
   // }
   // echo '</table>';
   
   // echo "INsert Data";
   // $qry="INSERT INTO USERINFO (USERID, UNAME, UPASS, USTATUS) VALUES (USERINFO_SEQ.nextval, 'admin', 'admin', 1)";
   // $stid=oci_parse($conn, $qry);
   // oci_execute($stid);
   
   // echo "Data INserted Successfully";
   
   
   
   
   
   
   
   oci_close($conn); ?>