const baseLink = "http://localhost/Pembayaran-SPP/app/tuition";

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
        <td>${object.year}</td>
        <td>${object.fee}</td>
        <td class="action-2">
          <a href="./update.php?id=${object.id}">
            <button class="warning img">
              <img src="../../assets/img/button-edit.svg" alt="Edit">
            </button>
          </a>
          <button onclick="confirmDelete(
            ${object.id}, 
            'Apakah Anda yakin ingin menghapus SPP Tahun ${object.year}?'
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
  let inputYear = document.getElementById("year").value;
  let inputFee = document.getElementById("fee").value;

  const object = {
    year: inputYear,
    fee: inputFee
  }

  let xhr = new XMLHttpRequest();
  xhr.open("POST", `${baseLink}/create.php`);

  xhr.send(JSON.stringify(object));
  xhr.addEventListener("load", () => {
    if (xhr.status === 201) {
      alert('SPP telah dibuat!');
      window.location.href = "./index.php";
    } else {
      alert('SPP gagal dibuat!');
    }
  });
}

const get = (objectId) => {
  const xhr = new XMLHttpRequest();
  xhr.addEventListener("load", () => {
    const responseJson = JSON.parse(xhr.responseText);

    responseJson.records.forEach(object => {
      if (object.id == objectId) {
        document.getElementById("id").value = objectId;
        document.getElementById("year").value = object.year;
        document.getElementById("fee").value = object.fee;
      }
    })
  });
  xhr.open("GET", `${baseLink}/read.php`);
  xhr.send();
}

const update = (objectId) => {
  let inputYear = document.getElementById("year").value;
  let inputFee = document.getElementById("fee").value;

  const object = {
    id: objectId,
    year: inputYear,
    fee: inputFee
  }

  let xhr = new XMLHttpRequest();
  xhr.open("POST", `${baseLink}/update.php`);

  console.log(object);
  xhr.send(JSON.stringify(object));
  xhr.addEventListener("load", () => {
    if (xhr.status === 200) {
      alert('SPP telah diupdate!');
      window.location.href = "./index.php";
    } else {
      alert('SPP gagal diupdate!');
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
      alert('SPP telah dihapus!');
      window.location.reload();
    } else {
      alert('SPP gagal dihapus!');
    }
  });
}