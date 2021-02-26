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
        <td>${object.nis}</td>
        <td>${object.name}</td>
        <td>${object.grade}</td>
        <td>${object.address}</td>
        <td>${object.phone}</td>
        <td>${object.tuition}</td>
        <td class="action-2">
          <a href="./update.php?nisn=${object.nisn}">
            <button class="warning img">
              <img src="../../assets/img/button-edit.svg" alt="Edit">
            </button>
          </a>
          <button onclick="confirmDelete(
            ${object.id}, 
            'Apakah Anda yakin ingin menghapus akun ${object.name}?'
            )" class="danger img">
            <img src="../../assets/img/button-delete.svg" alt="Delete">
          </button>
        </td>
      </tr>
    `;
    })
  });
  xhr.open("GET", `http://localhost/Pembayaran-SPP/app/student/search.php?search=${find}`);
  xhr.send();
}