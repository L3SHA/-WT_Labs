<?php
    $mysqli = new mysqli('db', 'root', 'root', 'stats');
    $mysqli->set_charset('UTF-8');
    $visitor_ip = $_SERVER['REMOTE_ADDR'];
    $date = date("Y-m-d");
    $result = $mysqli->query("SELECT 'visit_id' FROM 'visits' WHERE 'date'='$date'");
    if($result->num_rows == 0){
        $mysqli->query("DELETE FROM 'ipaddress'");
        $mysqli->query("INSERT INTO 'ipaddress' SET 'ip_address'='$visitor_ip'");
        $mysqli->query("INSERT INTO `visits` SET `date`='$date', `hosts`=1,`views`=1");
    }
    else
    {
        $current_ip = $mysqli->query("SELECT `ip_id` FROM `ipaddress` WHERE `ip_address`='$visitor_ip'");
        if ($current_ip->num_rows == 1)
        {
            $mysqli->query("UPDATE `visits` SET `views`=`views`+1 WHERE `date`='$date'");
        }
        else
        {
            $mysqli->query($db, "INSERT INTO `ips` SET `ip_address`='$visitor_ip'");
            $mysqli->query($db, "UPDATE `visits` SET `hosts`=`hosts`+1,`views`=`views`+1 WHERE `date`='$date'");
        }
    }
    $mysqli->close();
?>
