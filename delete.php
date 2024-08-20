<?php
    include './classes.php';
   
    if (isset($_GET['id']) && is_numeric($_GET['id'])) 
    {
        $id = $_GET['id'];
        Posts::delete($id);
    }else{
            echo 'Rong Element';
         }
?>