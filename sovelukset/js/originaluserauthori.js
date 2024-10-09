loadData()
function loadData() {
  let sendingData = {
    action: "read_All_authority_system",
  }

  $.ajax({
    method: "POST",
    dataType: "json",
    url: "../api/user_authority.php",
    data: sendingData,
    success: function (data) {
      console.log("Data received: ", data)
      let status = data.status
      let response = data.data
      let html = ""
      let role = ""

      if (status) {
        response.forEach((res) => {
          if (res["role"] !== role) {
            // Close previous fieldset if any
            if (role !== "") {
              html += "</fieldset></div></div>"
            }

            // Start new fieldset
            html += `
              <div class="col-sm-4">
                <fieldset class="authority-border">
                  <legend class="authority-border">
                    <input type="checkbox" class="role-checkbox" name="">
                    ${res["role"]}
                  </legend>`

            role = res["role"]
          }
        })
        $("#authorityArea").html(html)
      }
    },
    error: function (error) {
      console.log("error", error)
    },
  })
}
