<?php
$servername = "localhost"; // Host
$username = "root";        // Database username
$password = '';            // Database password
$dbname = "kavya";         // Database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Checks if form is submitted
if (isset($_POST['fullName'])) {
    $user = $_POST['fullName'];
    $dob = $_POST['dob'];
    $gender = isset($_POST['gender']) ? $_POST['gender'] : '';
    // $gender = $_POST['gender'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $shift = isset($_POST['shift']) && is_array($_POST['shift']) ? implode(", ", $_POST['shift']) : '';
    // $shift = implode(", ", $_POST['shift']);
    $roles = implode(", ", $_POST['roles']);
    $daysAvailable = $_POST['daysAvailable'];
    $experience = $_POST['experience'];
    $otherRole = isset($_POST['otherRole']) ? $_POST['otherRole'] : '';

    
    $sql = "INSERT INTO register (name, dob, gender, phone, email, address, shift, roles, daysAvailable, experience, otherRole)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    
    if ($stmt = $conn->prepare($sql)) {
        // Bind parameters (s = string, i = integer, etc.)
        $stmt->bind_param("sssssssssss", $user, $dob, $gender, $phone, $email, $address, $shift, $roles, $daysAvailable, $experience, $otherRole);

        
        if ($stmt->execute()) {
            // Success message and display submitted data
            echo "
            <div style='background-color: #d4edda; color: #155724;
             padding: 20px; text-align: center; border: 1px solid #c3e6cb; border-radius: 8px; font-family: Arial, sans-serif;'>
                <h2>Registration Successful!</h2>
                <p>Thank you, <strong>" . htmlspecialchars($user) . "</strong>! Your registration has been successfully submitted.</p>
                <h3>Submitted Details:</h3>
                <table style='margin: 20px auto; border: 1px solidrgb(33, 42, 38); border-collapse: collapse; width: 80%;'>
                    <tr>
                        <td style='padding: 10px; border: 1px solid #d1e7dd;'><strong>Full Name</strong></td>
                        <td style='padding: 10px; border: 1px solid #d1e7dd;'>" . htmlspecialchars($user) . "</td>
                    </tr>
                    <tr>
                        <td style='padding: 10px; border: 1px solid #d1e7dd;'><strong>Date of Birth</strong></td>
                        <td style='padding: 10px; border: 1px solid #d1e7dd;'>" . htmlspecialchars($dob) . "</td>
                    </tr>
                    <tr>
                        <td style='padding: 10px; border: 1px solid #d1e7dd;'><strong>Gender</strong></td>
                        <td style='padding: 10px; border: 1px solid #d1e7dd;'>" . htmlspecialchars($gender) . "</td>
                    </tr>
                    <tr>
                        <td style='padding: 10px; border: 1px solid #d1e7dd;'><strong>Phone</strong></td>
                        <td style='padding: 10px; border: 1px solid #d1e7dd;'>" . htmlspecialchars($phone) . "</td>
                    </tr>
                    <tr>
                        <td style='padding: 10px; border: 1px solid #d1e7dd;'><strong>Email</strong></td>
                        <td style='padding: 10px; border: 1px solid #d1e7dd;'>" . htmlspecialchars($email) . "</td>
                    </tr>
                    <tr>
                        <td style='padding: 10px; border: 1px solid #d1e7dd;'><strong>Address</strong></td>
                        <td style='padding: 10px; border: 1px solid #d1e7dd;'>" . htmlspecialchars($address) . "</td>
                    </tr>
                    <tr>
                        <td style='padding: 10px; border: 1px solid #d1e7dd;'><strong>Shifts</strong></td>
                        <td style='padding: 10px; border: 1px solid #d1e7dd;'>" . htmlspecialchars($shift) . "</td>
                    </tr>
                    <tr>
                        <td style='padding: 10px; border: 1px solid #d1e7dd;'><strong>Roles</strong></td>
                        <td style='padding: 10px; border: 1px solid #d1e7dd;'>" . htmlspecialchars($roles) . "</td>
                    </tr>
                    <tr>
                        <td style='padding: 10px; border: 1px solid #d1e7dd;'><strong>Days Available</strong></td>
                        <td style='padding: 10px; border: 1px solid #d1e7dd;'>" . htmlspecialchars($daysAvailable) . "</td>
                    </tr>
                    <tr>
                        <td style='padding: 10px; border: 1px solid #d1e7dd;'><strong>Experience</strong></td>
                        <td style='padding: 10px; border: 1px solid #d1e7dd;'>" . htmlspecialchars($experience) . "</td>
                    </tr>
                    <tr>
                        <td style='padding: 10px; border: 1px solid #d1e7dd;'><strong>Other Role</strong></td>
                        <td style='padding: 10px; border: 1px solid #d1e7dd;'>" . htmlspecialchars($otherRole) . "</td>
                    </tr>
                </table>
            </div>";
        } 
        else
        {
            echo"<div style='background-color: #f8d7da; color: #721c24; padding: 20px; text-align: center; border: 1px solid #f5c6cb; border-radius: 8px; font-family: Arial, sans-serif;'>(Please fill in all required fields!)";
        }
            /*else {
            echo "<div style='background-color: #f8d7da; color: #721c24; padding: 20px; text-align: center; border: 1px solid #f5c6cb; border-radius: 8px; font-family: Arial, sans-serif;'>
                Error: " . $stmt->error . "
            </div>";
        }*/

        // Close statement
        $stmt->close();
    } /*else {
        echo "<div style='background-color: #f8d7da; color: #721c24; padding: 20px; text-align: center; border: 1px solid #f5c6cb; border-radius: 8px; font-family: Arial, sans-serif;'>
                Error preparing statement: " . $conn->error . "
            </div>";
    }*/

    // Close connection
    $conn->close();
}
?>
