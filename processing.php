<?php
    require 'classes.php';
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if (isset($_POST['create'])) 
        {
            $title =   Posts::chk_daata($_POST['title']);
            $content = Posts::chk_daata($_POST['content']);
            $author =  Posts::chk_daata($_POST['author']);

            Posts::create($title,$content,$author);
        }

        if (isset($_POST['update'])) 
        {
            $title =   Posts::chk_daata($_POST['title']);
            $content = Posts::chk_daata($_POST['content']);
            $author =  Posts::chk_daata($_POST['author']);
        
            if(!empty($title) && !empty($content) && !empty( $author))
            {
                Posts::update($_POST['id'],$title,$content,$author);
            }
        } 
    }
?>