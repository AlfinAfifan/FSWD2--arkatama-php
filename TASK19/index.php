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

  // Edit
  if (isset($_GET['hal']) == 'edit') {
    $id = $_GET['userId'];
    $dataEdit = query("SELECT * FROM users WHERE id = $id") [0];
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

  // Hapus
  if (isset($_GET['hal'])) {
    if ($_GET['hal'] == "hapus") {
      $id = $_GET['userId'];
      if( hapus($id) > 0 ) {
        echo "
            <script>
                alert('Data Berhasil Dihapus');
                document.location.href = 'index.php';
            </script>
            ";
        } else {
            echo "
            <script>
                alert('Data Gagal Dihapus');
                document.location.href = 'index.php';
            </script>
            ";
        }
    }
  }

  function hapus($id) {
    global $conn;
    mysqli_query($conn, "DELETE FROM users WHERE id=$id");
    return mysqli_affected_rows($conn);
  }



  // Cek tombol simpan
  if (isset($_POST["simpan"])) {
    if ($_GET['hal'] == "edit") {
      if (edit($_POST) > 0) {
        echo "
          <script>
              alert('Data Berhasil Diedit');
              document.location.href = 'index.php';
          </script>
          ";
      } else {
          echo "
          <script>
              alert('Data Gagal Diedit');
              document.location.href = 'index.php';
          </script>
          ";
      }
    } else {
      if( input($_POST) > 0 ) {
        echo "
        <script>
            alert('Data Berhasil Ditambahkan');
            document.location.href = 'index.php';
        </script>
        ";
      } else {
        echo "
        <script>
            alert('Data Gagal Ditambahkan');
            document.location.href = 'index.php';
        </script>
        ";
      }
    }
  }

?>







<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Data User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
  </head>
  <body style="background-color: #d3d3d3">
    <div class="container py-3">
      <!-- Edit & input data -->
      <form class="row g-3 p-4 pt-0 my-4" style="background-color: white; border-radius: 25px" action="" method="post" enctype="multipart/form-data">
        <div class="h4">Tambah / Edit User</div>
        <div class="col-md-6">
          <label for="inputNama4" class="form-label">Nama</label>
          <input type="text" class="form-control" id="inputNama4" name="nama" value="<?= @$dataEdit['name']; ?>" required/>
        </div>
        <div class="col-md-6">
          <label for="inputNama4" class="form-label">Telp</label>
          <input type="number" class="form-control" id="inputNama4" name="telp" value="<?= @$dataEdit['phone']; ?>" required/>
        </div>
        <div class="col-md-6">
          <label for="inputEmail4" class="form-label">Email</label>
          <input type="email" class="form-control" id="inputEmail4" name="email" value="<?= @$dataEdit['email']; ?>" required/>
        </div>
        <div class="col-md-6">
        <label for="inputPassword4" class="form-label">Password</label>
        <div  iv class="input-group mb-3">
          <input type="password" class="form-control" id="inputPassword4" name="password" value="<?= @$dataEdit['password']; ?>" required/>
          <span class="input-group-text bg-primary inputPassword" style="cursor: pointer;"><i class="bi bi-eye-slash"></i></span>
          </div>
        </div>
        <div class="col-md-12">
          <label for="inputAlamat" class="form-label">Alamat</label>
          <textarea class="form-control" id="inputAlamat" name="alamat" required/><?= @$dataEdit['address']; ?></textarea>
        </div>
        <div class="col-md-6">
          <label for="role" class="form-label">Role User</label>
          <select class="form-select" aria-label="Default select example" id="role" name="role" required>
          <option value="">Pilih role</option>
          <option value="admin">admin</option>
          <option value="staff">staff</option>
  </select>
        </div>
        <div class="col-md-6">
          <label for="img" class="form-label">Upload Foto</label>
          <input type="file" class="form-control" id="img" name="img" required/>
        </div>
        <div class="col-md-12">
          <button type="submit" class="btn btn-primary col-12" name="simpan">Simpan</button>
        </div>
      </form>
      <!-- End input -->

      <!-- Tampil data -->
      <div class="row p-4 mb-4" style="background-color: white; border-radius: 25px">
        <div class="h4">Daftar User</div>
        <table class="table table-striped col">
          <thead>
            <tr>
              <th scope="col">No</th>
              <th scope="col">Foto</th>
              <th scope="col">Nama</th>
              <th scope="col">Alamat</th>
              <th scope="col">Email</th>
              <th scope="col">Role</th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php $i = 1 ?>
            <?php foreach ($users as $user) : ?>
            <tr>
              <th><?= $i++ ?></th>
              <td><img src="<?= $user['avatar']; ?>" width="75" height="75"></td>
              <td><?= $user['name']; ?></td>
              <td><?= $user['address']; ?></td>
              <td><?= $user['email']; ?></td>
              <td><?= $user['role']; ?></td>
              <td>
                <a href="index.php?hal=edit&userId=<?= $user['id'] ?>" type="button" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i></a>
                <a href="index.php?hal=hapus&userId=<?= $user['id']  ?>" onclick="return confirm('Apakah anda ingin menghapus data user dengan nama <?= $user['name'] ?>?');" type="button" class="btn btn-danger btn-sm"><i class="bi bi-trash3"></i></a>
              </td>
            </tr>
            <?php endforeach ?>
          </tbody>
        </table>
      </div>
      <!-- End tampil data -->
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script>
      const pwd = document.querySelector(".inputPassword");
      const inputPwd = document.getElementById('inputPassword4');
      console.log(inputPwd);
      pwd.addEventListener('click', function() {
        pwd.classList.toggle('bg-white');
        inputPwd.type = inputPwd.type === 'password' ? 'text' : 'password';
      })
    </script>
  </body>
</html>
