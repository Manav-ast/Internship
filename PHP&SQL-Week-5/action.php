<?php
    // $cookie_name = "user";
    // $cookie_value = "Manav Vaishnani    ";
    // setcookie($cookie_name, $cookie_value, time() - 60, "/"); // 86400 = 1 day
?>
<html>
<body>
    <?php
        // if(!isset($_COOKIE[$cookie_name])) {
        //     echo "Cookie named '" . $cookie_name . "' is not set!";
        // } else {
            
        //     echo "Cookie '" . $cookie_name . "' is set!<br>";
        //     echo "Value is: " . $_COOKIE[$cookie_name];
        // }
    ?>
</body>
</html>

<?php
setcookie("test_cookie", "test", time() - 3600, '/');
?>
<html>
<body>

<?php
if(count($_COOKIE) > 0) {
    foreach ($_COOKIE as $key => $value) {
        echo "Key: ". $key. ", Value: ". $value. "<br>";
    }
  echo "Cookies are enabled.";
} else {
  echo "Cookies are disabled.";
}
?>

</body>
</html>


</body>
</html>