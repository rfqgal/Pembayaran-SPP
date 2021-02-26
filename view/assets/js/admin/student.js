const baseLink = "http://localhost/Pembayaran-SPP/app/student";

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
            ${object.nisn}, 
            'Apakah Anda yakin ingin menghapus akun ${object.name}?'
            )" class="danger img">
            <img src="../../assets/img/button-delete.svg" alt="Delete">
          </button>
        </td>
      </tr>
    `;
    })
  });
  xhr.open("GET", `${baseLink}/search.php?search=${find}`);
  xhr.send();
}

const create = () => {
  let inputNisn = document.getElementById("nisn").value;
  let inputNis = document.getElementById("nis").value;
  let inputName = capitalizeFirstLetter(document.getElementById("name").value.toLowerCase());
  let nameWithNoDigits = inputName.replace(/[0-9]/g, '');
  let inputGradeId = document.getElementById("grade").value.toUpperCase();
  let inputAddress = capitalizeFirstLetter(document.getElementById("address").value);
  let inputPhone = document.getElementById("phone").value;
  let inputTuitionId = document.getElementById("tuition").value;

  const object = {
    nisn: inputNisn,
    nis: inputNis,
    name: nameWithNoDigits,
    grade_id: inputGradeId,
    address: inputAddress,
    phone: inputPhone,
    tuition_id: inputTuitionId
  }

  let xhr = new XMLHttpRequest();
  xhr.open("POST", `${baseLink}/create.php`);

  xhr.send(JSON.stringify(object));
  xhr.addEventListener("load", () => {
    if (xhr.status === 201) {
      alert('Akun siswa telah dibuat!');
      window.location.href = "./index.php";
    } else {
      alert('Akun siswa gagal dibuat!');
    }
  });
}

const get = (objectId) => {
  const xhr = new XMLHttpRequest();
  xhr.addEventListener("load", () => {
    const responseJson = JSON.parse(xhr.responseText);

    responseJson.records.forEach(object => {
      if (object.nisn == objectId) {
        document.getElementById("nisn").value = object.nisn;
        document.getElementById("nis").value = object.nis;
        document.getElementById("name").value = object.name;
        document.getElementById("grade").value = object.grade_id;
        document.getElementById("address").value = object.address;
        document.getElementById("phone").value = object.phone;
        document.getElementById("tuition").value = object.tuition_id;
      }
    });
  });
  xhr.open("GET", `${baseLink}/read.php`);
  xhr.send();
}

const update = (objectId) => {
  let inputNis = document.getElementById("nis").value;
  let inputName = capitalizeFirstLetter(document.getElementById("name").value.toLowerCase());
  let nameWithNoDigits = inputName.replace(/[0-9]/g, '');
  let inputGradeId = document.getElementById("grade").value.toUpperCase();
  let inputAddress = capitalizeFirstLetter(document.getElementById("address").value);
  let inputPhone = document.getElementById("phone").value;
  let inputTuitionId = document.getElementById("tuition").value;

  const object = {
    nisn: objectId,
    nis: inputNis,
    name: nameWithNoDigits,
    grade_id: inputGradeId,
    address: inputAddress,
    phone: inputPhone,
    tuition_id: inputTuitionId
  }

  let xhr = new XMLHttpRequest();
  xhr.open("POST", `${baseLink}/update.php`);

  xhr.send(JSON.stringify(object));
  xhr.addEventListener("load", () => {
    if (xhr.status === 200) {
      alert('Akun siswa telah diupdate!');
      window.location.href = "./index.php";
    } else {
      alert('Akun siswa gagal diupdate!');
    }
  });
}

const drop = (objectId) => {
  const object = {
    nisn: objectId
  }

  let xhr = new XMLHttpRequest();
  xhr.open("POST", `${baseLink}/delete.php`);

  xhr.send(JSON.stringify(object));
  xhr.addEventListener("load", () => {
    if (xhr.status === 200) {
      alert('Akun siswa telah dihapus!');
      window.location.reload();
    } else {
      alert('Akun siswa gagal dihapus!');
    }
  });
}