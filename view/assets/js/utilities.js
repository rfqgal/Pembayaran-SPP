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
  var splitStr = string.toLowerCase().split(' ');
  for (var i = 0; i < splitStr.length; i++) {
      // You do not need to check if i is larger than splitStr length, as your for does that for you
      // Assign it back to the array
      splitStr[i] = splitStr[i].charAt(0).toUpperCase() + splitStr[i].substring(1);     
  }
  // Directly return the joined string
  return splitStr.join(' '); 
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