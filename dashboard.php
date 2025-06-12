<?php
session_start();

// Redirect ke login jika belum login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
   
}

if (!isset($_SESSION["counter"])) {
    $_SESSION["counter"] = 1;
} else {
    $_SESSION["counter"]++;
}

if (!isset($_SESSION["daftar"])) {
    $_SESSION["daftar"] = [];
}

if (isset($_POST["nama"]) && isset($_POST["umur"])) {
    $daftar = [
        "nama" => $_POST["nama"],
        "umur" => $_POST["umur"]
    ];

    $_SESSION["daftar"][] = $daftar;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <style type="text/css">
        body {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-size: cover;
            background-image: url("https://cdn.arstechnica.net/wp-content/uploads/2023/06/bliss-update-1440x960.jpg");
        }

        table {
            background-color: white;
            border: 3px solid grey;
            padding: 20px;
            border-radius: 10px;
            font-family: Arial, Helvetica, sans-serif;
        }

        td {
            padding: 5px;
        }

        button {
            background-color: greenyellow;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer; 
        }

        #logout {
            background-color: rgb(236, 80, 80);
        }
    </style>
</head>
<body>
    <h1><?php echo "Selamat datang " . $_SESSION['username'] . " Ke-" . $_SESSION["counter"]; ?></h1>

    <form action="dashboard.php" method="post">
        <table>
            <tr>
                <td colspan="2" style="text-align: center;">DAFTAR</td>
            </tr>
            <tr>
                <td>Nama</td>
                <td><input type="text" name="nama" required /></td>
            </tr>
            <tr>
                <td>Umur</td>
                <td><input type="number" name="umur" required /></td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: center;">
                    <button type="submit">SUBMIT</button>
                    <a href="logout.php">
                        <button id="logout" type="button">LOGOUT</button>
                    </a>
                </td>
            </tr>
        </table>
    </form>

    <table border="1">
        <tr>
            <th>Nama</th>
            <th>Umur</th>
            <th>Keterangan</th>
        </tr>
        <?php foreach ($_SESSION["daftar"] as $daftar_item): ?>
            <tr>
                <td><?php echo $daftar_item["nama"]; ?></td>
                <td><?php echo $daftar_item["umur"]; ?></td>
                <td>
                    <?php
                    if ($daftar_item["umur"] < 20) {
                        echo "remaja";
                    } elseif ($daftar_item["umur"] >= 20 && $daftar_item["umur"] < 40) {
                        echo "dewasa";
                    } elseif ($daftar_item["umur"] >= 40) {
                        echo "tua";
                    } else {
                        echo "tidak ditemukan";
                    }
                    ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
    </from>
</body>
</html>