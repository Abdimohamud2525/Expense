$("#loginForm").on("submit", function (event) {
  event.preventDefault()
  login()
})

function login() {
  let username = $("#username").val()
  let password = $("#password").val()
  let sendingData = {
    action: "login",
    username: username,
    password: password,
  }

  $.ajax({
    method: "POST",
    dataType: "json",
    url: "../api/login.php",
    data: sendingData,
    success: function (data) {
      let status = data.status
      let response = data.data

      if (status) {
        window.location.href = "../views/dashboard.php"
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
function displayMessage(type, message) {
  let sucess = document.querySelector(".alert-success")
  let error = document.querySelector(".alert-danger")
  if (type == "success") {
    error.classList = "alert alert-danger d-none"
    sucess.classList = "alert alert-success"
    sucess.innerHTML = message

    //   setTimeout(function () {
    //     $("#kulutModel").modal("hide")
    //     sucess.classList = "alert alert-success d-none"
    //     $("#kulutForm")[0].reset()
    //   }, 3000)

    sucess.classList = "alert alert-success d-none"

    $("#password").val("")
  } else {
    error.classList = "alert alert-danger"
    error.innerHTML = message
    $("#password").val("")
  }
}
