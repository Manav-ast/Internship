<?php
// session_start();
?>
<!-- <!DOCTYPE html>
<html>
<body>

<?php
// Echo session variables that were set on previous page
// echo "Favorite color is " . $_SESSION["favcolor"] . ".<br>";
// echo "Favorite animal is " . $_SESSION["favanimal"] . "." . "<br>";

// $_SESSION['favcolor'] = "Blue";
// print_r($_SESSION);

// session_unset();
// session_destroy();

?>

</body> -->
<!-- </html> -->


<!DOCTYPE html>
<html>
<head>
<style>
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}
th, td {
  padding: 5px;
}
</style>
</head>
<body>

<table>
  <!-- <tr>
    <td>Filter Name</td>
    <td>Filter ID</td>
  </tr> -->
  <?php
//   foreach (filter_list() as $id =>$filter) {
//     echo '<tr><td>' . $filter . '</td><td>' . filter_id($filter) . '</td></tr>';
//   }
  ?>
</table>

<?php
// $str = "<h1>Hello World!</h1>";
// $newstr = filter_var($str, 513);
// echo $newstr;

// $int = "0x100";

// if (!filter_var($int, FILTER_VALIDATE_INT) === false) {
//   echo("Integer is valid");
// } else {
//   echo("Integer is not valid");
// }


?>

<?php
// $ip = "127.0.0.265";

// if (!filter_var($ip, FILTER_VALIDATE_IP) === false) {
//   echo("$ip is a valid IP address");
// } else {
//   echo("$ip is not a valid IP address");
// }

/* variable to check */
?>
<?php
    // $int = 1;

    // /* min value */
    // $min = 1;
    // /* max value */
    // $max = 200;

    // if (filter_var($int, FILTER_VALIDATE_INT, array("options" => array("min_range"=>$min, "max_range"=>$max))) === false) {
    // echo("Variable value is not within the legal range");
    // } else {
    // echo("Variable value is within the legal range"); 
    // }
?>

<?php
// $jsonobj = '{"Peter":35,"Ben":37,"Joe":43}';

// $obj = json_decode($jsonobj);

// echo $obj->Peter . "<br>";
// echo $obj->Ben . "<br>";
// echo $obj->Joe . "<br>";

// function divide($dividend, $divisor) {
//   if($divisor == 0) {
//     throw new Exception("Division by zero") . "<br>";
//   }
//   return $dividend / $divisor;
// }

// echo divide(5, 0);


// function divide($dividend, $divisor) {
//     if($divisor == 0) {
//       throw new Exception("Division by zero");
//     }
//     return $dividend / $divisor;
//   }
  
//   try {
//     echo divide(5, 0);
//   } catch(Exception $e) {
//     echo "Unable to divide.";
//   }

// function divide($dividend, $divisor) {
//     if($divisor == 0) {
//       throw new Exception("Division by zero");
//     }
//     return $dividend / $divisor;
//   }
  
//   try {
//     echo divide(5, 0);
//   } catch(Exception $e) {
//     echo "Unable to divide. ";
//   } finally {
//     echo "Process complete.";
//   }

// function divide($dividend, $divisor) {
//     if($divisor == 0) {
//       throw new Exception("Division by zero", 1);
//     }
//     return $dividend / $divisor;
//   }
  
//   try {
//     echo divide(5, 0);
//   } catch(Exception $ex) {
//     $code = $ex->getCode();
//     $message = $ex->getMessage();
//     $file = $ex->getFile();
//     $line = $ex->getLine();
//     echo "Exception thrown in $file on line $line: [Code $code]
//     $message";
//   }
?>


</body>
</html>
