<?php
    include '../database/dbConnect.php';
    $message = "";
    $toastClass = "";

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $userName = $_POST['userName'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        $checkEmailStmt = $conn->prepare("SELECT * FROM userdata WHERE email = ?");
        $checkEmailStmt->bind_param("s", $email);
        $checkEmailStmt->execute();
        $checkEmailStmt->store_result();

        if($checkEmailStmt->num_rows > 0){
            $message = "Email ID already exists!";
            $toastClass = "#007bff"; //Primary color 
        }else{
            //Prepare and bind
            $stmt = $conn->prepare("INSERT INTO userdata (username, email, password) values (?, ?, ?)");
            $stmt->bind_param("sss", $userName, $email, $password);

            // execute

            if($stmt->execute()){
                $message = "Account created successfully!";
                $toastClass = "#28a745"; //Success color
            }else{
                $message = "Error creating account!";
                $toastClass = "#dc3545"; //Danger color
            }

            $stmt->close();

        }
        $checkEmailStmt->close();
        $conn->close();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    <link rel="shortcut icon" href="https://cdn-icons-png.flaticon.com/512/295/295128.png">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600&family=Roboto+Slab:wght@100;200;300;400;500&display=swap');

        body{
            font-family: 'Poppins', sans-serif;
        }
    </style>
    <title>Registration</title>
</head>
<body class="bg-light">
    <div class="container p-5 d-flex flex-column align-items-center">
        <?php if($message): ?>
            <div class="toast align-items-center text-white border-0" role="alert" aria-live="assertive" aria-atomic="true" style="background-color: <?php echo $toastClass?>;">
                <div class="toast-flex">
                    <div class="toast-body">
                        <?php echo $message; ?>
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        <?php endif; ?>
        <form action="" method="post" class="form-control mt-5 p-4" style="height: auto; width:380px; box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 2px 6px 2px;">
            <div class="row text-center">
                <i class="fa fa-user-circle-o fa-3x mt-1 mb-2" style="color: green;"></i>
                <h5 class="p-4" style="font-weight: 700;">Create your Account</h5>
            </div>
            <div class="mb-2">
                <label for="userName">
                    <i class="fa fa-user"></i> Username
                </label>
                <input type="text" class="form-control" id="userName" name="userName" required>
            </div>

            <div class="mb-2 mt-2">
                <label for="email">
                    <i class="fa fa-envelope"> </i> Email
                </label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>

            <div class="mb-2 mt-2">
                <label for="password">
                    <i class="fa fa-lock"> </i> Password
                </label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>

            <div class="mb-2 mt-3">
                <button type="submit" class="btn btn-success bg-success" style="font-weight: 600;">Register</button>
            </div>
            <div class="mt-4 mb-2">
                <p class="text-center" style="font-weight: 600; color: navy;">Already have an account? <a href="./login.php" style="text-decoration: none;">Login</a></p>
            </div>
        </form>
    </div>
    <script>
        let toastElementList = [].slice.call(document.querySelectorAll('.toast'));
        let toastList = toastElementList.map(function (toastEl) {
            return new bootstrap.Toast(toastEl, {delay: 3000});
        });
        toastList.forEach(toast => toast.show());
    </script>
</body>
</html>