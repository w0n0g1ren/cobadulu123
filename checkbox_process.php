<?php
// php //
include "koneksi.php";
    
    $kode = $_GET['opt1'];

    $ambildata1 = mysqli_query($koneksi,"select id from gejala WHERE id = '$kode' ");
    $ambil1 = mysqli_fetch_array($ambildata1);

    $ambildata1cf = mysqli_query($koneksi,"select cf from gejala WHERE id = '$kode' ");
    $ambil1cf = mysqli_fetch_array($ambildata1cf);

    $tmp1 = "$ambil1[id]";

    $cf1 = 0;
    $tmp2 = " ";

    if($tmp1 == "A02"){
        $tmp2 = "B01";
        $cf1 = 0.8 * $ambil1cf['cf'];
    }
    if($tmp1 == "A03"){
        $tmp2 = "B01";
        $cf1 = 0.6 * $ambil1cf['cf'];
    }
    if($tmp1 =="A04"){
        $tmp2 = "B01";
        $cf1 = 0.7 * $ambil1cf['cf'];
    }
    if($tmp1 == "A01"){
        $tmp2 = "B02";
        $cf1 = 0.5 * $ambil1cf['cf'];
    }
    

    $tmp3 = " ";
    $cf2 = 0;

    if($tmp1 == "A01" && $tmp2 == "B02"){
        $tmp3 = "C01";
        $cf2 = 0.6 * min($ambil1cf['cf'],$cf1);
    }
    if($tmp1 == "A02" && $tmp2 == "B01"){
        $tmp3 = "C02";
        $cf2 = 0.8 * min($ambil1cf['cf'],$cf1);
    }
    if($tmp1 == "A03" && $tmp2 == "B01"){
        $tmp3 = "C03";
        $cf2 = 0.9 * min($ambil1cf['cf'],$cf1);
    }
    if($tmp1 == "A04" && $tmp2 == "B01"){
        $tmp3 = "C04";
        $cf2 = 0.7 * min($ambil1cf['cf'],$cf1);
    }
    

    $tmp4 = "";
    $cf3 = 0;

    if ($tmp3 == "C01"){
        $tmp4 = "D01";
        $cf3 = $cf2 * 0.6;
    }
    if ($tmp3 == "C02"){
        $tmp4 = "D01";
        $cf3 = $cf2 * 0.7;
    }
    if ($tmp3 == "C03"){
        $tmp4 = "D02";
        $cf3 = $cf2 * 0.9;
    }
    if ($tmp3 == "C04"){
        $tmp4 = "D03";
        $cf3 = $cf2 * 0.7;
    }


    $ambildata2 = mysqli_query($koneksi,"select penyebab from penyebab WHERE id = '$tmp2' ");
    $ambil2 = mysqli_fetch_array($ambildata2);

    $ambildata3 = mysqli_query($koneksi,"select nama from penyakit WHERE id = '$tmp3' ");
    $ambil3 = mysqli_fetch_array($ambildata3);

    $ambildata4 = mysqli_query($koneksi,"select solusi from solusi WHERE id = '$tmp4' ");
    $ambil4 = mysqli_fetch_array($ambildata4);

    $ambildata5 = mysqli_query($koneksi,"select gejala from gejala WHERE id = '$kode' ");
    $ambil5 = mysqli_fetch_array($ambildata5);

    $akurasi = " ";
    if($cf3 >= 0.3){
        $akurasi = "Pasti";
    }
    if($cf3 >= 0.1 && $cf3 < 0.3){
        $akurasi = "Mungkin";
    }
    if($cf3 < 0.1){
        $akurasi = "kemungkinan kecil";
    }

    
// php //
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
    <style>
h1{
    margin-top : 50px;
  font-size: 30px;
  color: #fff;
  text-transform: uppercase;
  font-weight: 300;
  text-align: center;
  margin-bottom: 15px;
}
table{
justify-content: center;
  align-items: center;
  margin-top: 100px;
  margin-left: 500px;
    background-color: white;
  width:50%;
  table-layout: fixed;
}
.tbl-header{
  background-color: rgba(255,255,255,0.3);
 }
.tbl-content{
  height:300px;
  overflow-x:auto;
  margin-top: 0px;
  border: 1px solid rgba(255,255,255,0.3);
}
th{
  padding: 20px 15px;
  text-align: left;
  font-weight: 500;
  font-size: 12px;
  width: 10%;
  color: #000000;
  text-transform: uppercase;
}
td{
  padding: 15px;
  text-align: left;
  vertical-align:middle;
  font-weight: 300;
  width: 40%;
  font-size: 12px;
  color: #000000;
  border-bottom: solid 1px rgba(255,255,255,0.1);
}


/* demo styles */

@import url(https://fonts.googleapis.com/css?family=Roboto:400,500,300,700);
body{
  background: -webkit-linear-gradient(left, #25c481, #25b7c4);
  background: linear-gradient(to right, #25c481, #25b7c4);
  font-family: 'Roboto', sans-serif;
}
section{
  margin: 50px;
}


/* follow me template */
.made-with-love {
  margin-top: 40px;
  padding: 10px;
  clear: left;
  text-align: center;
  font-size: 10px;
  font-family: arial;
  color: #fff;
}
.made-with-love i {
  font-style: normal;
  color: #F50057;
  font-size: 14px;
  position: relative;
  top: 2px;
}
.made-with-love a {
  color: #fff;
  text-decoration: none;
}
.made-with-love a:hover {
  text-decoration: underline;
}


/* for custom scrollbar for webkit browser*/

::-webkit-scrollbar {
    width: 6px;
} 
::-webkit-scrollbar-track {
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3); 
} 
::-webkit-scrollbar-thumb {
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3); 
}
    
    </style>
</head>
<body>

<h1>Penyakit yang didapat</h1>

<table>
    <tr>
        <th>Penyakit</th>
        <td><?php echo "$ambil3[nama]" ?></td>
    </tr>
    <tr>
        <th>Gejala</th>
        <td><?php echo "$ambil5[gejala]" ?></td>
    </tr>
    <tr>
        <th>Penyebab</th>
        <td><?php echo "$ambil2[penyebab]" ?></td>
    </tr>
    <tr>
        <th>Solusi</th>
        <td><?php echo "$ambil4[solusi]" ?></td>
    </tr>
</table>


</body>
</html>
