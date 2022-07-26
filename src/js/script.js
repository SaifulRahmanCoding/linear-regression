// konirmasi hapus data training
function confirm_delete_training(){
  return confirm("Anda Yakin Menghapus Data Training?");
}
// konirmasi hapus data testing
function confirm_delete_testing(){
  return confirm("Anda Yakin Menghapus Data Testing?");
}
// jam
window.setTimeout("waktu()", 1000);

function waktu() {
  var waktu = new Date();
  setTimeout("waktu()", 1000);
  document.getElementById("jam").innerHTML = waktu.getHours();
  document.getElementById("menit").innerHTML = waktu.getMinutes();
  document.getElementById("detik").innerHTML = waktu.getSeconds();
}

// ASCII jadi patokan char
function hanyaAngka(evt)
{
 var charCode = (evt.which) ? evt.which : event.keyCode
 // pengecekan jika yang di input adalah angka, maka akan mengembalikan nilai true pada form
 if (charCode > 31 && (charCode < 48 || charCode > 57))
  return false;
  return true;
}