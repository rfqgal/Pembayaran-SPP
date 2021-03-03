const getFormattedDate = new Date().getFullYear() + "-0" + 
  (new Date().getMonth() + 1) + "-" + new Date().getDate()
;

const months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
  'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
];

const getFullDate = new Date().getDate() + " " + 
  months[new Date().getMonth()] + " " + new Date().getFullYear()
;

const baseLink = "http://localhost/Pembayaran-SPP/app/payment";
const studentLink = "http://localhost/Pembayaran-SPP/app/student";

const read = () => {
  let input = document.getElementById("search");
  let find = input.value.toLowerCase();
  listObjects.innerHTML = "";

  const xhr = new XMLHttpRequest();
  xhr.addEventListener("load", () => {
    const responseJson = JSON.parse(xhr.responseText);
    responseJson.records.forEach(object => {
      listObjects.innerHTML += `
      <tr class="listObject">
        <td>${object.nisn}</td>
        <td>${object.student_name}</td>
        <td>${object.month_paid}</td>
        <td>${object.year_paid}</td>
        <td>${formatRupiah(object.payment_total, "Rp ")}</td>
        <td>${object.payment_date}</td>
      </tr>
    `;
    })
  });
  xhr.open("GET", `${baseLink}/read.php`);
  xhr.send();
}

const find = () => {
  let input = document.getElementById("search");
  let find = input.value.toLowerCase();
  listObjects.innerHTML = "";

  const xhr = new XMLHttpRequest();
  xhr.addEventListener("load", () => {
    const responseJson = JSON.parse(xhr.responseText);

    responseJson.records.forEach(object => {
      listObjects.innerHTML += `
      <tr class="listObject">
        <td>${object.nisn}</td>
        <td>${object.nis}</td>
        <td>${object.name}</td>
        <td>${object.grade}</td>
        <td>${object.address}</td>
        <td>${object.phone}</td>
        <td>${formatRupiah(object.tuition, "Rp ")}</td>
        <td class="action-1">
          <a href="./transaction.php?nisn=${object.nisn}">
            <button>Bayar</button>
          </a>
        </td>
      </tr>
    `;
    })
  });
  xhr.open("GET", `${studentLink}/search.php?search=${find}`);
  xhr.send();
}

const readPagingEntry = () => {
  let input = document.getElementById("search");
  let find = input.value.toLowerCase();
  listObjects.innerHTML = "";

  const xhr = new XMLHttpRequest();
  xhr.addEventListener("load", () => {
    const responseJson = JSON.parse(xhr.responseText);

    responseJson.records.forEach(object => {
      listObjects.innerHTML += `
      <tr class="listObject">
        <td>${object.nisn}</td>
        <td>${object.nis}</td>
        <td>${object.name}</td>
        <td>${object.grade}</td>
        <td>${object.address}</td>
        <td>${object.phone}</td>
        <td>${formatRupiah(object.tuition, "Rp ")}</td>
        <td class="action-1">
          <a href="./transaction.php?nisn=${object.nisn}">
            <button>Bayar</button>
          </a>
        </td>
      </tr>
    `;
    })
  });
  xhr.open("GET", `${studentLink}/read.php`);
  xhr.send();
}

const getStudent = (objectId) => {  
  const xhr = new XMLHttpRequest();
  xhr.addEventListener("load", () => {
    const responseJson = JSON.parse(xhr.responseText);

    responseJson.record.forEach(object => {
      document.getElementById("nisn").value = object.nisn;
      document.getElementById("nis").value = object.nis;
      document.getElementById("name").value = object.name;
      document.getElementById("grade").value = object.grade;
      document.getElementById("date").value = getFullDate;
      document.getElementById("tuition_id").value = object.tuition_id;
      document.getElementById("tuition").value = object.tuition;

      const getAdminId = document.getElementById("admin_id").value;
      document.getElementById("pay").addEventListener("click", () => {
        confirmPay(
          getAdminId,
          `Apakah Anda sudah yakin untuk membayar SPP ${object.name} pada bulan ${
            document.getElementById("month").value
          }?`
        );
      });
    })
  });
  xhr.open("GET", `${studentLink}/read_one.php?nisn=${objectId}`);
  xhr.send();
}

const pay = (adminId) => {
  const inputName = document.getElementById("name").value;
  
  const inputNisn = document.getElementById("nisn").value;
  const inputDatePaid = document.getElementById("date_paid").value;
  const inputMonth = document.getElementById("month").value;
  const inputYear = document.getElementById("year").value;
  const inputTuitionId = document.getElementById("tuition_id").value;
  const inputPaymentTotal = document.getElementById("tuition").value;

  const object = {    
    administrator_id: adminId,
    nisn: inputNisn,
    payment_date: getFormattedDate,
    date_paid: inputDatePaid,
    month_paid: inputMonth,
    year_paid: inputYear,
    tuition_id: inputTuitionId,
    payment_total: inputPaymentTotal 
  }

  let xhr = new XMLHttpRequest();
  xhr.open("POST", `${baseLink}/create.php`);

  xhr.send(JSON.stringify(object));
  xhr.addEventListener("load", () => {
    if (xhr.status === 201) {
      alert(`Pembayaran SPP ${inputName} pada bulan ${inputMonth} telah dibuat!`);
      window.location.href = "./history.php";
    } else {
      alert(`Pembayaran SPP ${inputName} pada bulan ${inputMonth} gagal dibuat!`);
    }
  });
}

const confirmPay = (adminId, message) => {
  if (confirm(message)) {
    pay(adminId);
  }
}

const drop = (objectId) => {
  const object = {
    payment_id: objectId
  }

  let xhr = new XMLHttpRequest();
  xhr.open("POST", `${baseLink}/delete.php`);

  xhr.send(JSON.stringify(object));
  xhr.addEventListener("load", () => {
    if (xhr.status === 200) {
      alert(`Pembayaran SPP telah dihapus!`);
      window.location.reload();
    } else {
      alert(`Pembayaran SPP gagal dihapus!`);
    }
  });
}