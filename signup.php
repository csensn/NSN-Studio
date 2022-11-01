<?php
    $conn = mysql_connect("localhost","root","");
    $db = mysql_select_db("nsnstudio", $conn);
?>

<?php

        $user = $_POST['name'];
        $pass = $_POST['pass'];
        $email = $_POST['email'];
        $sql = "INSERT into phplogin values(".$email.",'".$user."','".$pass."')";
        $qury = mysql_query($sql);
        
        if(!$qury)
                    echo "Failed".mysql_error();
        else
                   echo "Successful"; 
?>
