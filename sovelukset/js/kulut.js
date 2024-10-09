loadData()
btnAction = "Insert"
$("#AddNew").on("click", function () {
  $("#kulutModel").modal("show")
})

$("#kulutForm").submit(function (event) {
  event.preventDefault()

  let amount = $("#amount").val()
  let type = $("#type").val()
  let description = $("#description").val()
  let id = $("#update_id").val()
  let sendingData = {}
  if (btnAction == "Insert") {
    sendingData = {
      amount: amount,
      type: type,
      description: description,
      action: "Registeration_kulut",
    }
  } else {
    sendingData = {
      id: id,
      amount: amount,
      type: type,
      description: description,
      action: "update_kulut",
    }
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
        displayMessage("success", response)
        btnAction = "Insert"
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

function fetchUserInfo(id) {
  let sendingData = {
    action: "get_expense_info",
    id: id,
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
        // Aseta btnAction "Update" tilaan
        btnAction = "Update"
        // Aseta vastauksen tiedot lomakkeen kenttiin
        $("#update_id").val(response.id)
        $("#amount").val(response.amount)
        $("#type").val(response.type)
        $("#description").val(response.description)

        // Näytä modaali, jossa tiedot on asetettu
        $("#tableForm").modal("show")
      } else {
        // Näytä virheilmoitus
        displayMessage("error", response)
      }
    },
    error: function (xhr, status, error) {
      // Näytä virheilmoitus konsolissa
      console.log("AJAX error:", error)
    },
  })
}

function DeleteExpenseInfo(id) {
  let sendingData = {
    action: "delete_expense_info",
    id: id,
  }
  $.ajax({
    method: "POST",
    dataType: "JSON",
    url: "../api/kulut.php",
    data: sendingData,
    success: function (data) {
      let status = data.status
      let response = data.data
      if (status) {
        Swal.fire("Good job!", response, "sucess")
        loadData()
      } else {
        alert(response)
      }
    },
    error: function (data) {
      console.log(data)
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
