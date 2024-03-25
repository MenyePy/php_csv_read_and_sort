<?php

//MenyePy

$up = " ↑";
$down = " ↓";

$filename = "students.csv";

//Table header values, so that we can append the up and down arrows
$col1 = "First name";
$col2 = "Last name";
$col3 = "Reg no.";

$descending = "<input type='hidden' name='desc' value='1'>";

// Read content of student.csv
$students = fopen($filename, "r");

// Create the array, this is the main array we using lmao. csv data will be stored here
$arr_students = array();

// Read each line and write it to the array
while(($row = fgetcsv($students)) !== false) {
    $arr_students[] = $row;
}

//an alternative type of this function is in coolfunctions.php, same idea although it was an earlier version
// we use strtolower to sort both capitals and lowercase properly, https://stackoverflow.com/questions/2699086/how-to-sort-a-multi-dimensional-array-by-value
// usort is used to sort the multidimensional array
// it is a clusterf*** but ill try to explain it
if(isset($_POST['sort'])){
    if(isset($_POST['desc'])){
        if($_POST['sort'] == 'fname'){
            usort($arr_students, fn($a, $b) => strtolower($b[0]) <=> strtolower($a[0])); // sort the array by value, link is in stack overflow
            $descending = ""; //setting descending to nothing so that the link will be for ascending sort (descending is echoed down in the html)
            $col1 .= $down; //adding the down arrow
         } else if ($_POST['sort'] == 'lname'){
            usort($arr_students, fn($a, $b) => strtolower($b[1]) <=> strtolower($a[1]));
            $descending = "";
            $col2 .= $down;
         } else if ($_POST['sort'] == 'regno'){
            usort($arr_students, fn($a, $b) => $b[2] <=> $a[2]);
            $descending = "";
            $col3 .= $down;
         }
    } else {
         if($_POST['sort'] == 'fname'){
            usort($arr_students, fn($a, $b) => strtolower($a[0]) <=> strtolower($b[0])); // a and b swapped (a is now first) to sort in ascending order
             $link1 .= $descending; // adding the descending part to the link so that on the next click it will be sorted in descending order
             $col1 .= $up; 
         } else if ($_POST['sort'] == 'lname'){
             usort($arr_students, fn($a, $b) => strtolower($a[1]) <=> strtolower($b[1]));
             $link2 .= $descending;
             $col2 .= $up;
         } else if ($_POST['sort'] == 'regno'){
             usort($arr_students, fn($a, $b) => $a[2] <=> $b[2]);
             $link3 .= $descending;
             $col3 .= $up;
         }
    }
}

//search
if(isset($_GET['search'])){
    $results = array(); //the array we will use to temporarily store the results
    foreach ($arr_students as $key => $value) { // looping through the array to get each student
        $found = false; // detecting if there is a match
        foreach ($value as $key => $val){ // looping through student details, name, surname, regno
            if(preg_match('/'.$_GET['search'].'/', $val, $matches)){ // searching for the search term in the student info, storing matches in $matches (for debug)
                // echo $matches;
                $found = true; // self explanatory ngl
            }
        }
        if ($found){
            $results[] = $value; // adding the student to the array of results
        }
    }
    $arr_students = $results; //replacing arr_students with the results array so that it is displayed in the browser
}

// Close the file, for good practice and marks
fclose($students);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
<div class="wrapper">
<div class="top">
    <form action="index.php" method="get">
        <input type="text" class="search" name="search" value="<?php echo $_GET['search']; ?>">
        <input type="submit" value="Search" class="btn">
        <button class="btn"><a href="index.php">Reset sort & search</a></button>
    </form>
</div>
<div class="mainapp">
<table>

<tr>
    <th><form class="linkform" method="post">
        <input type="hidden" name="sort" value="fname">
        <?php echo $descending; ?>
        <input type="submit" value="<?php echo $col1; ?>" class="link">
    </form></th>
    <th><form class="linkform" method="post">
        <input type="hidden" name="sort" value="lname">
        <?php echo $descending; ?>
        <input type="submit" value="<?php echo $col2; ?>" class="link">
    </form></th>
    <th><form class="linkform" method="post">
        <input type="hidden" name="sort" value="regno">
        <?php echo $descending; ?>
        <input type="
submit" value="<?php echo $col3; ?>" class="link">
    </form></th>
</tr>
<!-- The table of wonder. a simple for loop, nothing special. when this was made we had not learned foreach so there's that :P -->
<?php
for ($i = 0; $i < sizeof($arr_students); $i++){
    echo "<tr><td>" . $arr_students[$i][0] . "</td><td>" . $arr_students[$i][1] . "</td><td>" . $arr_students[$i][2] . "</td></tr>";
}
?>
</table>
<p>*Click the table header to sort the data.</p>
</div></div>



</body>
</html>
