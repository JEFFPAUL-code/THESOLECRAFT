<?php
// JSON data containing product information
$jsonData = '[
    {
        "id": 1,
        "name":" LD01 LOUNGE CHAIR",
        "price": 200,
        "image": "img/prod/1.png",
        "description": "Expertly rendered by Carl Hansen & Søn, the lounge chair—first introduced in 1951 and enduring ever since—is available in oak or as a combination of oak and walnut, sourced from sustainable forestry. Choose from seat and back upholstery in a selection of leather options or in a custom fabric."
    },
    {
        "id": 2,
        "name":" LD02 LOUNGE CHAIR",
        "price": 250,
        "image": "img/prod/2.png",
        "description": "Expertly rendered by Carl Hansen & Søn, the lounge chair—first introduced in 1951 and enduring ever since—is available in oak or as a combination of oak and walnut, sourced from sustainable forestry. Choose from seat and back upholstery in a selection of leather options or in a custom fabric."
    },
    {
        "id": 3,
        "name":" LD03 LOUNGE CHAIR",
        "price": 290,
        "image": "img/prod/3.png",
        "description": "Expertly rendered by Carl Hansen & Søn, the lounge chair—first introduced in 1951 and enduring ever since—is available in oak or as a combination of oak and walnut, sourced from sustainable forestry. Choose from seat and back upholstery in a selection of leather options or in a custom fabric."
    },
    {
        "id": 4,
        "name":" LD04 LOUNGE CHAIR",
        "price": 200,
        "image": "img/prod/4.png",
        "description": "Expertly rendered by Carl Hansen & Søn, the lounge chair—first introduced in 1951 and enduring ever since—is available in oak or as a combination of oak and walnut, sourced from sustainable forestry. Choose from seat and back upholstery in a selection of leather options or in a custom fabric."
    },
    {
        "id": 5,
        "name":" LD05 LOUNGE CHAIR",
        "price": 300,
        "image": "img/prod/5.png",
        "description": "Expertly rendered by Carl Hansen & Søn, the lounge chair—first introduced in 1951 and enduring ever since—is available in oak or as a combination of oak and walnut, sourced from sustainable forestry. Choose from seat and back upholstery in a selection of leather options or in a custom fabric."
    },
    {
        "id": 6,
        "name":" LD06 LOUNGE CHAIR",
        "price": 200,
        "image": "img/prod/6.png",
        "description": "Expertly rendered by Carl Hansen & Søn, the lounge chair—first introduced in 1951 and enduring ever since—is available in oak or as a combination of oak and walnut, sourced from sustainable forestry. Choose from seat and back upholstery in a selection of leather options or in a custom fabric."
    },
    {
        "id": 7,
        "name":" LD07 LOUNGE CHAIR",
        "price": 200,
        "image": "img/prod/7.png",
        "description": "Expertly rendered by Carl Hansen & Søn, the lounge chair—first introduced in 1951 and enduring ever since—is available in oak or as a combination of oak and walnut, sourced from sustainable forestry. Choose from seat and back upholstery in a selection of leather options or in a custom fabric."
    },
    {
        "id": 8,
        "name":" LD08 LOUNGE CHAIR",
        "price": 200,
        "image": "img/prod/8.png",
        "description": "Expertly rendered by Carl Hansen & Søn, the lounge chair—first introduced in 1951 and enduring ever since—is available in oak or as a combination of oak and walnut, sourced from sustainable forestry. Choose from seat and back upholstery in a selection of leather options or in a custom fabric."
    }
    
]';

// Database connection parameters
$servername = "localhost"; // Replace with your database hostname
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$dbname = "solecraft"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Decode JSON data into PHP array
$products = json_decode($jsonData, true);

// Prepare and execute SQL INSERT statements for each product
foreach ($products as $product) {
    $id = $product['id'];
    $name = $conn->real_escape_string($product['name']);
    $price = $product['price'];
    $image = $conn->real_escape_string($product['image']);
    $description = $conn->real_escape_string($product['description']);

    $sql = "INSERT INTO products (id, name, price, image, description) 
            VALUES ('$id', '$name', '$price', '$image', '$description')";

    if ($conn->query($sql) === TRUE) {
        echo "Product inserted successfully: " . $name . "<br>";
    } else {
        echo "Error inserting product: " . $conn->error . "<br>";
    }
}

// Close database connection
$conn->close();
?>
