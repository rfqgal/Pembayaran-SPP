const baseLink = "http://localhost/Pembayaran-SPP/app/grade"

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
        <td>${object.name}</td>
        <td>
          ${
            (object.major == "RPL") ? "Rekayasa Perangkat Lunak" :
            (object.major == "TKJ") ? "Teknik Komputer dan Jaringan" :
            (object.major == "TEI") ? "Teknik Elektronika Industri" :
            (object.major == "TKRO") ? "Teknik Kendaraan Ringan Otomotif" :
            (object.major == "TBSM") ? "Teknik Bisnis dan Sepeda Motor" : ""
          }
        </td>
        <td class="action-2">
          <a href="./update.php?id=${object.id}">
            <button class="warning img">
              <img src="../../assets/img/button-edit.svg" alt="Edit">
            </button>
          </a>
          <button onclick="confirmDelete(
            ${object.id}, 
            'Apakah Anda yakin ingin menghapus Kelas ${object.grade} ${object.major} ${object.alma_mater}?'
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
  let inputGrade = document.getElementById("grade").value.toUpperCase();
  let inputMajor = document.getElementById("major").value.toUpperCase();
  let inputAlmaMater = document.getElementById("almamater").value;

  const object = {
    grade: inputGrade,
    major: inputMajor,
    alma_mater: inputAlmaMater
  }

  let xhr = new XMLHttpRequest();
  xhr.open("POST", `${baseLink}/create.php`);

  xhr.send(JSON.stringify(object));
  xhr.addEventListener("load", () => {
    if (xhr.status === 201) {
      alert('Kelas telah dibuat!');
      window.location.href = "./index.php";
    } else {
      alert('Kelas gagal dibuat!');
    }
  });
}

const get = (objectId) => {
  const xhr = new XMLHttpRequest();
  xhr.addEventListener("load", () => {
    const responseJson = JSON.parse(xhr.responseText);

    responseJson.records.forEach(object => {
      if (object.id == objectId) {
        document.getElementById("grade").value = object.grade;
        document.getElementById("major").value = object.major;
        document.getElementById("almamater").value = object.alma_mater;
      }
    })
  });
  xhr.open("GET", `${baseLink}/read.php`);
  xhr.send();
}

const update = (objectId) => {
  let inputGrade = document.getElementById("grade").value.toUpperCase();
  let inputMajor = document.getElementById("major").value.toUpperCase();
  let inputAlmaMater = document.getElementById("almamater").value;

  const object = {
    id: objectId,
    grade: inputGrade,
    major: inputMajor,
    alma_mater: inputAlmaMater
  }

  let xhr = new XMLHttpRequest();
  xhr.open("POST", `${baseLink}/update.php`);

  xhr.send(JSON.stringify(object));
  xhr.addEventListener("load", () => {
    if (xhr.status === 200) {
      alert('Kelas telah diupdate!');
      window.location.href = "./index.php";
    } else {
      alert('Kelas gagal diupdate!');
    }
  });
}

const drop = (objectId) => {
  const object = {
    id: objectId
  }

  let xhr = new XMLHttpRequest();
  xhr.open("POST", `${baseLink}/delete.php`);

  xhr.send(JSON.stringify(object));
  xhr.addEventListener("load", () => {
    if (xhr.status === 200) {
      alert('Kelas telah dihapus!');
      window.location.reload();
    } else {
      alert('Kelas gagal dihapus!');
    }
  });
}