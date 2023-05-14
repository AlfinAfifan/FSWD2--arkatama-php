<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sudah Login</title>
</head>
<body>

    <script>
        let konfir = confirm("Anda sudah login. Apakah anda ingin logout?");
        if (konfir == true) {
            location.href = "logout.php";
        } else {
            location.href = "index.php";
        }
    
    </script>
</body>
</html>