<h3>Coba </h3>

<table border = "1">
    <tr>
        <th>id</th>
        <th>nama</th>
</tr>

<?php

    include "koneksi.php";
    $ambildata = mysqli_query($koneksi,"select * from gejala WHERE id = 'A02' ");
    while($tampil = mysqli_fetch_array($ambildata)){
        echo "
        <tr>
            <td>$tampil[id]</td>
            <td>$tampil[nama]</td>
        </tr>";
    }
    
?>

