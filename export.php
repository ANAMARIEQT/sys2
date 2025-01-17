<?php 
 
// Load the database configuration file 
include_once 'connect.php'; 
 
// Fetch records from database 
$query = $con->query("SELECT * FROM students ORDER BY status ASC"); 
 
if($query->num_rows > 0){ 
    $delimiter = ","; 
    $filename = "student-data_" . date('Y-m-d') . ".csv"; 
     
    // Create a file pointer 
    $f = fopen('php://memory', 'w'); 
     
    // Set column headers 
    $fields = array('ID','Stundet ID', 'FIRST NAME', 'LAST NAME', 'EMAIL', 'GENDER', 'STATUS'); 
    fputcsv($f, $fields, $delimiter); 
     
    // Output each row of the data, format line as csv and write to file pointer 
    while($row = $query->fetch_assoc()){ 
        
        $lineData = array($row['id'],$row['Student_ID'], $row['firstname'], $row['lastname'], $row['email'], $row['gender'], $row['status']); 
        fputcsv($f, $lineData, $delimiter); 
    } 
     
    // Move back to beginning of file 
    fseek($f, 0); 
     
    // Set headers to download file rather than displayed 
    header('Content-Type: text/csv'); 
    header('Content-Disposition: attachment; filename="' . $filename . '";'); 
     
    //output all remaining data on a file pointer 
    fpassthru($f); 
} 
exit; 
 
?>