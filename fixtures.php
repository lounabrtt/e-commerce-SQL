<?php

require 'vendor/autoload.php';
use Faker\Factory;


$conn = new mysqli("127.0.0.1", "root", "", "e-commerce-sql", 3307); 


if ($conn->connect_error) { 
    die("connection failed : " . $conn->connect_error); 
}


$faker = Factory::create();

// random new user
echo "User insertion...\n"; 
for ($i = 0; $i < 10; $i++) { 
    $name = $faker->name(); 
    $email = $faker->unique()->email(); 
    $password = "123456"; 
    $phone = $faker->phoneNumber(); 

    // request for user tab.
    $sql = "INSERT INTO user (name, email, password, phone) VALUES ('$name', '$email', '$password', '$phone')";
    $conn->query($sql); 
}

// random new stuff
echo "Insertion of products....\n"; 
for ($i = 0; $i < 10; $i++) { 
    $name = $faker->word(); 
    $description = $faker->sentence(); 
    $price = $faker->randomFloat(2, 1, 100);  // the random price limit is 100
    $stock = $faker->numberBetween(1, 50); 

    // request for product tab.
    $sql = "INSERT INTO product (name, description, price, stock) VALUES ('$name', '$description', $price, $stock)";
    $conn->query($sql); 
}


echo "Dummy data successfully inserted !\n";


$conn->close();
