<form method="post">
    <h2>Календарь</h2>
    <div>
        <input style="border: 5px solid #4a423f; color: green" type="search" name="search" placeholder="Год">
        <button class="search-button">Отобразить календарь</button>
    </div>
</form>

<?php
    show_calendar_year();

    function show_calendar_year()
    {
        if((isset($_POST["search"])) && ($_POST["search"] !== ""))
        {
            get_calendar_year($_POST["search"]);
        }
        else
        {
            echo 'error';
        }
    }

    function get_calendar_year($year)
    {
        $holidays_arr = array('Восьмое марта' => array(3, 8), 'Новый год' => array(1, 1), 'Рождество' => array(1, 7), 'Радуница' => array(4, 28), 'День труда' => array(5, 1), 'День победы' => array(5, 9), 'День независимости' => array(7, 3), 'День Октябрьской революции' => array(10, 7));
        $month_names = array(1 => 'January', 2 => 'February', 3 => 'March', 4 => 'April', 5 => 'May', 6 => 'June', 7 => 'July', 8 => 'August', 9 => 'September', 10 => 'October', 11 => 'November', 12 => 'December');
        for($i = 1; $i <= 12; $i++)
        {
            $month_str .= '<table class="history-table"><tr><th style="color: blue">' . $month_names[$i] . '</th></tr><tr><th>Monday</th><th>Tuesday</th><th>Wednesday</th><th>Thursday</th><th>Friday</th><th>Saturday</th><th>Sunday</th></tr>';
            $year_arr = get_year_arr($year);
            for($j = 1; $j <= 5; $j++)
            {
                $month_str .= '<tr>';
                for($k = 1; $k <= 7; $k++)
                {
                    if ($year_arr[$i][$k][$j] != 0)
                    {
                        if(in_array(array($i, $year_arr[$i][$k][$j]), $holidays_arr))
                        {
                            $holiday_name = array_keys($holidays_arr, array($i, $year_arr[$i][$k][$j]));
                            $month_str .= '<td style="color: green">' . $holiday_name[0] . '<br>';
                        }
                        else if ((($k + 7) % 7 == 6) or (($k + 7) % 7 == 0))
                        {
                            $month_str .= '<td style="color: red">';
                        }
                        else
                        {
                            $month_str .= '<td>';
                        }
                        $month_str .= $year_arr[$i][$k][$j] . '</td>';
                    }
                    else
                    {
                        $month_str .= '<td></td>';
                    }
                }
                $month_str .= '</tr>';
            }
            $month_str .= '</table>';
        }
        echo $month_str;
        file_put_contents('test_files/test.txt', $month_str);
    }


    function get_year_arr($year)
    {
        $empty = array_fill(1, 5, 0);
        $month = array_fill(1, 7, $empty);
        $year_arr = array_fill(1, 12, $month);
        for($i = 1; $i <= 12; $i++)
        {
            $is_start = 0;
            $time_str = "$year" . "-$i-1";
            $time = strtotime($time_str);
            $start_day = (int)date('N', $time);
            $count = 1;
            $max_count = date('t', mktime(0, 0, 0, $i, 1, $year));
            for($j = 1; $j <= 5; $j++)
            {
                for($k = 1; ($k <= 7) && ($count <= $max_count); $k++)
                {
                    if ($is_start)
                    {
                        $year_arr[$i][$k][$j] = $count++;
                    }
                    else
                    {
                        if($k === $start_day)
                        {
                            $is_start = 1;
                            $year_arr[$i][$k][$j] = $count++;
                        }
                    }
                }
            }
        }
        return $year_arr;
    }
