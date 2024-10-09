loadData()
btnAction = "Insert"
fill_all_links()
fill_all_category()

$("#AddNew").on("click", function () {
  $("#linkModel").modal("show")
})

$("#linkForm").submit(function (event) {
  event.preventDefault()

  let name = $("#name").val()
  let link_id = $("#link_id").val()
  let category_id = $("#category_id").val()
  let id = $("#update_id").val()
  let sendingData = {}
  if (btnAction == "Insert") {
    sendingData = {
      id: id,
      name: name,
      link: link_id,
      category_id: category_id,
      action: "Registeration_link",
    }
  } else {
    sendingData = {
      id: id,
      name: name,
      link: link_id,
      action: "update_system_link",
      category_id: category_id,
    }
  }

  $.ajax({
    method: "POST",
    dataType: "json",
    url: "../api/system_links.php",
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
      $("#linkModel").modal("hide")
      success.classList = "alert alert-success d-none"
      $("#linkForm")[0].reset()
    }, 3000)
  } else {
    error.classList = "alert alert-danger"
    error.innerHTML = message
  }
}

function loadData() {
  let sendingData = {
    action: "read_all_db_system",
  }

  $.ajax({
    method: "POST",
    dataType: "json",
    url: "../api/system_links.php",
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
        $("#linkTable tbody").append(tr) // Lisätään koko `<tr>` sisältö `<tbody>`-elementtiin
      }
    },
    error: function (error) {
      console.log("error", error)
    },
  })
}
function fill_all_links() {
  let sendingData = {
    action: "read_all_system_links",
  }

  $.ajax({
    method: "POST",
    dataType: "json",
    url: "../api/system_links.php",
    data: sendingData,
    success: function (data) {
      let status = data.status
      let response = data.data
      let html = ""

      if (status) {
        response.forEach((res) => {
          html += `<option value="${res}">${res}</option>`
        })
        $("#link_id").append(html)
      }
    },
    error: function (error) {
      console.log("error", error)
    },
  })
}
function fill_all_category() {
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
      let html = ""

      if (status) {
        response.forEach((res) => {
          html += `<option value="${res["id"]}">${res["name"]}</option>`
        })
        $("#category_id").append(html)
      }
    },
    error: function (error) {
      console.log("error", error)
    },
  })
}

function fetchlinkInfo(id) {
  let sendingData = {
    action: "getUserList",
    id: id,
  }

  $.ajax({
    method: "POST",
    dataType: "json",
    url: "../api/system_links.php",
    data: sendingData,
    success: function (data) {
      let status = data.status
      let response = data.data

      if (status) {
        // Aseta btnAction "Update" tilaan
        btnAction = "Update"
        // Aseta vastauksen tiedot lomakkeen kenttiin
        $("#name").val(response.name)
        $("#link").val(response.link)
        $("#category_id").val(response.category_id)
        $("#update_id").val(response.id)

        // Näytä modaali, jossa tiedot on asetettu
        $("#linkModel").modal("show")
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

function deletelinkInfo(id) {
  let sendingData = {
    action: "delete_link_info",
    id: id,
  }
  $.ajax({
    method: "POST",
    dataType: "JSON",
    url: "../api/system_links.php",
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
$("#linkTable").on("click", ".update_info", function () {
  console.log("clicked")
  let id = $(this).data("update_id") // Hae id data-attribuutista

  // Kutsu fetchlinkInfo-funktiota annetulla id:llä
  fetchlinkInfo(id)
})

// delete
$("#linkTable").on("click", ".delete_info", function () {
  let id = $(this).data("delete_id") // Hae id data-attribuutista

  if (confirm("Oletko varma että haluat poistaa?")) {
    // Kutsu deletelinkInfo-funktiota annetulla id:llä
    deletelinkInfo(id)
  }
})
