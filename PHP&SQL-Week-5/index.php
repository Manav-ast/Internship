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
        // for ($x = 0; $x <= 10; $x++) {
        // if ($x == 3) continue;
        //     echo "The number is: $x <br>";
        // }

        // $colors = array("red", "green", "blue", "yellow");

        // foreach ($colors as $x) {
        //     echo "$x <br>";
        // }

        // $members = array("Peter"=>"35", "Ben"=>"37", "Joe"=>"43");

        // foreach ($members as $x => $y) {
        //     echo "$x : $y <br>";
        // }

        // class Car {
        //     public $color;
        //     public $model;
        //     public function __construct($color, $model) {
        //       $this->color = $color;
        //       $this->model = $model;
        //     }
        //   }
          
        // $myCar = new Car("red", "Volvo");
          
        // foreach ($myCar as $x => $y) {
        //     echo "$x: $y <br>";
        // }
        
    ?>  
    <?php
        // function familyName($fname) {
        //     echo "$fname Refsnes.<br>";
        // }

        // familyName("Jani");
        // familyName("Hege");
        // familyName("Stale");
        // familyName("Kai Jim");
        // familyName("Borge");

        // function familyName($fname, $year){
        //     echo "$fname Refsnes. Born in $year.<br>";
        // }

        // familyName("Hege", 1975);
        // familyName("Stale", 1990);
        // familyName("Kai", 1985);
        // function sum($x, $y) {
        //     $z = $x + $y;
        //     return $z;
        //   }
          
        //   echo "5 + 10 = " . sum(5, 10) . "<br>";
        //   echo "7 + 13 = " . sum(7, 13) . "<br>";
        //   echo "2 + 4 = " . sum(2, 4);

        // function add_five(&$value) {
        //     $value += 5;
        //   }
          
        //   $num = 2;
        //   add_five($num);
        //   echo $num;

        // function sumMyNumbers(...$x) {
        //     $n = 0;
        //     $len = count($x);
        //     for($i = 0; $i < $len; $i++) {
        //       $n += $x[$i];
        //     }
        //     return $n;
        //   }
          
        //   $a = sumMyNumbers(5, 2, 6, 2, 7, 7);
        //   echo $a;
        
        // function myFunction() {
        //     echo "I come from a function!";
        // }
          
        // $myArr = array("car" => "Volvo", "age" => 15, "message" => myFunction);
          
        // $myArr["message"]();

        // $cars = array("Volvo", "BMW", "Toyota");
        // rsort($cars);
        // // var_dump($cars);
        // $age = array("Peter"=>"35", "Ben"=>"37", "Joe"=>"43");
        // krsort($age);
        // var_dump($age);

        // $x = 15;
        // function global_test() {
        //     echo $GLOBALS['x'] = 20;
        // }

        // global_test();
    ?>

    <!-- <form action="" method="GET">
        Name: <input type="text" name="name" value="<?php //echo $name;?>">

        E-mail: <input type="text" name="email" value="<?php //echo $email;?>">

        Website: <input type="text" name="website" value="<?php //echo $website;?>">

        Comment: <textarea name="comment" rows="5" cols="40"><?php //echo $comment;?></textarea>

        Gender:
        <input type="radio" name="gender"
        <?php //if (isset($gender) && $gender=="female") echo "checked";?>
        value="female">Female
        <input type="radio" name="gender"
        <?php //if (isset($gender) && $gender=="male") echo "checked";?>
        value="male">Male
        <input type="radio" name="gender"
        <?php //if (isset($gender) && $gender=="other") echo "checked";?>
        value="other">Other
    </form> -->
    <?php
        // date_default_timezone_set("Asia/Kolkata");
        // echo "Today is " . date("Y/m/d") . "<br>";
        // echo "Today is " . date("Y.m.d") . "<br>";
        // echo "Today is " . date("Y-m-d") . "<br>";
        // echo "Today is " . date("l") . "<br>";
        // echo "Time is " . date("h:i:sa") . "<br>";
        // echo "Time is " . date("H:i:s") . "<br>";
        // $d=strtotime("10:30pm April 15 2014");
        // echo "Created date is " . date("Y-m-d h:i:sa", $d) . "<br>";

        // $d=strtotime("tomorrow");
        // echo date("d-m-Y h:i:sa", $d) . "<br>";

        // $d=strtotime("next Saturday");
        // echo date("Y-m-d h:i:sa", $d) . "<br>";

        // $d=strtotime("+3 Months");
        // echo date("Y-m-d h:i:sa", $d) . "<br>";

        // $startdate = strtotime("Saturday");
        // $enddate = strtotime("+6 weeks", $startdate);

        // while ($startdate < $enddate) {
        // echo date("M d", $startdate) . "<br>";
        // $startdate = strtotime("+1 week", $startdate);
        // }
    ?>
    <!-- <h1>Welcome to my home page!</h1>
    <p>Some text.</p>
    <p>Some more text.</p> -->
    <?php //include 'action.php';?>

    <?php 
        // $myfile = fopen("test.txt", "r") or die("Unable to open file!");
        // echo fread($myfile,filesize("test.txt"));
        // fclose($myfile);
        // echo fread($myfile, filesize('test.txt'));
        // $myfile = fopen("test.txt", "r") or die("Unable to open file!");
        // // Output one line until end-of-file
        // while(!feof($myfile)) {
        //     echo fgetc($myfile) . "<br>";
        // }
        // fclose($myfile);

        // $myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
        // $txt = "John Doe\n";
        // fwrite($myfile, $txt);
        // $txt = "Manav Vaishnani\n";
        // fwrite($myfile, $txt);
        // fclose($myfile);
    ?>


    <!-- <form action="action.php" method="GET">
        Name:<input type="text" name="name"> 
        Message:<textarea name="message" rows="4" cols="50"></textarea>
        <input type="submit">
    </form> -->

    <?php
// class Fruit {
//   // Properties
//   public $name;
//   public $color;

//   // Methods
//   function set_name($name) {
//     $this->name = $name;
//   }
//   function get_name() {
//     return $this->name;
//   }
// }

// $apple = new Fruit();
// $banana = new Fruit();
// $apple->set_name('Apple');
// $banana->set_name('Banana');

// echo $apple->get_name();
// echo "<br>";
// echo $banana->get_name();

// class Fruit {
//     // Properties
//     public $name;
//     public $color;
  
//     // Methods
//     function set_name($name) {
//       $this->name = $name;
//     }
//     function get_name() {
//       return $this->name;
//     }
//     function set_color($color) {
//       $this->color = $color;
//     }
//     function get_color() {
//       return $this->color;
//     }
//   }
  
//   $apple = new Fruit();
//   $banana = new Fruit();
//   $apple->set_name('Apple');
//   $apple->set_color('Red');

//   $banana->set_name('Banana');
//   $banana->set_color('Yellow');

//   echo "Name: " . $apple->get_name();
//   echo "<br>";
//   echo "Color: " . $apple->get_color();
//   echo "<br>";
//   echo "Name: ". $banana->get_name();
//   echo "<br>";
//   echo "Color: ". $banana->get_color();
//   echo "<br>";
//   $apple = new Fruit();
//   var_dump($apple instanceof Fruit);
// class Fruit {
//   public $name;
//   public $color;

//   function __construct($name, $color) {
//     $this->name = $name;
//     $this->color = $color;
//   }

//   function get_name() {
//     return $this->name;
//   }
//   function __destruct()
//   {
//     echo "Object ". $this->name. " destroyed";
//   }
// }

// $apple = new Fruit("Apple", "red");
?>

<?php
// class Fruit {
//   public $name;
//   protected $color;
//   private $weight;
// }

// $mango = new Fruit();
// $mango->name = 'Mango'; // OK
// $mango->color = 'Yellow'; // ERROR
// $mango->weight = '300'; // ERROR

// class Fruit {
//   public $name;
//   public $color;
//   public $weight;

//   function set_name($n) {  // a public function (default)
//     $this->name = $n;
//   }
//   protected function set_color($n) { // a protected function
//     $this->color = $n;
//   }
//   private function set_weight($n) { // a private function
//     $this->weight = $n;
//   }
// }

// $mango = new Fruit();
// $mango->set_name('Mango'); // OK
// $mango->set_color('Yellow'); // ERROR
// $mango->set_weight('300'); // ERROR


// class Fruit {
//   public $name;
//   public $color;
//   public function __construct($name, $color) {
//     $this->name = $name;
//     $this->color = $color;
//   }
//   public function intro() {
//     echo "The fruit is {$this->name} and the color is {$this->color}.";
//   }
// }

// // Strawberry is inherited from Fruit
// class Strawberry extends Fruit {
//   public function message() {
//     echo "Am I a fruit or a berry? ";
//   }
// }
// $strawberry = new Strawberry("Strawberry", "red");
// $strawberry->message();
// $strawberry->intro();

?>


<?php
// class Goodbye {
//   const LEAVING_MESSAGE = "Thank you for visiting W3Schools.com!";
//   public function byebye() {
//     echo self::LEAVING_MESSAGE;
//   }
// }

// $goodbye = new Goodbye();
// $goodbye->byebye();
?>


<?php
// Parent class
// abstract class Car {
//   public $name;
//   public function __construct($name) {
//     $this->name = $name;
//   }
//   abstract public function intro() : string;
// }

// // Child classes
// class Audi extends Car {
//   public function intro() : string {
//     return "Choose German quality! I'm an $this->name!";
//   }
// }

// class Volvo extends Car {
//   public function intro() : string {
//     return "Proud to be Swedish! I'm a $this->name!";
//   }
// }

// class Citroen extends Car {
//   public function intro() : string {
//     return "French extravagance! I'm a $this->name!";
//   }
// }

// // Create objects from the child classes
// $audi = new audi("Audi");
// echo $audi->intro();
// echo "<br>";

// $volvo = new volvo("Volvo");
// echo $volvo->intro();
// echo "<br>";

// $citroen = new citroen("Citroen");
// echo $citroen->intro();
?>

<?php
// Interface definition
// interface Animal {
//   public function makeSound();
// }

// // Class definitions
// class Cat implements Animal {
//   public function makeSound() {
//     echo " Meow ";
//   }
// }

// class Dog implements Animal {
//   public function makeSound() {
//     echo " Bark ";
//   }
// }

// class Mouse implements Animal {
//   public function makeSound() {
//     echo " Squeak ";
//   }
// }

// // Create a list of animals
// $cat = new Cat();
// $dog = new Dog();
// $mouse = new Mouse();
// $animals = array($cat, $dog, $mouse);

// // Tell the animals to make a sound
// foreach($animals as $animal) {
//   $animal->makeSound() ;
//   echo "<br>";
// }
?>

<?php
// trait message1 {
// public function msg1() {
//     echo "OOP is fun! ";
//   }
// }

// class Welcome {
//   use message1;
// }

// $obj = new Welcome();
// $obj->msg1();

trait message1 {
    public function msg1() {
      echo "OOP is fun! ";
    }
  }
  
  trait message2 {
    public function msg2() {
      echo "OOP reduces code duplication!";
    }
  }
  
  class Welcome {
    use message1;
  }
  
  class Welcome2 {
    use message1, message2;
  }
  
  $obj = new Welcome();
  $obj->msg1();
  echo "<br>";
  
  $obj2 = new Welcome2();
  $obj2->msg1();
  $obj2->msg2();
  echo "<br>";
  echo "<br>";
?>

<?php
class domain {
  protected static function getWebsiteName() {
    return "Manav Vaishanani.com";
  }
}

class domainW3 extends domain {
  public $websiteName;
  public function __construct() {
    $this->websiteName = parent::getWebsiteName();
  }
}

$domainW3 = new domainW3;
echo $domainW3 -> websiteName;
?>
</body>
</html>