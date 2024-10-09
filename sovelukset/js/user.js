$(document).ready(function () {
  loadUserData()

  // Näytetään modal rekisteröintiä varten
  $("#AddNew").on("click", function () {
    $("#userModel").modal("show")
  })

  // Käsitellään rekisteröintilomakkeen lähetys
  $("#userForm").submit(function (event) {
    event.preventDefault()

    let form_data = new FormData($("#userForm")[0])
    form_data.append("image", $("input[type=file]")[0].files[0])
    form_data.append("action", "userRegistered")

    $.ajax({
      method: "POST",
      dataType: "json",
      url: "../api/user.php",
      data: form_data,
      processData: false,
      contentType: false,
      success: function (data) {
        let status = data.status
        let response = data.data

        if (status) {
          displayMessage("success", response)
          loadUserData()
        } else {
          displayMessage("error", response)
        }
      },
      error: function (data) {
        console.log(data)
      },
    })
  })
})

// Näytetään viesti
function displayMessage(type, message) {
  let success = $(".alert-success")
  let error = $(".alert-danger")

  if (type === "success") {
    error.addClass("d-none")
    success.removeClass("d-none").text(message)

    setTimeout(function () {
      $("#userModel").modal("hide")
      success.addClass("d-none")
      $("#userForm")[0].reset()
    }, 3000)
  } else {
    error.removeClass("d-none").text(message)
  }
}

// Ladataan käyttäjädata
function loadUserData() {
  $("#userTable tbody").html("")
  $.ajax({
    method: "POST",
    dataType: "json",
    url: "../api/user.php",
    data: { action: "getUserList" },
    success: function (data) {
      let status = data.status
      let response = data.data

      if (status) {
        let tr = ""
        response.forEach((res) => {
          tr += "<tr>"
          tr += `<td>${res.id}</td>`
          tr += `<td>${res.username}</td>`
          tr += `<td>${res.status}</td>`
          tr += `<td>${res.date}</td>`
          tr += `<td><img src="../uploads/${res.image}" alt="${res.username}'s image" style="border-radius: 50%; width: 50px; height: 50px;"></td>`
          tr += `<td><a href="#" class="btn btn-info update_info" data-update_id="${res.id}"><i class="fa-solid fa-pen"></i></a></td>`
          tr += `<td><a href="#" class="btn btn-danger delete_info" data-delete_id="${res.id}"><i class="fa-solid fa-trash"></i></a></td>`
          tr += "</tr>"
        })

        $("#userTable tbody").html(tr)
      }
    },
    error: function (error) {
      console.log(error)
    },
  })
}

function fetchUserInfo(id) {
  let sendingData = {
    action: "get_user_info",
    id: id,
  }

  $.ajax({
    method: "POST",
    dataType: "json",
    url: "../api/user.php",
    data: sendingData,
    success: function (data) {
      let status = data.status
      let response = data.data

      if (status) {
        // Aseta lomaketiedot
        $("#updateId").val(response.id)
        $("#updateUsername").val(response.username)
        $("#updateStatus").val(response.status)
        // Näytä modal
        $("#updateUserModel").modal("show")
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

$("#userTable").on("click", ".update_info", function () {
  let id = $(this).data("update_id") // Hae id data-attribuutista
  // Kutsu fetchUserInfo-funktiota annetulla id:llä
  fetchUserInfo(id)
})

// Päivitä käyttäjän tiedot
$("#updateUserForm").submit(function (event) {
  event.preventDefault()

  let form_data = {
    id: $("#updateId").val(),
    username: $("#updateUsername").val(),
    status: $("#updateStatus").val(),
    action: "updateUser",
  }

  $.ajax({
    method: "POST",
    dataType: "json",
    url: "../api/user.php",
    data: form_data,
    success: function (data) {
      let status = data.status
      let response = data.data

      if (status) {
        displayMessage("success", response)
        loadUserData()
      } else {
        displayMessage("error", response)
      }
    },
    error: function (data) {
      console.log(data)
    },
  })
})

// Poista käyttäjä
function deleteUser(id) {
  let sendingData = {
    action: "deleteUser",
    id: id,
  }

  $.ajax({
    method: "POST",
    dataType: "json",
    url: "../api/user.php",
    data: sendingData,
    success: function (data) {
      let status = data.status
      let response = data.data

      if (status) {
        displayMessage("success", response)
        loadUserData()
      } else {
        displayMessage("error", response)
      }
    },
    error: function (xhr, status, error) {
      console.log("AJAX error:", error)
    },
  })
}

$("#userTable").on("click", ".delete_info", function () {
  let id = $(this).data("delete_id") // Hae id data-attribuutista

  if (confirm("Oletko varma että haluat poistaa?"))
    // Kutsu deleteUser-funktiota annetulla id:llä
    deleteUser(id)
})
