const read = () => {
  const userId = document.querySelector('#userId');
  const userName = document.querySelector('#userName');

  const xhr = new XMLHttpRequest();
  xhr.addEventListener("load", () => {
    const responseJson = JSON.parse(xhr.responseText);
    
    if (xhr.status == 200) {
      lists.innerHTML = `
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
      `;
    } else {
      lists.innerHTML = `
        <h1 class="lato t-center mt-16">Maaf ${userName.value}, kamu belum bayar sama sekali :(</h1>
      `;
    }

    responseJson.records.forEach(object => {
      if (object.nisn == userId.value) {
        listObjects.innerHTML += `
          <tr class="listObject">
            <td>${object.nisn}</td>
            <td>${object.student_name}</td>
            <td>${object.payment_date}</td>
            <td>${object.payment_month}</td>
            <td>${object.payment_year}</td>
            <td>${formatRupiah(object.payment_total, "Rp. ")}</td>
          </tr>
        `;
      }
    })
  });
  xhr.open("GET", `http://localhost/Pembayaran-SPP/app/payment/search.php?search=${userId.value}`);
  xhr.send();
}