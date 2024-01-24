<?php
include 'layouts/main.php';
include 'layouts/config.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

// Set default status
$status = "Data tidak disimpan";

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get data from the form
    $sku = $_POST['sku'];

    $query = "SELECT idcategori, sku, itemname, poin, `status`
                FROM development.poin_item_gift WHERE sku = '$sku'";
    $result = $link->query($query);

    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
        $memberid = $_SESSION['kd_member'];

        // Query untuk mendapatkan poin pengguna
        $queryUserPoin = "SELECT IFNULL(SUM(point), 0) as poin FROM point_member WHERE kd_member = '$memberid' and flag = 'get'";
        $resultUserPoin = $link->query($queryUserPoin);

        if ($resultUserPoin->num_rows > 0) {
            $userPoin = $resultUserPoin->fetch_assoc()['poin'];

            // Periksa apakah poin pengguna cukup untuk pembelian
            if ($userPoin >= $product['poin']) {
                // Lakukan pengurangan poin
                $newUserPoin = $userPoin - $product['poin'];

                // Lakukan query-insert untuk menyimpan data transaksi
                $queryInsert = "INSERT INTO development.pointransaction (reqid, memberid, poinused, giftid, transdate, transtime)
                                VALUES (null, '$memberid', " . $product['poin'] . ", '$sku', CURDATE(), CURTIME())";
                $resultInsert = $link->query($queryInsert);

                if (!$resultInsert) {
                    die("Gagal menyimpan data transaksi: " . $link->error);
                }

                // Lakukan query-insert untuk menyimpan data poin_member
                $update = "INSERT INTO development.point_member (kd_member, point, invoice, flag, exp, create_by, date_create, time_create, payment)
                            VALUES ('$memberid', " . $product['poin'] . ", '$sku', 'used', CURDATE(), 'admin', CURDATE(), CURTIME(), '901')";
                $resultUpdate = $link->query($update);

                if (!$resultUpdate) {
                    die("Gagal menyimpan data poin_member: " . $link->error);
                }

                // Lakukan query-update untuk mengurangi stok pada poin_item_gift
                $sold = "UPDATE development.poin_item_gift SET stock = stock - 1 WHERE sku = '$sku'";
                $resultSold = $link->query($sold);

                if (!$resultSold) {
                    die("Gagal mengupdate stok: " . $link->error);
                }

                // Update status
                $status = "Data berhasil disimpan";

                // Modal Popup untuk Pemberitahuan Pengurangan Poin
                echo '
                    <div class="modal" id="successModal">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title">Pemberitahuan Pengurangan Poin</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <!-- Modal Body -->
                                <div class="modal-body">
                                    <p>Poin Anda telah dikurangkan sebesar ' . $product['poin'] . '.<br>Sisa Poin Anda sekarang: ' . $newUserPoin . '</p>
                                </div>
                                <!-- Modal Footer -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-success" data-dismiss="modal" onclick="redirectToHome()">Tutup</button>
                                </div>
                            </div>
                        </div>
                    </div>';

                mysqli_close($link);

                // Redirect ke halaman utama
                header("Location: success.php");
                exit();
            } else {
                // Poin pengguna tidak mencukupi
                $status = "Poin Anda tidak mencukupi untuk pembelian ini.";
            }
        } else {
            $status = "Error fetching user points.";
        }
    } else {
        $status = "Produk tidak ditemukan";
    }
} else {
    $status = "Form tidak dikirimkan";
}

echo $status;
?>