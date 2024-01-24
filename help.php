<?php
// Query untuk mendapatkan data dari tabel divisi dengan status 1
$query = "SELECT d.id, d.namediv, o.outlet_code, o.instagram, o.website, o.tokopedia, o.bukalapak, o.shoppee, o.whatsapp, o.email
          FROM divisi d
          LEFT JOIN outlet_info o ON d.namediv = o.namadiv
          WHERE d.status = 1
          LIMIT 12";
$result = mysqli_query($link, $query);
?>

<div class="accordion" id="accordionDivisions">
    <?php
    while ($row = mysqli_fetch_assoc($result)) {
        $divisionId = $row['id'];
        $divisionName = $row['namediv'];
        $outletCode = $row['outlet_code'];
        $instagram = $row['instagram'];
        $website = $row['website'];
        $tokopedia = $row['tokopedia'];
        $bukalapak = $row['bukalapak'];
        $shoppee = $row['shoppee'];
        $whatsapp = $row['whatsapp'];
        $email = $row['email'];
    ?>
        <div class="accordion-item">
    <h2 class="accordion-header" id="heading<?php echo $divisionId; ?>">
        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $divisionId; ?>" aria-expanded="true" aria-controls="collapse<?php echo $divisionId; ?>">
            <?php echo $divisionName; ?>
        </button>
    </h2>
    <div id="collapse<?php echo $divisionId; ?>" class="accordion-collapse collapse" aria-labelledby="heading<?php echo $divisionId; ?>" data-bs-parent="#accordionDivisions">
        <div class="accordion-body">
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Instagram:</strong> <?php echo $instagram; ?></p>
                    <p><strong>Website:</strong> <?php echo $website; ?></p>
                    <p><strong>Tokopedia:</strong> <?php echo $tokopedia; ?></p>
                </div>
                <div class="col-md-6">
                    <p><strong>Bukalapak:</strong> <?php echo $bukalapak; ?></p>
                    <p><strong>Shopee:</strong> <?php echo $shoppee; ?></p>
                    <p><strong>WhatsApp:</strong> <?php echo $whatsapp; ?></p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <p><strong>Email:</strong> <?php echo $email; ?></p>
                </div>
            </div>
        </div>
    </div>
</div>

    <?php
    }
    ?>
</div>
