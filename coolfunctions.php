<?php


// depreciated, but this is where we started :D
if(isset($_GET['sort'])){
    if($_GET['sort'] == 'fname'){
        if(isset($_GET['desc']) || $_GET['sort'] != 'fname'){
            usort($arr_students, fn($a, $b) => strtolower($b[0]) <=> strtolower($a[0]));
            $descending = "";
            $col1 .= $down;
        } else {
            usort($arr_students, fn($a, $b) => strtolower($a[0]) <=> strtolower($b[0]));
            $link1 .= $descending;
            $col1 .= $up;
        }
    } else if ($_GET['sort'] == 'lname'){
        if(isset($_GET['desc'])){
            usort($arr_students, fn($a, $b) => strtolower($b[1]) <=> strtolower($a[1]));
            $descending = "";
            $col2 .= $down;
        } else {
            usort($arr_students, fn($a, $b) => strtolower($a[1]) <=> strtolower($b[1]));
            $link2 .= $descending;
            $col2 .= $up;
        }
    } else if ($_GET['sort'] == 'regno'){
        if(isset($_GET['desc'])){
            usort($arr_students, fn($a, $b) => $b[2] <=> $a[2]);
            $descending = "";
            $col3 .= $down;
        } else {
            usort($arr_students, fn($a, $b) => $a[2] <=> $b[2]);
            $link3 .= $descending;
            $col3 .= $up;
        }
    } else {
        echo "Sorting error. oops :p";
    }
}