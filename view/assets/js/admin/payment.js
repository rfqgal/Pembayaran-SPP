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
        <td>${object.administrator_name}</td>
        <td>${object.nisn}</td>
        <td>${object.student_name}</td>
        <td>${object.payment_date}</td>
        <td>${object.payment_month}</td>
        <td>${object.payment_year}</td>
        <td>${object.tuition_fee}</td>
        <td>${object.payment_total}</td>
        <td class="action-2">
          <a href="./update.php?id${object.id}">
            <button class="warning img">
              <img src="../../assets/img/button-edit.svg" alt="Edit">
            </button>
          </a>
          <button class="danger img">
            <a href="./delete.php?id${object.id}">
              <img src="../../assets/img/button-delete.svg" alt="Delete">
            </a>
          </button>
        </td>
      </tr>
    `;
    })
  });
  xhr.open("GET", `http://localhost/Pembayaran-SPP/app/payment/search.php?search=${find}`);
  xhr.send();
}