$("#from").attr("disabled", true)
$("#to").attr("disabled", true)

$("#type").on("change", function () {
  if ($("#type").val() == 0) {
    $("#from").attr("disabled", true)
    $("#to").attr("disabled", true)
  } else {
    $("#from").attr("disabled", false)
    $("#to").attr("disabled", false)
  }
})

$("#print_statment").on("click", function () {
  printStatment()
})

$("#export_statment").on("click", function (e) {
  // Poista tapahtuman oletuskäyttäytyminen (e.preventdefault())
  e.preventDefault()

  // Luo Blob, joka sisältää HTML-taulukon sisällön
  let htmlContent = $("#print_area").html()
  let file = new Blob([htmlContent], { type: "application/vnd.ms-excel" })

  // Luo URL Blobille
  let url = URL.createObjectURL(file)

  // Luo ja klikkaa latauslinkkiä
  let a = $("<a/>", {
    href: url,
    download: "print_statement.xls", // Lataustiedoston nimi
  })
    .appendTo("body")
    .get(0)
    .click()

  // Poista luotu linkki
  $(a).remove()
})

function printStatment() {
  let printArea = document.querySelector("#print_area")
  let newWindow = window.open("")
  newWindow.document.write(`<style media="print">
  
  @import url('https://fonts.googleapis.com/css2?family=Hedvig+Letters+Serif:opsz@12..24&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap');

  body{
    font-family: "Roboto", sans-serif;
    font-weight: 100;
    font-style: normal;
  }
  table{
    width: 100%
  }
  th{
    background-color: #6DC5D1!important;
  }
  tr,th{
    padding: 15px !important;
    text-align: left !important;
    border-bottom: 1px solid   #F1F1F1 !important;
  }
  </style>`)
  newWindow.document.write(`<html><head><title></title>`)
  newWindow.document.write(`</head><body>`)
  newWindow.document.write(printArea.innerHTML)
  newWindow.document.write(`</body></html>`)
  newWindow.print()
  newWindow.close()
}
$("#userForm").on("submit", function (event) {
  event.preventDefault()
  $("#usertable tr").html = ""
  let from = $("#from").val()
  let to = $("#to").val()
  let sendingData = {
    from: from,
    to: to,
    action: "get_user_statment",
  }

  $.ajax({
    method: "POST",
    dataType: "json",
    url: "../api/kulut.php",
    data: sendingData,
    success: function (data) {
      let status = data.status
      let response = data.data
      let th = ""
      let tr = ""

      if (status) {
        response.forEach((res) => {
          th += "<tr>"
          for (let r in res) {
            th += `<th>${res[r]}</th>`
          }
          th += "</tr>"

          tr += "<tr>"
          for (let r in res) {
            tr += `<td>${res[r]}</td>`
          }
          tr += "</tr>"
        })
        $("#usertable thead").append(th)
        $("#usertable tbody").append(tr)
      } else {
        displayMessage("error", response)
      }
    },
    error: function (data) {
      displayMessage(data)
    },
  })
})

function displayMessage(type, message) {
  let sucess = document.querySelector(".alert-success")
  let error = document.querySelector(".alert-danger")
  if (type == "success") {
    error.classList = "alert alert-danger d-none"
    sucess.classList = "alert alert-success"
    sucess.innerHTML = message

    setTimeout(function () {
      $("#kulutModel").modal("hide")
      sucess.classList = "alert alert-success d-none"
      $("#kulutForm")[0].reset()
    }, 3000)
  } else {
    error.classList = "alert alert-danger"
    error.innerHTML = message
  }
}

function loadData() {
  let sendingData = {
    action: "get_user_transaction",
  }

  $.ajax({
    method: "POST",
    dataType: "json",
    url: "../api/kulut.php",
    data: sendingData,
    success: function (data) {
      let status = data.status
      let response = data.data

      if (status) {
        let tr = "" // Alustetaan muuttuja 'tr' tyhjäksi merkkijonoksi
        response.forEach((res) => {
          tr += "<tr>" // Lisätään aloitus `<tr>`-tagi
          for (let r in res) {
            if (r === "type") {
              if (res[r] === "Income") {
                tr += `<td class="badge badge-success">${res[r]}</td>`
              } else {
                tr += `<td class="badge badge-danger">${res[r]}</td>`
              }
            } else {
              tr += `<td>${res[r]}</td>`
            }
          }
          tr += `<td><a href="#" class="btn btn-info update_info" data-update_id="${res["id"]}"><i class="fa-solid fa-pen"></i></a></td><td><a href="#" class="btn btn-danger delete_info" data-delete_id="${res["id"]}"><i class="fa-solid fa-trash"></i></a></td></tr>`
          tr += "</tr>" // Lisätään lopetus `</tr>`-tagi
        })
        $("#tableForm tbody").append(tr) // Lisätään koko `<tr>` sisältö `<tbody>`-elementtiin
      }
    },
    error: function (error) {
      console.log(error)
    },
  })
}

// update
$("#tableForm").on("click", ".update_info", function () {
  let id = $(this).data("update_id") // Hae id data-attribuutista

  // Kutsu fetchUserInfo-funktiota annetulla id:llä
  fetchUserInfo(id)
})

// delete
$("#tableForm").on("click", ".delete_info", function () {
  let id = $(this).data("delete_id") // Hae id data-attribuutista

  if (confirm("Oletko varma että haluat poista?"))
    // Kutsu delet-funktiota annetulla id:llä
    DeleteExpenseInfo(id)
})
