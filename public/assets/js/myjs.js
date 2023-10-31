$(document).ready(function () {
  // detail data
  $("#modal").click(function (event) {
    event.preventDefault();
    var code = Math.floor(100 + Math.random() * 1000);
    // masukan kode bayar
    $("#kode").val(code);
    var masuk = $("#masuk").val();
    var keluar = $("#keluar").val();
    var harga = $("#harga").val();
    var diff = new Date(keluar).getTime() - new Date(masuk).getTime();
    var days = diff / (1000 * 60 * 60 * 24);

    // Menghitung jika kelipatan bulan
    if (days <= 30) {
      total = 1;
      $("#total").html(": " + formatRupiah(total * harga + code));
      $("#total_harga").val(total * harga + code);
    } else {
      var count = 1;
      for (var i = 30; i < days; i += 30) {
        count++;
      }
      total = count;
      $("#total").html(": " + formatRupiah(total * harga + code));
      $("#total_harga").val(total * harga + code);
    }
    $("#val-date").html(`: <b>${masuk ? masuk : "-"}</b> sampai <b>${keluar ? keluar : "-"}</b>`);
    $("#date_total").html(`: ${days ? days + " hari" : "-"}`)
  });
});

// Format angka rupiah
function formatRupiah(angka) {
  var strAngka = angka.toString();
  var angkaTanpaNol = strAngka.replace(/^0+/, ''); // Menghilangkan nol di depan angka
  var desimal = '';
  var splitAngka = angkaTanpaNol.split('.');
  
  if (splitAngka.length > 1) {
    desimal = ',' + splitAngka[1];
    if (desimal.length > 3) {
      desimal = ',' + splitAngka[1].substring(0, 3);
    }
  }
  
  var ribuan = splitAngka[0];
  ribuan = ribuan.replace(/\B(?=(\d{3})+(?!\d))/g, '.');

  return "Rp. " + ribuan + desimal;
}


function openModal() {
  // Menampilkan modal
  document.getElementById("qris").style.display = "block";
}

// Fungsi untuk mengatur nilai metode_pembayaran saat pengguna memilih metode pembayaran
function setMetodePembayaran(metode) {
  document.getElementById('metode_pembayaran').value = metode;
  document.getElementById('pay').innerHTML = metode;
  
}

// Event listener untuk mendengarkan saat pengguna memilih metode pembayaran BCA
document.getElementById('bcaButton').addEventListener('click', function() {
  setMetodePembayaran('BCA');
});

// Event listener untuk mendengarkan saat pengguna memilih metode pembayaran QRIS
document.getElementById('qrisButton').addEventListener('click', function() {
  setMetodePembayaran('QRIS');
});

// Event listener untuk mendengarkan saat pengguna memilih metode pembayaran BRI
document.getElementById('briButton').addEventListener('click', function() {
  setMetodePembayaran('BRI');
});

