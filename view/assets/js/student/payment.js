const read = () => {
  const userId = document.querySelector('#userId');
  const userName = document.querySelector('#userName');

  const history = document.getElementById("history");

  const xhr = new XMLHttpRequest();
  xhr.addEventListener("load", () => {
    const responseJson = JSON.parse(xhr.responseText);
    if (xhr.status == 200) {
      history.innerHTML = `
        <header class="flex">
          <input type="text" name="search" id="search" onkeyup="search()" style="width: 100%;"
          placeholder="Cari data berdasarkan apapun" autocomplete="off">
          <button type="submit" class="img" style="margin-left: 4px;">
            <img src="../assets/img/search-white.svg" alt="">
          </button>
        </header>
        <div id="lists" class="mt-20">
          <table id="listObjects">
            <tr>
              <th>NISN</th>
              <th>Nama Siswa</th>
              <th>Tanggal Bayar</th>
              <th>Bulan Bayar</th>
              <th>Tahun Bayar</th>
              <th>Jumlah Bayar</th>
            </tr>
          </table>
        </div>
      `;
    } else {
      history.innerHTML = `
        <h1 class="lato t-center mt-16">Maaf ${userName.value}, kamu belum bayar sama sekali :(</h1>
      `;
    }

    responseJson.records.forEach(object => {
      listObjects.innerHTML += `
        <tr class="listObject">
          <td>${object.nisn}</td>
          <td>${object.student_name}</td>
          <td>${object.payment_date}</td>
          <td>${object.month_paid}</td>
          <td>${object.year_paid}</td>
          <td>${formatRupiah(object.payment_total, "Rp ")}</td>
        </tr>
      `;
    })
  });
  xhr.open("GET", `http://localhost/Pembayaran-SPP/app/payment/search.php?search=${userId.value}`);
  xhr.send();
}