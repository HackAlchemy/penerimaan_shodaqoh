<?php 
   session_start();
   include "db_conn.php";
   if (isset($_SESSION['username']) && isset($_SESSION['id'])) {   ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/logo.png" type="image/x-icon">
    <title>Dashboard</title>
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</head>

<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f2f2f2;
    }
    .navbar {
        border-radius: 0;
    }
</style>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
        <a class="navbar-brand" href="#">Penerimaan Shodaqoh</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="dashboard.php">Dashboard <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="input.php">Input Sedekah</a>
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

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div id="you-qr-result"></div>
                <h1 class="text-center">Scan QR Code</h1>
                <div id="my-qr-reader"></div>
            </div>
        </div>
    </div>

    <!-- LOAD LIBRARIES -->
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/html5-qrcode"></script>
    <script src="/assets/script.js"></script>

    <script>
        // CHECK IF DOM IS READY
        function domReady(fn) {
            if(document.readyState === "complete" || document.readyState === "interactive") {
                setTimeout(fn, 1);
            } else {
                document.addEventListener("DOMContentLoaded", fn);
            }
        }

        // START QR CODE SCANNER.
        domReady(function() {
            var myqr = document.getElementById("you-qr-result");
            var lastResult, countResults = 0;

            // IF FOUND YOUR QR CODE
            function onScanSuccess(decodeText, decodeResult) {
                if (decodeText !== lastResult) {
                    ++countResults;
                    lastResult = decodeText;

                    // ALERT YOUR QR CODE
                    alert("Your QR Code is: " + decodeText,decodeResult);
                    myqr.innerHTML = "You scan " + countResults + " : " + decodeText;
                }
            }

            // AND LAST RENDER YOUR CAMERA QR
            var htmlscanner = new Html5QrcodeScanner(
                "my-qr-reader", { fps: 10, qrbox: 250 });
            
            htmlscanner.render(onScanSuccess);

            // ADD ACTIVE CLASS TO CURRENT PAGE
            var currentPath = window.location.pathname;
            var navLinks = document.querySelectorAll(".nav-link");
            navLinks.forEach(function(link) {
                if (link.getAttribute("href") === currentPath) {
                    link.parentElement.classList.add("active");
                }
            });
        });

    </script>
</body>
</html>

<?php }else{
	header("Location: index.php");
} ?>