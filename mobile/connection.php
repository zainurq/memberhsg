<?php
    $db = new mysqli("192.168.1.10", "retail", "admin123", "vp_pos");
    $db->query("set name utf8");

    $db = $link;  // Menggunakan variabel $link sebagai $db
