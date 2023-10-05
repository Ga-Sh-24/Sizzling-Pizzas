<?php
$conn=mysqli_connect('localhost', 'garima', 'garimashri24', 'ninja_pizza');    

//check the connection--
if(!$conn){     
    echo 'Connection Error: '. mysqli_connect_error();
}
?>