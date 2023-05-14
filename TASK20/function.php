<?php

$conn = mysqli_connect('localhost', 'root', '', 'arkatama');

  // Ambil data
  function query($query) {
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
      $rows [] = $row;
    }
    return $rows;
  }

  $users = query("SELECT * FROM users ORDER BY role ASC");


  // Input data
  function input($data) {
    $email = htmlspecialchars($data['email']);
    $name = htmlspecialchars($data['nama']);
    $role = htmlspecialchars($data['role']);
    $phone = htmlspecialchars($data['telp']);
    $address = htmlspecialchars($data['alamat']);
    $password = htmlspecialchars($data['password']);

    // Upload gambar
    $avatar = upload();
    if (!$avatar) {
      return false;
    }

    global $conn;
    $query = "INSERT INTO users (email, name, role, avatar, phone, address, password)
              VALUES ('$email', '$name', '$role', '$avatar', '$phone', '$address', '$password')";

    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
  }

  function upload() {
    $namaFile = $_FILES['img']['name'];
    $ukuranFle = $_FILES['img']['size'];
    $error = $_FILES['img']['error'];
    $tempName = $_FILES['img']['tmp_name'];

    // Cek tipe gambar
    $fileAcc = ['jpg', 'jpeg', 'png'];
    $fileType = explode('.', $namaFile);
    $fileType = strtolower(end($fileType));
    if (!in_array($fileType, $fileAcc)) {
      echo "<script>
            alert('Yang anda masukkan bukan gambar');
            </script>";
      return false;
    }

    // Cek ukuran file
    if ($ukuranFle > 2000000) {
      echo "<script>
            alert('Ukuran gambar terlalu besar');
            </script>";
      return false;
    }

    // Buat nama baru
    // $namaFileNew = uniqid();
    // $namaFileNew .= '.';
    // $namaFileNew .= $fileType;

    // Upload
    move_uploaded_file($tempName, ''.$namaFile);
    return $namaFile;
  }

  function edit($data) {
    $id = $_GET['userId'];
    $email = htmlspecialchars($data['email']);
    $name = htmlspecialchars($data['nama']);
    $role = isset($data['role']) ? $data['role'] : 'staff';
    $phone = htmlspecialchars($data['telp']);
    $address = htmlspecialchars($data['alamat']);
    $password = htmlspecialchars($data['password']);

    $avatar = upload();
    if (!$avatar) {
      return false;
    }

    global $conn;
    $query = "UPDATE users SET
              email = '$email',
              name = '$name',
              role = '$role',
              avatar = '$avatar',
              phone = '$phone',
              address = '$address',
              password = '$password'
              WHERE id = $id";
    
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
  }

  function hapus($id) {
    global $conn;
    mysqli_query($conn, "DELETE FROM users WHERE id=$id");
    return mysqli_affected_rows($conn);
  }

?>