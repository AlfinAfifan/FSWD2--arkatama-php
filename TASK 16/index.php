<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous" />
    <link rel="stylesheet" href="style.css" />
  </head>
  <body>
    <div class="container-fluid bg">
      <div class="col-md-3 card p-3 card-bg text-center">
        <img src="img/foto.png" alt="" width="200" />
        <div class="card-body">
          <h3 class="card-title fw-bold"><u>Alfin 'Afifan</u></h3>
          <p class="card-text">Saya adalah mahasiswa semester 6 di Universitas Merdeka Malang dengan program studi Sistem Informasi yang saat ini sedang mengikuti program Studi Independen Bersertifikat di Arkatama.</p>
          <a href="#" class="btn btn-primary modal-detail-button mt-3" data-bs-toggle="modal" data-bs-target="#modal"">Profil Saya</a>
        </div>
      </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="movieModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
          <div class="modal-header bg-success">
            <h1 class="modal-title fs-5" id="movieModalLabel">Profil Saya</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body d-flex">
            <img src="img/pasfoto.jpg" alt="" width="250">
            <ul class="list-group">
              <li class="list-group-item"><strong>Nama :</strong> Agus Alfin 'Afifan Mahfudh</li>
              <li class="list-group-item"><strong>Tempat Tanggal Lahir : </strong>Trenggalek, 20 Agustus 2001</li>
              <li class="list-group-item"><strong>Jenis Kelamin : </strong>Laki-Laki</li>
              <li class="list-group-item"><strong>Alamat : </strong>RT 021 / RW 008, Desa Durenan, Kecamatan Durenan, Kabupaten Trenggalek, Provinsi Jawa Timur</li>
              <li class="list-group-item"><strong>Hobi : </strong>Game, Traveling, Ngoding</li>
              <li class="list-group-item"><strong>Riwayat Pendidikan : </strong><br>
                <ul>
                  <li>2014-2017 --> SMP ISLAM GANDUSARI</li>
                  <li>2017-2020 --> SMK QUEEN AL FALAH</li>
                  <li>2020-Sekarang --> UNIVERSITAS MERDEKA MALANG</li>
                </ul>
              </li>
              
            </ul>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  </body>
</html>
