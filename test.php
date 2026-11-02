<?php
require_once __DIR__ . '/backend/rest/dao/BaseDao.php';

try {
    // Pokušaj ostvarivanja konekcije na bazu
    $conn = BaseDao::connection();
    echo "<h2 style='color: green;'>Uspješno povezano na bazu 'sneakers'!</h2>";
} catch (Exception $e) {
    echo "<h2 style='color: red;'>Konekcija nije uspjela: " . $e->getMessage() . "</h2>";
}
?>