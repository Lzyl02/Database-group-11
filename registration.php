<?php
    include("connection.php");

    if(isset($_POST['submit'])){
        $staff_id = $_POST['staff_id'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $position = $_POST['position'];
        $hired_date = $_POST['hired_date'];
        $email = $_POST['email'];
        $phone_number = $_POST['phone_number'];

        //check if passord match
        if($password != $confirm_password){
            echo "Password do not match";
            echo "<script>
                      window.location.href = 'Registration page.html';
                      alert('Password do not match');
                 </script>";
        }
        
        // check if staff_ID already exists
        $sql = "SELECT * FROM `staffaccounts` WHERE `staff_ID` = '$staff_id'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            echo "Error: Username already exists.";
            echo "<script>
                    window.location.href = 'Registration page.html';
                    alert('Error: Staff ID already exists.');
                </script>";
            mysqli_close($conn);
            exit();
        }
        
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $count = mysqli_num_rows($result);

        //insert data into database
        $sql = "INSERT INTO `staffaccounts` (`staff_ID`,`password`,`f_name`,`l_name`,`position`,`hire_date`,`email_address`,`phone_number`) VALUES ('$staff_id','$password','$first_name','$last_name','$position','$hired_date','$email','$phone_number')";
        
        if (mysqli_query($conn, $sql)) {
            echo "Registration successful!";
            echo "<script>
                    window.location.href = 'Login_page.html';
                    alert('Staff account registered successfully!');
                </script>";
        } else {
            echo "<script>
                      window.location.href = 'Registration page.html';
                      alert('An error have occured. Staff account not registered successfully');
                 </script>";
        }

    }
?>
