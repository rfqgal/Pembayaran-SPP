const read = () => {
  const userId = document.querySelector('#userId');
  
  const xhr = new XMLHttpRequest();
  xhr.addEventListener("load", () => {
    const responseJson = JSON.parse(xhr.responseText);
  
    responseJson.records.forEach(object => {
      if (object.nisn == userId.value) {
        listObjects.innerHTML += `
          <tr class="listObject">
            <td>${object.nisn}</td>
            <td>${object.student_name}</td>
            <td>${object.payment_date}</td>
            <td>${object.payment_month}</td>
            <td>${object.payment_year}</td>
            <td>${object.tuition_fee}</td>
            <td>${object.payment_total}</td>
          </tr>
        `;
      }
    })
  });
  xhr.open("GET", "http://localhost/Pembayaran-SPP/app/payment/read.php");
  xhr.send();
}