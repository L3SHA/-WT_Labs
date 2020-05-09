<?php set_cookie() ?>
<!Doctype html>
<html>
  <body>
      <form method="post">
          <div>
              <input type="text" name="cookie_name" placeholder="name">
              <input type="text" name="cookie_value" placeholder="value">
              <input type="text" name="cookie_time" placeholder="time">
              <input type="submit" name="Add" value="Add">
              <input type="submit" name="Delete" value="Delete">
          </div>
      </form>
      <div>
          <table>
              <tr><th>Cookie name</th><th>Cookie value</th></tr>
              <?php get_cookie_table() ?>
          </table>
      </div>
  </body>
</html>


<?php

    function set_cookie()
    {
        if($_POST["Add"] != "")
        {
            if(($_POST["cookie_name"] != "") && ($_POST["cookie_value"] != "") && ($_POST["cookie_time"] != ""))
            {
                setcookie($_POST["cookie_name"], $_POST["cookie_value"], time() + 3600 * $_POST["cookie_time"]);
            }
        }
        else
        {
            if($_POST["cookie_name"] != "")
            {
                setcookie($_POST["cookie_name"], "", time() - time());
            }
        }
    }

    function get_cookie_table()
    {
        echo $_POST["Add"];
        $str = "";
        foreach($_COOKIE as $key => $value)
        {
            $str .= '<tr><td>' . $key . '</td>';
            $str .= '<td>' . $value . '</td></tr>';
        }
        echo $str;

    }

?>
