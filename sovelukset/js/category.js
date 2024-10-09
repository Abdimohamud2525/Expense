loadData()
btnAction = "Insert"

$("#AddNew").on("click", function () {
  $("#categoryModel").modal("show")
})

$("#categoryForm").submit(function (event) {
  event.preventDefault()

  let name = $("#name").val()
  let role = $("#role").val()
  let icon = $("#icon").val()
  let id = $("#update_id").val()
  let sendingData = {}
  if (btnAction == "Insert") {
    sendingData = {
      name: name,
      role: role,
      icon: icon,
      action: "Registeration_category",
    }
  } else {
    sendingData = {
      id: id,
      name: name,
      role: role,
      icon: icon,
      action: "update_category",
    }
  }

  $.ajax({
    method: "POST",
    dataType: "json",
    url: "../api/category.php",
    data: sendingData,
    success: function (data) {
      let status = data.status
      let response = data.data

      if (status) {
        displayMessage("success", response)
      } else {
        displayMessage("error", response)
      }
    },
    error: function (data) {
      console.log("error", error)
    },
  })
})

function displayMessage(type, message) {
  let success = document.querySelector(".alert-success")
  let error = document.querySelector(".alert-danger")
  if (type == "success") {
    error.classList = "alert alert-danger d-none"
    success.classList = "alert alert-success"
    success.innerHTML = message

    setTimeout(function () {
      $("#categoryModel").modal("hide")
      success.classList = "alert alert-success d-none"
      $("#categoryForm")[0].reset()
    }, 3000)
  } else {
    error.classList = "alert alert-danger"
    error.innerHTML = message
  }
}

function loadData() {
  let sendingData = {
    action: "read_all_gategory",
  }

  $.ajax({
    method: "POST",
    dataType: "json",
    url: "../api/category.php",
    data: sendingData,
    success: function (data) {
      let status = data.status
      let response = data.data

      if (status) {
        let tr = "" // Alustetaan muuttuja 'tr' tyhjäksi merkkijonoksi
        response.forEach((res) => {
          tr += "<tr>" // Lisätään aloitus `<tr>`-tagi
          for (let r in res) {
            tr += `<td>${res[r]}</td>`
          }
          tr += `<td><a href="#" class="btn btn-info update_info" data-update_id="${res["id"]}"><i class="fa-solid fa-pen"></i></a></td><td><a href="#" class="btn btn-danger delete_info" data-delete_id="${res["id"]}"><i class="fa-solid fa-trash"></i></a></td></tr>`
          tr += "</tr>" // Lisätään lopetus `</tr>`-tagi
        })
        $("#categoryTable tbody").append(tr) // Lisätään koko `<tr>` sisältö `<tbody>`-elementtiin
      }
    },
    error: function (error) {
      console.log("error", error)
    },
  })
}

function fetchCategoryInfo(id) {
  let sendingData = {
    action: "get_category_info",
    id: id,
  }

  $.ajax({
    method: "POST",
    dataType: "json",
    url: "../api/category.php",
    data: sendingData,
    success: function (data) {
      let status = data.status
      let response = data.data

      if (status) {
        // Aseta btnAction "Update" tilaan
        btnAction = "Update"
        // Aseta vastauksen tiedot lomakkeen kenttiin
        $("#name").val(response.name)
        $("#role").val(response.role)
        $("#icon").val(response.icon)
        $("#update_id").val(response.id)

        // Näytä modaali, jossa tiedot on asetettu
        $("#categoryModel").modal("show")
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

function deleteCategoryInfo(id) {
  let sendingData = {
    action: "delete_category_info",
    id: id,
  }
  $.ajax({
    method: "POST",
    dataType: "JSON",
    url: "../api/category.php",
    data: sendingData,
    success: function (data) {
      let status = data.status
      let response = data.data
      if (status) {
        Swal.fire("Good job!", response, "success")
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
$("#categoryTable").on("click", ".update_info", function () {
  console.log("clicked")
  let id = $(this).data("update_id") // Hae id data-attribuutista

  // Kutsu fetchCategoryInfo-funktiota annetulla id:llä
  fetchCategoryInfo(id)
})

// delete
$("#categoryTable").on("click", ".delete_info", function () {
  let id = $(this).data("delete_id") // Hae id data-attribuutista

  if (confirm("Oletko varma että haluat poistaa?")) {
    // Kutsu deleteCategoryInfo-funktiota annetulla id:llä
    deleteCategoryInfo(id)
  }
})
