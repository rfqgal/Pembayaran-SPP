const baseLink = "http://localhost/Pembayaran-SPP/app/administrator";

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
        <td>${object.username}</td>
        <td>${object.level}</td>
        <td class="action-2">
          <a href="./update.php?id=${object.id}">
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
  xhr.open("GET", `${baseLink}/search.php?search=${find}`);
  xhr.send();
}

const create = () => {
  let inputName = capitalizeFirstLetter(document.getElementById("name").value.toLowerCase());
  let nameWithNoDigits = inputName.replace(/[0-9]/g, '');
  let inputUsername = document.getElementById("username").value.toLowerCase();
  let inputPassword = document.getElementById("password").value;
  let inputLevel = document.getElementById("level").value;

  const object = {
    name: nameWithNoDigits,
    username: inputUsername,
    password: inputPassword,
    level: inputLevel
  }

  let xhr = new XMLHttpRequest();
  xhr.open("POST", `${baseLink}/create.php`);

  xhr.send(JSON.stringify(object));
  xhr.addEventListener("load", () => {
    if (xhr.status === 201) {
      alert('Akun petugas telah dibuat!');
      window.location.href = "./index.php";
    } else {
      alert('Akun petugas gagal dibuat!');
    }
  });
}

const get = (objectId) => {
  const xhr = new XMLHttpRequest();
  xhr.addEventListener("load", () => {
    const responseJson = JSON.parse(xhr.responseText);

    responseJson.records.forEach(object => {
      if (object.id == objectId) {
        document.getElementById("name").value = object.name;
        document.getElementById("username").value = object.username;
        document.getElementById("level").value = object.level;
      }
    })
  });
  xhr.open("GET", `${baseLink}/read.php`);
  xhr.send();
}

const update = (objectId) => {
  let inputName = capitalizeFirstLetter(document.getElementById("name").value.toLowerCase());
  let nameWithNoDigits = inputName.replace(/[0-9]/g, '');
  let inputUsername = document.getElementById("username").value.toLowerCase();
  let inputPassword = document.getElementById("password").value;
  let inputLevel = document.getElementById("level").value;

  const object = {
    id: objectId,
    name: nameWithNoDigits,
    username: inputUsername,
    password: inputPassword,
    level: inputLevel
  }

  let xhr = new XMLHttpRequest();
  xhr.open("POST", `${baseLink}/update.php`);

  xhr.send(JSON.stringify(object));
  xhr.addEventListener("load", () => {
    if (xhr.status === 200) {
      alert('Akun petugas telah diupdate!');
      window.location.href = "./index.php";
    } else {
      alert('Akun petugas gagal diupdate!');
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
      alert('Akun petugas telah dihapus!');
      window.location.reload();
    } else {
      alert('Akun petugas gagal dihapus!');
    }
  });
}