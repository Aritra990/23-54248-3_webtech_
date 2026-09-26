<?php
$host = "localhost";
$user = "root";
$password = "";
$dbName = "restaurant_management_db";

// Connect to MySQL
$conn = mysqli_connect($host, $user, $password);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Create database if it doesn't exist
$sql = "CREATE DATABASE IF NOT EXISTS $dbName";
if ($conn->query($sql) !== TRUE) {
    die("Error creating database: " . $conn->error);
}

// Select the database
mysqli_select_db($conn, $dbName);


// CREATE employees TABLE

$employeeTable = "CREATE TABLE IF NOT EXISTS employees (
    employee_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100) NOT NULL,
    gender ENUM('Male','Female','Other') NOT NULL,
    date_of_birth DATE NOT NULL,
    role VARCHAR(50) NOT NULL,
    department VARCHAR(50) NOT NULL,
    qualification VARCHAR(100),
    phone VARCHAR(15),
    email VARCHAR(100) UNIQUE,
    address TEXT,
    salary DECIMAL(10,2) NOT NULL,
    joining_date DATE NOT NULL,
    status ENUM('Active','Inactive') DEFAULT 'Active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if ($conn->query($employeeTable) !== TRUE) {
    die("Error creating employees table: " . $conn->error);
}


// CREATE reservations TABLE

$reservationTable = "CREATE TABLE IF NOT EXISTS reservations (
    reservation_id INT AUTO_INCREMENT PRIMARY KEY,
    customer_name VARCHAR(100) NOT NULL,
    email VARCHAR(100),
    phone VARCHAR(20) NOT NULL,
    reservation_date DATE NOT NULL,
    reservation_time TIME NOT NULL,
    number_of_guests INT NOT NULL,
    table_number INT,
    special_request TEXT,
    status ENUM('Pending', 'Confirmed', 'Cancelled') DEFAULT 'Pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if ($conn->query($reservationTable) !== TRUE) {
    die("Error creating reservations table: " . $conn->error);
}


// INSERT DATA INTO employees

$insertEmployees = "INSERT IGNORE INTO employees
(full_name, gender, date_of_birth, role, department, qualification, phone, email, address, salary, joining_date)
VALUES
('Rahim Uddin', 'Male', '1990-05-12', 'Manager', 'Management', 'BBA', '01711111111', 'rahim@example.com', 'Dhaka', 50000, '2020-01-10'),
('Karima Begum', 'Female', '1988-09-25', 'Chef', 'Kitchen', 'Diploma in Culinary Arts', '01822222222', 'karima@example.com', 'Khulna', 40000, '2021-03-15'),
('Hasan Mahmud', 'Male', '1995-07-18', 'Waiter', 'Service', 'HSC', '01933333333', 'hasan@example.com', 'Chittagong', 25000, '2022-06-01'),
('Nusrat Jahan', 'Female', '1992-11-05', 'Cashier', 'Accounts', 'BBA', '01644444444', 'nusrat@example.com', 'Dhaka', 30000, '2019-09-20')
";

$conn->query($insertEmployees);


// INSERT DATA INTO reservations

$insertReservations = "INSERT INTO reservations
(customer_name, email, phone, reservation_date, reservation_time, number_of_guests, table_number, special_request, status)
VALUES
('Asif Mahmud', 'asif@example.com', '01700000000', '2026-08-22', '19:00:00', 4, 5, 'Window seat', 'Confirmed'),
('Sadia Islam', 'sadia@example.com', '01800000000', '2026-08-23', '20:00:00', 2, 3, 'Birthday decoration', 'Pending'),
('Tanvir Hasan', 'tanvir@example.com', '01900000000', '2026-08-24', '18:30:00', 6, 8, 'Family dinner', 'Confirmed'),
('Mim Akter', 'mim@example.com', '01600000000', '2026-08-25', '19:30:00', 3, 4, 'No special request', 'Pending')
";

$conn->query($insertReservations);

echo "Restaurant database, tables, and sample data created successfully!";
?>