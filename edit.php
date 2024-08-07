<?php
session_start();
include "db_conn.php";
include "function.php";
date_default_timezone_set('UTC');
if (isset($_SESSION['username']) && isset($_SESSION['id'])) {  ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="img/logo pbl 1446 PUTIH OYEE.png" type="image/x-icon">
        <title>Edit Data</title>

        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet" />

        <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css" />

        <style>
            body {
                font-family: 'Poppins', sans-serif;
                margin: 0;
                padding: 0;
                background-color: #f2f2f2;
            }

            h2 {
                text-align: center;
                color: #333;
                font-weight: 600;
            }

            .navbar {
                border-radius: 0;
            }

            a {
                text-decoration: none;
                color: #333;
            }

            form {
                max-width: 900px;
                margin: 0 auto;
                background-color: #fff;
                padding: 20px;
                border-radius: 4px;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            }

            label {
                display: block;
                margin-bottom: 10px;
                color: #333;
            }

            input[type="text"],
            input[type="date"],
            input[type="tel"],
            input[type="number"],
            textarea {
                width: 100%;
                padding: 10px;
                border: 1px solid #ccc;
                border-radius: 4px;
                box-sizing: border-box;
                margin-bottom: 10px;
            }

            input[type="checkbox"] {
                margin-top: 5px;
            }

            input[type="submit"] {
                background-color: #4CAF50;
                color: white;
                padding: 10px 20px;
                border: none;
                border-radius: 4px;
                cursor: pointer;
                font-size: 16px;
            }

            input[type="submit"]:hover {
                background-color: #45a049;
            }

            .qrcode-button {
                background-color: transparent;
                border: none;
                cursor: pointer;
                padding: 0;
            }

            .qrcode-button img {
                width: 24px;
                height: 24px;
            }

            .qrcode-button:focus {
                outline: none;
            }

            button {
                background-color: transparent;
                border: none;
                cursor: pointer;
                padding: 0;
            }
        </style>

    </head>

    <body>
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
            <a class="navbar-brand" href="#">Penerimaan Shadaqah</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="dashboard.php">Dashboard</a>
                    </li>
                    <li class="nav-item active">
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
                    <li class="nav-item">
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

        <!-- Judul Halaman -->
        <br>
        <h2 class="text-center">Edit Data</h2><br>
        <!-- Judul Halaman -->

        <!-- Form Input Sedekah Awal -->
        <form id="inputForm" action="php/edit.php" method="POST">
            <?php
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            ?>

            <button type="submit"><i class='bx bxs-left-arrow-circle' aria-hidden="true"></i> Kembali</button><br>

            <!-- Kodetrx -->
            <br>
            <div class="form-group">
                <?php
                if (!empty($_GET['kodetrx'])) {
                    $kodetrx = $_GET['kodetrx'];

                    $query = mysqli_query($conn, "SELECT * FROM input WHERE kodetrx='" . $kodetrx . "'");
                    $data = mysqli_fetch_array($query);
                    $tanggal = $data['tanggal'];
                    $gelar1 = $data['gelar1'];
                    $nama = $data['nama'];
                    $gelar2 = $data['gelar2'];
                    $alamat = $data['alamat'];
                    $telepon = $data['telepon'];
                    $kode_kartu = $data['kode_kartu'];
                    $ambil_kartu = $data['ambil_kartu'];
                } else {
                    $kodetrx = generateRandomString(6);
                    $tanggal = null;
                    $gelar1 = null;
                    $nama = null;
                    $gelar2 = null;
                    $alamat = null;
                    $telepon = null;
                    $kode_kartu = null;
                    $ambil_kartu = null;
                }
                ?>
                <label for="kodetrx">kodetrx</label>
                <input type="text" id="kodetrx" name="kodetrx" required class="form-control" value="<?php echo $kodetrx ?>" readonly>
            </div>

            <!-- Field Nama Operator -->
            <div class="form-group">
                <label for="operator">Nama Operator</label>
                <input type="text" id="operator" name="operator" required class="form-control" value="<?php echo $data['operator']; ?>" readonly>
            </div>

            <!-- Field Tanggal -->
            <div class="form-group">
                <label for="tanggal">Tanggal</label>
                <input type="date" id="tanggal" name="tanggal" required class="form-control" value="<?php echo $data['tanggal']; ?>" readonly>
            </div>

            <!-- Field Gelar 1 (Gunakan Dropdown) -->
            <div class="form-group">
                <label for="gelar1">Gelar 1</label>
                <select id="gelar1" name="gelar1" class="form-select">
                    <option value=""></option>
                    <option value="<?= $gelar1; ?>" selected><?= $gelar1; ?></option>
                    <option value="H">H</option>
                    <option value="Hj">Hj</option>
                    <option value="KH">KH</option>
                    <option value="Dr">Dr</option>
                    <option value="dr">dr</option>
                    <option value="drs">drs</option>
                    <option value="R">R</option>
                    <option value="R.H">R.H</option>
                </select>
            </div>

            <!-- Field Nama -->
            <div class="form-group">
                <label for="nama">Nama<large class="text-danger">*</large></label>
                <input type="text" id="nama" name="nama" required class="form-control" value="<?= $nama; ?>">
            </div>

            <!-- Field Gelar 2 (Gunakan Dropdown) -->
            <div class="form-group">
                <label for="gelar2">Gelar 2</label>
                <select id="gelar2" name="gelar2" class="form-select">
                    <option value=""></option>
                    <option value="<?= $gelar2; ?>" selected><?= $gelar2; ?></option>
                    <option value="ST">ST</option>
                    <option value="SE">SE</option>
                    <option value="Alm.">Alm.</option>
                    <option value="SH">SH</option>
                    <option value="S.Ag">S.Ag</option>
                </select>
            </div>

            <!-- Field Alamat -->
            <div class="form-group">
                <label for="alamat">Alamat<large class="text-danger">*</large></label>
                <input type="text" id="alamat" name="alamat" class="form-control" required autocomplete="off" value="<?= $alamat; ?>">
                <div id="alamatSuggestions" style="border: 1px solid #ccc; display: none;"></div>
            </div>

            <!-- Field Nomor Telepon -->
            <div class="form-group">
                <label for="telepon">Nomor Telepon</label>
                <input type="tel" id="telepon" name="telepon" class="form-control" value="<?= $telepon; ?>">
            </div>

            <!-- Field Total Sumbangan (Uang) -->
            <div class="form-group">
                <label for="sumbangan_uang">Total Shadaqah (Uang)</label>
                <div class="input-group">
                    <?php
                    $sql = "SELECT * FROM input_detail WHERE kodetrx='" . $kodetrx . "'";
                    $res = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($res) > 0) {
                        $array = [];
                        while ($rows = mysqli_fetch_assoc($res)) {
                            $array[] = $rows['total_nominal'];
                        }
                        $total_nominal = array_sum($array);
                    } else {
                        $total_nominal = 0;
                    }
                    ?>
                    <div class="input-group-prepend">
                        <span class="input-group-text">Rp.</span>
                    </div>
                    <input type="text" id="sumbangan_uang" name="sumbangan_uang" required class="form-control" value="<?= number_format($total_nominal, 0, ',', '.'); ?>" readonly>
                </div>
            </div>

            <!-- Field Total Sumbangan (Barang) -->
            <div class="form-group">
                <label for="sumbangan_barang">Total Shadaqah (Barang)</label>
                <div class="input-group">
                    <?php
                    $sql = "SELECT * FROM input_detail WHERE kodetrx='" . $kodetrx . "'";
                    $res = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($res) > 0) {
                        $array = [];
                        while ($rows = mysqli_fetch_assoc($res)) {
                            $array[] = $rows['total_jumlah'];
                        }
                        $total_jumlah = array_sum($array);
                    } else {
                        $total_jumlah = 0;
                    }
                    ?>
                    <div class="input-group-append">
                    </div>
                    <input type="number" id="sumbangan_barang" name="sumbangan_barang" required class="form-control" value="<?= $total_jumlah ?>" readonly>
                    <span class="input-group-text">Satuan</span>
                </div>
            </div>

            <!-- Field Kode Kartu -->
            <div class="form-group">
                <label for="kode_kartu">Kode Kartu</label>
                <?php
                $query = "SELECT * FROM input_detail WHERE kodetrx='" . $kodetrx . "'";
                $result = mysqli_query($conn, $query);
                $array = [];
                $kode_kartu = null;
                if (mysqli_num_rows($result) > 0) {
                    while ($rows = mysqli_fetch_array($result)) {
                        $array[] = $rows['kode_kartu'];
                    };
                }
                if (in_array("B", $array)) {
                    $kode_kartu = "B";
                } else {
                    $kode_kartu = "K";
                }
                ?>
                <input type="text" id="kode_kartu" name="kode_kartu" class="form-control" value="<?= $kode_kartu; ?>" readonly>
            </div>

            <!-- Ambil Kartu -->
            <div class="form-group" id="update_form">
                <label for="ambilKartu">Ambil Kartu<large class="text-danger">*</large></label>
                <div class="input-group" id="reader"></div>
                <input id="barcode_search" placeholder="ID Kartu" name="ambil_kartu" required class="form-control" value="<?= $ambil_kartu; ?>" required>
                <!-- <div class="input-group-prepend">
                    <span class="input-group-text"><a href="#" id="check" onclick="checkBarcode(); return false;">Check</a></span>
                </div> -->
                <br><br>
                <a href="#bottom" id="start_reader" class="qrcode-button">
                    <img src="https://uxwing.com/wp-content/themes/uxwing/download/computers-mobile-hardware/qr-code-icon.png" alt="Scan QR Code">
                    Scan QR Code
                </a>
            </div> <br>
            <!-- Form Input Sedekah Akhir -->

            <!-- Tabel Detail Sumbangan Awal -->
            <form id="detailForm">

                <div class="card mt-3">
                    <div class="card-header bg-primary text-white">
                        Detail Shadaqah
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="detailSumbangan"></label>
                            <!-- Button tambah data -->
                            <a href="edit_detail.php?kodetrx=<?php echo $kodetrx; ?>&tanggal=<?php echo $tanggal; ?>" class="btn btn-success">
                                Tambah Data +
                            </a>
                        </div>
                        <?php
                        $sql = "SELECT * FROM input_detail WHERE kodetrx='" . $kodetrx . "'";
                        $res = mysqli_query($conn, $sql);
                        ?>
                        <table class="table table-bordered table-striped table-hover table-sm">
                            <tr>
                                <th>Nama Barang</th>
                                <th>Total</th>
                                <th>Keterangan</th>
                                <th>Aksi</th>
                            </tr>
                            <?php
                            while ($rows = mysqli_fetch_assoc($res)) { ?>
                                <tr>
                                    <td><?= $rows['nama_barang'] ?></td>
                                    <?php
                                    if ($rows['nama_barang'] == 'Uang') {
                                        $total = number_format($rows['total_nominal'], 0, ',', '.') . ' ' . $rows['akun'];
                                    } elseif ($rows['nama_barang'] == 'Kerbau' || $rows['nama_barang'] == 'Kambing') {
                                        $query_sub_sumbangan = "SELECT nama_sub_sumbangan FROM input_detail WHERE kodetrx_detail='" . $rows['kodetrx_detail'] . "'";
                                        $res_sub_sumbangan = mysqli_query($conn, $query_sub_sumbangan);
                                        $row_sub_sumbangan = mysqli_fetch_array($res_sub_sumbangan);
                                        $nama_sub_sumbangan = $row_sub_sumbangan['nama_sub_sumbangan'];
                                        $total = $rows['total_jumlah'] . ' - ' . $nama_sub_sumbangan;
                                    } else {
                                        $query_satuan = "SELECT satuan FROM tb_barang WHERE nama_barang='" . $rows['nama_barang'] . "'";
                                        $res_satuan = mysqli_query($conn, $query_satuan);
                                        $row_satuan = mysqli_fetch_array($res_satuan);
                                        $satuan = $row_satuan['satuan'];
                                        $total = $rows['total_jumlah'] . ' ' . $satuan;
                                    }
                                    ?>
                                    <td style="text-align: left;"><?= $total ?></td>
                                    <td><?= $rows['keterangan'] ?></td>
                                    <td>
                                        <button type="button" class="btn btn-danger delete-btn" data-kodetrx_detail="<?= $rows['kodetrx_detail'] ?>"><i class="bx bxs-trash"></i></button>
                                    </td>
                                </tr>
                            <?php } ?>
                        </table>
                    </div>
                </div>
            </form>
            <footer id="bottom"></footer>
            <br>
            <!-- Tabel Detail Sumbangan Akhir -->

            <!-- Load libraries -->
            <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
            </script>
            <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
            <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
            <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
            <script src="https://unpkg.com/html5-qrcode"></script>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


            <!-- EDIT ALAMAT -->
            <script>
                $(document).ready(function() {
                    $('#alamat').on('input', function() {
                        let keyword = $(this).val();
                        if (keyword.length >= 3) {
                            $.ajax({
                                url: 'https://alamat.thecloudalert.com/api/cari/index/?keyword=' + keyword,
                                method: 'GET',
                                success: function(data) {
                                    if (data.status === 200 && data.result.length > 0) {
                                        let suggestions = data.result;
                                        let suggestionBox = $('#alamatSuggestions');
                                        suggestionBox.empty().show();
                                        suggestions.forEach(function(suggestion) {
                                            let kelurahan = suggestion.desakel ? suggestion.desakel : 'N/A';
                                            suggestionBox.append('<div class="suggestion-item">' +
                                                kelurahan + ', ' +
                                                suggestion.kecamatan + ', ' +
                                                suggestion.kabkota + ', ' +
                                                suggestion.provinsi + ', ' +
                                                suggestion.negara + '</div>');
                                        });
                                        $('.suggestion-item').on('click', function() {
                                            $('#alamat').val($(this).text());
                                            suggestionBox.hide();
                                        });
                                    } else {
                                        $('#alamatSuggestions').hide();
                                    }
                                }
                            });
                        } else {
                            $('#alamatSuggestions').hide();
                        }
                    });
                });
            </script>

            <script>
                // Hapus data
                $(document).ready(function() {
                    $(".delete-btn").click(function() {
                        var kodetrx_detail = $(this).data("kodetrx_detail");
                        Swal.fire({
                            title: "Apakah kamu yakin?",
                            text: "Kamu tidak bisa mengembalikan data jika sudah dihapus!",
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#dc3545",
                            cancelButtonColor: "#3085d6",
                            confirmButtonText: "Hapus",
                            cancelButtonText: "Batal"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    url: 'php/hapus_data.php',
                                    method: 'POST',
                                    data: {
                                        kodetrx_detail: kodetrx_detail
                                    },
                                    success: function(response) {
                                        Swal.fire({
                                            title: "Berhasil!",
                                            text: "Data telah dihapus.",
                                            icon: "success"
                                        }).then(function() {
                                            location.reload();
                                        });
                                    }
                                });
                            }
                        });
                    });
                });

                // Update kode kartu pada table input
                $(document).ready(function() {
                    $("#update").click(function() {
                        var kodetrx = $("#kodetrx").val();
                        var operator = $("#operator").val();
                        var tanggal = $("#tanggal").val();
                        var gelar1 = $("#gelar1").val();
                        var nama = $("#nama").val();
                        var gelar2 = $("#gelar2").val();
                        var lengkap = $("#lengkap").val();
                        var telepon = $("#telepon").val();
                        var sumbangan_barang = $("#sumbangan_barang").val();
                        var sumbangan_uang = $("#sumbangan_uang").val();
                        var data = $("#data").val();
                        var kode_kartu = $("#kode_kartu").val();
                        var ambil_kartu = $("#barcode_search").val();
                        $.ajax({
                            url: 'php/edit-kode-kartu.php',
                            method: 'POST',
                            data: {
                                kodetrx: kodetrx,
                                operator: operator,
                                tanggal: tanggal,
                                gelar1: gelar1,
                                nama: nama,
                                gelar2: gelar2,
                                lengkap: lengkap,
                                telepon: telepon,
                                sumbangan_barang: sumbangan_barang,
                                sumbangan_uang: sumbangan_uang,
                                data: data,
                                kode_kartu: kode_kartu,
                                ambil_kartu: ambil_kartu
                            },
                            success: function(response) {
                                alert(response);
                            }
                        });
                    });
                });

                //select2min
                $(document).ready(function() {
                    $('.form-select').select2();
                });

                // DataTable
                $(document).ready(function() {
                    var detailTable = $('#detail-sumbangan').DataTable();

                    // Create a QR code reader instance
                    const qrReader = new Html5Qrcode("reader");

                    // QR reader settings
                    const qrConstraints = {
                        facingMode: "environment"
                    };
                    const qrConfig = {
                        fps: 10,
                        qrbox: {
                            width: 250,
                            height: 250
                        }
                    };

                    const qrCheck = (barcode) => {
                        // var barcode = document.getElementById('barcode_search').value;

                        var xhr = new XMLHttpRequest();
                        xhr.open('GET', 'php/cek-kartu.php?barcode=' + barcode, true);
                        xhr.onload = function() {
                            if (this.responseText === 'true') {
                                $("#barcode_search").val(null)
                                alert('Kartu SUDAH dipakai');
                            } else {
                                $("#barcode_search").val(barcode)
                                // alert('Kartu BELUM dipakai');
                            }
                        };
                        xhr.send();
                    }

                    const qrOnSuccess = (decodedText, decodedResult) => {
                        stopScanner(); // Stop the scanner
                        console.log(`Message: ${decodedText}, Result: ${JSON.stringify(decodedResult)}`);
                        qrCheck(decodedText);
                        // $("#barcode_search").val(decodedText); // Set the value of the barcode field
                        $("#update_form").trigger("submit"); // Submit form to backend
                    };

                    // Methods: start / stop
                    const startScanner = () => {
                        $("#reader").show();
                        $("#product_info").hide();
                        qrReader.start(
                            qrConstraints,
                            qrConfig,
                            qrOnSuccess,
                        ).catch(console.error);
                    };

                    const stopScanner = () => {
                        $("#reader").hide();
                        $("#product_info").show();
                        qrReader.stop().catch(console.error);
                    };

                    // Start scanner on button click
                    $(document).on("click", "#start_reader", function() {
                        startScanner();
                    });

                    // Submit
                    $("#update_form").on("submit", function(evt) {
                        evt.preventDefault();

                        $.ajax({
                            type: "POST",
                            url: "../my-scanner-script.php",
                            data: $(this).serialize(),
                            dataType: "json",
                            success: function(res) {
                                console.log(res);
                                if (res.status === "success") {
                                    Swal.fire({
                                        title: 'Berhasil',
                                        text: 'Data berhasil diubah',
                                        icon: 'success',
                                        timer: 1500,
                                        showCancelButton: false,
                                        showConfirmButton: false
                                    }).then(function() {
                                        startScanner();
                                    });
                                }
                            }
                        });
                    });
                });
            </script>

    </body>

    </html>

<?php
} else {
    header("Location: index.php");
}
?>