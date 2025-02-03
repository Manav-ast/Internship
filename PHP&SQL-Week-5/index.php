<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP</title>
</head>
<body>
    <!-- <form action="action.php" method="post">
    <label for="name">Your name:</label>
    <input name="name" id="name" type="text">

    <label for="age">Your age:</label>
    <input name="age" id="age" type="number">

    <button type="submit">Submit</button>
    
    </form> -->
    <?php 
        // $txt1 = "Learn PHP";
        // $txt2 = "W3Schools.com"; 
        
        // echo '<h2>' . $txt1 . '</h2>';
        // echo '<p>Study PHP at ' . $txt2 . '</p>';
    ?>
    
    <?php
        // $a_bool = true;   // a bool
        // $a_str  = "foo";  // a string
        // $a_str2 = 'foo';  // a string
        // $an_int = 12;     // an int

        // echo get_debug_type($a_bool), "\n";
        // echo get_debug_type($a_str), "\n";

        // // If this is an integer, increment it by four
        // if (is_int($an_int)) {
        //     $an_int += 4;
        // }
        // var_dump($an_int);

        // // If $a_bool is a string, print it out
        // if (is_string($a_bool)) {
        //     echo "String: $a_bool";
        // }
    ?>

    <?php 
        // echo ceil(26.4);
    ?>

    <?php
    // $array = array(
    //     1    => 'a',
    //     '1'  => 'b', // the value "a" will be overwritten by "b"
    //     1.5  => 'c', // the value "b" will be overwritten by "c"
    //     -1 => 'd',
    //     '01'  => 'e', // as this is not an integer string it will NOT override the key for 1
    //     '1.5' => 'f', // as this is not an integer string it will NOT override the key for 1
    //     true => 'g', // the value "c" will be overwritten by "g"
    //     false => 'h',
    //     '' => 'i',
    //     null => 'j', // the value "i" will be overwritten by "j"
    //     'k', // value "k" is assigned the key 2. This is because the largest integer key before that was 1
    //     2 => 'l', // the value "k" will be overwritten by "l"
    // );

    // var_dump($array);
    ?>

    <?php
    // $array = [];

    // $array[-5] = 1;
    // $array[] = 2;

    // var_dump($array);
    ?>

    <?php
    // $array = array(
    //     "foo" => "bar",
    //     42    => 24,
    //     "multi" => array(
    //         "dimensional" => array(
    //             "array" => "foo"
    //         )
    //     )
    // );

    // var_dump($array["foo"]);
    // var_dump($array[42]);
    // var_dump($array["multi"]["dimensional"]["array"]);

    // function getArray() {
    //     return array(1, 2, 30);
    // }
    
    // $secondElement = getArray()[2];
    // var_dump($secondElement);
    ?>

    <?php
    // Create a simple array.
    // $array = array(1, 2, 3, 4, 5);
    // print_r($array);

    // // Now delete every item, but leave the array itself intact:
    // foreach ($array as $i => $value) {
    //     unset($array[$i]);
    // }
    // print_r($array);

    // // Append an item (note that the new key is 5, instead of 0).
    // $array[] = 6;
    // print_r($array);

    // // Re-index:
    // $array = array_values($array);
    // $array[] = 7;
    // print_r($array);
    ?>

    <?php
    // $source_array = ['foo', 'bar', 'baz'];

    // [$foo, $bar, $baz] = $source_array;

    // echo $foo;    // prints "foo"
    // echo $bar;    // prints "bar"
    // echo $baz;    // prints "baz"
    ?>

    <?php
        // $source_array = [
        //     [1, 'John'],
        //     [2, 'Jane'],
        // ];

        // foreach ($source_array as [$id, $name]) {
        //     // logic here with $id and $name
        //     echo "ID: $id, Name: $name\n";
        // }
    ?>

    <?php
        // error_reporting(E_ALL);
        // ini_set('display_errors', true);
        // ini_set('html_errors', false);
        // // Simple array:
        // $array = array(1, 2);
        // $count = count($array);
        // for ($i = 0; $i < $count; $i++) {
        //     echo "\nChecking $i: \n";
        //     echo "Bad: " . $array['$i'] . "\n";
        //     echo "Good: " . $array[$i] . "\n";
        //     echo "Bad: {$array['$i']}\n";
        //     echo "Good: {$array[$i]}\n";
        // }

        // $a = 5;       // Integer
        // $b = 5.34;    // Float
        // $c = "hello"; // String
        // $d = true;    // Boolean
        // $e = NULL;    // NULL

        // $a = (string) $a;
        // $b = (string) $b;
        // $c = (string) $c;
        // $d = (string) $d;
        // $e = (string) $e;

        // //To verify the type of any object in PHP, use the var_dump() function:
        // var_dump($a);
        // var_dump($b);
        // var_dump($c);
        // var_dump($d);
        // var_dump($e);
    ?>

    <?php 
        // $arr = array(1, 2, 3, 4, 5);
        // var_dump($arr);
        // $favcolor = "blue";

        // switch ($favcolor) {
        // case "red":
        //     echo "Your favorite color is red!";
        // case "blue":
        //     print "Your favorite color is blue!";
        //     break;
        // case "green":
        //     echo "Your favorite color is green!";
        //     break;
        // default:
        //     echo "Your favorite color is neither red, blue, nor green!";
        // }
    ?>
    <?php  
        for ($x = 0; $x <= 10; $x++) {
        if ($x == 3) continue;
            echo "The number is: $x <br>";
        }
    ?>  
</body>
</html>