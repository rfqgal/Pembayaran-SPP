const search = () => {
  let input = document.getElementById("search");
  let filter = input.value.toUpperCase();
  let obj = document.getElementsByClassName("listObject");

  for (i = 0; i < obj.length; i++) {
    let val = obj[i].textContent || obj[i].innerText;
    if (val.toUpperCase().indexOf(filter) > -1) {
      obj[i].style.display = "";
    }
    else {
      obj[i].style.display = "none";
    }
  }
}

const searchBy = (...index) => {
  let input = document.getElementById("search");
  let filter = input.value.toUpperCase();
  let obj = document.getElementsByClassName("listObject");
  console.log(filter);
  console.log(obj);

  for (i = 0; i < obj.length; i++) {
    for (let args of index) {
      let value = obj[i].getElementsByTagName("td")[args];
      let text = value.textContent || value.innerText;
      if (text.toUpperCase().indexOf(filter) > -1) {
        obj[i].style.display = "";
      } else {
        obj[i].style.display = "none";
      }
    }
  }
}

const capitalizeFirstLetter = (string) => {
  return string.charAt(0).toUpperCase() + string.slice(1);
}

const confirmDelete = (id, message) => {
  if (confirm(message)) {
    drop(id);
  }
}

document.getElementById("search").addEventListener("keyup", (event) => {
  event.preventDefault();
  if (event.keyCode === 13) {
    document.getElementById("btnSearch").click();
  }
});