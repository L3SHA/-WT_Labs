<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Stats</title>
    </head>

    <body>
        <h2>Статистика</h2>
        <p><a href="?interval=1">За сегодня</a></p>
        <p><a href="?interval=7">За последнюю неделю</a></p>
        <table style="border: 1px solid silver;">
            <tr>
                <td style="border: 1px solid silver;">Дата</td>
                <td style="border: 1px solid silver;">Уникальных посетителей</td>
                <td style="border: 1px solid silver;">Просмотров</td>
            </tr>
            <?php show_stats()?>
        </table>
    </body>
</html>



<?php
    function show_stats()
    {
        if (isset($_GET['interval'])){
            $interval = $_GET['interval'];
            $mysqli = new mysqli("db", "root", "root", "stats");
            if ($mysqli->connect_errno){
                echo "Не удалось подключиться к MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
            }
            $mysqli->set_charset('UTF-8');
            $result = $mysqli->query("SELECT * FROM `visits` ORDER BY `date` DESC LIMIT $interval");
            while ($row = $result->fetch_assoc())
            {
                echo '<tr>
                    <td style="border: 1px solid silver;">' . $row['date'] . '</td>
                    <td style="border: 1px solid silver;">' . $row['hosts'] . '</td>
                    <td style="border: 1px solid silver;">' . $row['views'] . '</td>
                      </tr>';
            }
        }
    }
?>
