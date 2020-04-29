<!Doctype html>
<html>
    <form method="post">
        <input type="input" name="text" placeholder="Введите текст">
        <button>Преобразовать</button>
    </form>
    <?php get_highlighted_mails_text()?>
</html>

<?php
    function get_highlighted_mails_text()
    {
        if($_POST["text"] != "")
        {
            $text = $_POST["text"];
            $mail_pattern = '#\w((\.\w)|\w)*@\w+\.\w+#';
            $str = preg_grep($mail_pattern, preg_split("#\s+#", $text));
            foreach ($str as $mail) {
                file_put_contents("test_files/test4.txt", $mail . "\n", FILE_APPEND);
            }
            $str = preg_replace($mail_pattern, "<a style=\"color: red;\" href=\"mailto:$0\">"."$0"."</a>", $text);
            echo $str;
        }
    }
?>
