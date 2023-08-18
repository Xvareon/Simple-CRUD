<?php //Create a PHP file.


class API { //Inside of it, create a class named "API".

  // Inside of the class, create a 3 function with parameters that execute printing the parameters you pass.

  function printName($name) {
    echo "Full Name: " . $name;
  }

  function printHobbies($hobbies) {
    echo "Hobbies: " . implode($hobbies);
  }

  function printPersonalInfo($personalInfo) {
    echo "Age: " . $personalInfo->age . "\n";
    echo "Email: " . $personalInfo->email . "\n";
    echo "Birthday: " . $personalInfo->birthday;
  }

}

// Outside of Class, use the class and call the function you created.
$api = new API();

// In the 1st function, put your full name as the parameter of it.
$api->printName("Rick Gavin A. Dela Cruz\n");

// In the 2nd Function, put an Array Value of your hobbies as the parameter of it.
$api->printHobbies(array("\n\tPlaying videogames\n", "\tReading books\n", "\tWatching videos\n"));

// In the 3rd Function, put an Object Value of your Age, email address and Birthday as the parameter of it.
$personalInfo = new stdClass();
$personalInfo->age = 22;
$personalInfo->email = "rickgavin.delacruz.pixel8@gmail.com";
$personalInfo->birthday = "October 5, 2000";
$api->printPersonalInfo($personalInfo);

?>