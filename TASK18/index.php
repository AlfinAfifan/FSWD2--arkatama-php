<?php
  $conn = mysqli_connect('localhost', 'root', '', 'arkatama');

  // Query ambil data
  function query($query) {
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
      $rows [] = $row;
    }
    return $rows;
  }

  $products = query("SELECT products.id ,products.name AS product_name, products.description, products.price, products.status, categories.name as category
                      FROM products
                      JOIN categories ON products.category_id=categories.id
                      ORDER BY products.id");

  // Query tambah data
  function tambah($data) {
    $name = htmlspecialchars($data["nama"]);
    $price = htmlspecialchars($data["harga"]);
    $status = htmlspecialchars($data["gridRadios"]);
    $category_id = htmlspecialchars($data["kategori"]);
    $description = htmlspecialchars($data["description"]);
    $created_by = 1;

    global $conn;
    $query = "INSERT INTO products (category_id, name, description, price, status, created_by)
              VALUES ('$category_id', '$name', '$description', '$price', '$status', '$created_by')";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
  }

  // Cek tombol simpan
  if (isset($_POST["simpan"])) {
    if(tambah($_POST) > 0) {
      echo "
        <script>
          alert('Data berhasil ditambahkan');
          document.location.href = 'index.php';
        </script>
        ";
    } else {
      echo "
        <script>
          alert('Tidak ada data yang ditambahkan');
          document.location.href = 'index.php';
        </script>
      ";
    }
  }

  // Tampilkan pilihan kategori
  $categories = query("SELECT * FROM categories");

  // Query tambah kategori
  function tambahKategori($data) {
    $namaKategori = htmlspecialchars($data["namaKategori"]);
    $create = htmlspecialchars($data["createdAt"]);
    $update = htmlspecialchars($data["updatedAt"]);

    global $conn;
    $query = "INSERT INTO categories (name, created_at, updated_at)
               VALUES ('$namaKategori', '$create', '$update')";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
  }

  // Cek tombol simpan kategori
  if (isset($_POST["simpanKategori"])) {
    if (tambahKategori($_POST) > 0) {
      echo "
        <script>
          alert('Data berhasil ditambahkan');
          document.location.href = 'index.php';
        </script>
        ";
    } else {
      echo "
        <script>
          alert('Tidak ada data yang ditambahkan');
          document.location.href = 'index.php';
        </script>
      ";
    }
  }
  
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>PHP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous" />
  </head>
  <body style="background-color: #ededf5;">
    <!-- Input Produk -->
    <div class="container ">
      <form class="p-3 my-4" action="" method="post" id="form" style="background-color: white; border-radius: 25px;">
        <div class="h4 mb-3">Input Produk</div>
        <div class="row mb-3">
          <label for="inputNama" class="col-sm-2 col-form-label">Nama Produk</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="inputNama" name="nama" autocomplete="off"  required/>
          </div>
        </div>
        <div class="row mb-3">
          <label for="inputHarga" class="col-sm-2 col-form-label">Harga</label>
          <div class="col-sm-10">
            <input type="number" class="form-control" id="inputHarga" name="harga" autocomplete="off"  required/>
          </div>
        </div>
        <fieldset class="row mb-3">
          <legend class="col-form-label col-sm-2 pt-0">Status</legend>
          <div class="col-sm-10">
            <div class="form-check">
              <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="waiting" checked />
              <label class="form-check-label" for="gridRadios1"> Waiting </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="accepted" />
              <label class="form-check-label" for="gridRadios2"> Accepted </label>
            </div>
            <div class="form-check disabled">
              <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios3" value="rejected" />
              <label class="form-check-label" for="gridRadios3"> Rejected </label>
            </div>
          </div>
        </fieldset>
        <div class="row-mb-3">
          <label class="col-sm-2" for="inlineFormCustomSelect">Kategori</label>
          <select class="custom-select col-sm-2" id="inlineFormCustomSelect" name="kategori" required>
            <option value="">Pilih kategori</option>
            <?php foreach ($categories as $category) : ?>
            <option value="1"><?= $category['name']; ?></option>
            <?php endforeach ?>
          </select>
        </div>
        <div class="row my-3">
          <label for="inputNama" class="col-sm-2 col-form-label">Deskripsi</label>
          <div class="col-sm-10">
            <textarea class="form-control" name="description" required></textarea>
          </div>
            </div>
        <button type="submit" class="btn btn-primary col-sm-12" name="simpan">Simpan</button>
      </form>
      <!-- End Input Produk -->

      <!-- Tambah kategori -->
      <form class="p-3" action="" method="post" id="form" style="background-color: white; border-radius: 25px;">
        <div class="h4 mb-3">Tambah Kategori</div>
        <div class="row mb-3">
          <label for="inputNama" class="col-sm-2 col-form-label">Jenis Kategori</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="inputNama" name="namaKategori" autocomplete="off"  required/>
          </div>
        </div>
        <div class="row mb-3">
          <label for="inputHarga" class="col-sm-2 col-form-label">Created At</label>
          <div class="col-sm-10">
            <input type="date" class="form-control" id="inputHarga" name="createdAt" autocomplete="off"  required/>
          </div>
        </div>
        <div class="row mb-3">
          <label for="inputHarga" class="col-sm-2 col-form-label">Updated At</label>
          <div class="col-sm-10">
            <input type="date" class="form-control" id="inputHarga" name="updatedAt" autocomplete="off"  required/>
          </div>
        </div>
        <button type="submit" class="btn btn-primary col-sm-12" name="simpanKategori">Simpan</button>
      </form>
      <!-- End input kategori -->

      <!-- Tampilkan data -->
      <table class="table table-striped my-4" style="background-color: white; border-radius: 25px;">
        <thead>
          <tr>
            <th class="h4" style="border: 0;">Daftar Barang</th>
          </tr>
          <tr>
            <th scope="col">No</th>
            <th scope="col">Kategori</th>
            <th scope="col">Produk</th>
            <th scope="col">Harga</th>
            <th scope="col">Status</th>
            <th scope="col" class="w-50">Deskripsi</th>
          </tr>
        </thead>
        <tbody>
          <?php $i = 1 ?>
          <?php foreach($products as $product) : ?>
          <tr>
            <th scope="row"><?= $i++ ?></th>
            <td><?= $product['category']; ?></td>
            <td><?= $product['product_name']; ?></td>
            <td><?= $product['price']; ?></td>
            <td><?= $product['status']; ?></td>
            <td><?= $product['description']; ?></td>
          </tr>
          <?php endforeach ?>
        </tbody>
      </table>
      <!-- End tampilkan data -->
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  </body>
  </html>
