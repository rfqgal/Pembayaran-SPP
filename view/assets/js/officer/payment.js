const read = () => {
  const userId = document.querySelector('#userId');

  const xhr = new XMLHttpRequest();
  xhr.addEventListener("load", () => {
    const responseJson = JSON.parse(xhr.responseText);

    responseJson.records.forEach(object => {
      listObjects.innerHTML += `
        <tr class="listObject">
          <td>${object.administrator_name}</td>
          <td>${object.nisn}</td>
          <td>${object.student_name}</td>
          <td>${object.payment_date}</td>
          <td>${object.payment_month}</td>
          <td>${object.payment_year}</td>
          <td>${object.tuition_fee}</td>
          <td>${object.payment_total}</td>
          <td class="action-1">
            <a href="./print.php?nisn=${object.nisn}">
              <button class="img">
                <img src="../assets/img/button-print.svg" alt="Print">
              </button>
            </a>
          </td>
        </tr>
      `;
    })
  });
  xhr.open("GET", "http://localhost/Pembayaran-SPP/app/payment/read.php");
  xhr.send();
}