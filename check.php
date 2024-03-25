<?php

// Another test file, used to read the file.
// now used only for debugging

$filename = "students.csv";

// Read content of student.csv
$students = fopen($filename, "r");

// Create the array
$arr_students = array();

// Read each line and write it to the array
while(($row = fgetcsv($students)) !== false) {
    $arr_students[] = $row;
}

// Close the file
fclose($students);

print_r($arr_students);

?>