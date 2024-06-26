<?php
session_start();
include "db_conn.php";
if (isset($_SESSION['username']) && isset($_SESSION['id'])) { ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="shortcut icon" href="img/logo pbl 1446 PUTIH OYEE.png" type="image/x-icon">
        <title>USERS</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

        <link rel="stylesheet" href="https://cdn.datatables.net/2.0.1/css/dataTables.dataTables.css" />

        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet" />

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

        <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

        <style>
            body {
                font-family: 'Poppins', sans-serif;
                background-color: #f2f2f2;
                margin: 0;
                padding: 0;
            }

            h1 {
                text-align: center;
                color: #333;
            }

            .navbar {
                border-radius: 0;
            }

            .container {
                margin-top: 0px;
                margin-bottom: 20px;
            }

            .card {
                margin-bottom: 70px;
                align-items: center;
                justify-content: center;
            }

            .table {
                margin-top: 0px;
            }
        </style>

    </head>

    <body>

        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top" data-aos="fade-down">
            <a class="navbar-brand" href="#">Penerimaan Shadaqah</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="dashboard.php">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="form.php">Input Sedekah</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Laporan
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="cetak-kartu.php">Kartu</a>
                            <a class="dropdown-item" href="cetak-sumbangan.php">Shadaqah</a>
                            <a class="dropdown-item" href="cetak-rician.php">Rician Shadaqah</a>
                        </div>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="users.php">Users</a>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="btn btn-danger" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </nav>
        <br>
        <!-- End Navbar -->

        <br>
        <h1 data-aos="fade-up">Halaman Akun</h1>

        <!-- ISI KONTEN -->
        <div class="container d-flex justify-content-center">
            <?php if ($_SESSION['role'] == 'admin') { ?>

                <!-- FOR ADMIN -->
                <div class="row" data-aos="fade-up">
                    <div class="col d-flex justify-content-center">
                        <div class="card text-center" style="width: 18rem; margin: 0 auto;" data-aos="zoom-in">
                            <img src="img/user.png" class="card-img-top" alt="admin image">
                            <div class="card-body">
                                <h5 class="card-title"><?= $_SESSION['name'] ?></h5>
                            </div>
                        </div>
                    </div>
                    <?php include 'php/members.php';
                    if (mysqli_num_rows($res) > 0) { ?>
                        <div class="container my-5" data-aos="fade-up">
                            <div class="card-body">
                                <table class="table table-bordered table-striped table-hover table-sm">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Nama</th>
                                            <th scope="col">Username</th>
                                            <th scope="col" style="width: 150px;">Admin</th>
                                            <th scope="col" style="width: 150px;">Akses</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        while ($rows = mysqli_fetch_assoc($res)) { ?>
                                            <tr data-aos="fade-up">
                                                <th scope="row"><?= $i ?></th>
                                                <td><?= $rows['name'] ?></td>
                                                <td><?= $rows['username'] ?></td>
                                                <td>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" role="switch" id="admin-<?= $rows['id'] ?>" name="admin" <?php echo $rows['role'] == 'admin' ? 'checked' : '' ?> onclick="updateRole(<?= $rows['id'] ?>)">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" role="switch" id="akses-<?= $rows['id'] ?>" name="akses" <?php echo $rows['akses'] == 1 ? 'checked' : '' ?> onclick="updateAkses(<?= $rows['id'] ?>)">
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php $i++;
                                        } ?>
                                    </tbody>
                                </table>
                            <?php } ?>
                            </div>
                        </div>
                    <?php } else { ?>


                        <!-- FOR USERS -->
                        <div class="card text-center" style="width: 18rem;" data-aos="zoom-in">
                            <img src="img/user.png" class="card-img-top" alt="user image">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <?= $_SESSION['name'] ?>
                                </h5>
                            </div>
                        </div>
                    <?php } ?>

                    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
                    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
                    <script src="https://cdn.datatables.net/2.0.1/js/dataTables.js"></script>
                    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
                    <script src="sweetalert2.all.min.js"></script>
                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

                    <script>
                        $(document).ready(function() {
                            var detailTable = $('#users').DataTable();
                            AOS.init(); // Initialize AOS
                        });

                        function updateAkses(id) {
                            $.ajax({
                                type: 'GET',
                                url: 'php/edit-akses.php',
                                data: 'id=' + id,
                                success: function(response) {
                                    if (response == 1) {
                                        Swal.fire({
                                            title: "Berhasil!",
                                            text: "Akses telah diupdate!",
                                            icon: "success"
                                        })
                                    }
                                }
                            });
                        }

                        function updateRole(id) {
                            $.ajax({
                                type: 'GET',
                                url: 'php/edit-role.php',
                                data: 'id=' + id,
                                success: function(response) {
                                    if (response == 1) {
                                        Swal.fire({
                                            title: "Berhasil!",
                                            text: "Role telah diupdate!",
                                            icon: "success"
                                        })
                                    }
                                }
                            });
                        }
                    </script>
    </body>

    </html>
<?php } else {
    header("Location: index.php");
} ?>