<?php
//session_start();
include('../config.php');
if(isset($_POST['idbarangbeli'])&&isset($_POST['nofakturbeli'])){
$kd_barang=$_POST['idbarangbeli'];
$no_faktur=$_POST['nofakturbeli'];
$jml=$_POST['jumlahbeli'];
$nok=$_POST['nomorkasus'];
$tindakan=$_POST['TindakanPerbaikan'];
$teknisi=$_POST['TeknisiPerbaikan'];






$query="SELECT * from tbarang,tkategori where tbarang.idkategori=tkategori.idkategori and  tbarang.idbarang='$kd_barang' ";
$get_data=mysql_query($query);
$found=mysql_num_rows($get_data);
if($found>0){
$data=mysql_fetch_array($get_data);
$idbarang=$data['idbarang'];
$kategori=$data['kategori'];
$namabarang=$data['namabarang'];
$stock=$data['stock'];
$stockbaru=$stock+$jml;


$query_rinci_jual="INSERT INTO trincipembelian (nofaktur,idbarang,namabarang,jumlah)VALUES ('".$no_faktur."','".$idbarang."','".$namabarang."','".$jml."') ";
$insert_rinci_jual=mysql_query($query_rinci_jual);


$query_update="update tbarang set stock='$stockbaru' where idbarang='$kd_barang'";
$update=mysql_query($query_update);



if($insert_rinci_jual){
header("location:../user.php?menu=fkerusakanpcbaru&nomor=".$nok."&teknisi=".$teknisi."&tindakan=".$tindakan);}
else{
echo "Terjadi Kesalahan, Tidak dapat melanjutkan proses";}}
else{
echo "<script type='text/javascript'> alert('Kode Barang Tidak Terdaftar/Stock Habis!'); document.location.href='../user.php?menu=masuk'; </script>;";}}
?>
