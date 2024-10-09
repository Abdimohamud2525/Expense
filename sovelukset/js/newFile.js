$(document).ready(function () {
  // Aseta kaikki checkboxit valituksi tai ei-valituksi, kun #all-author on muutettu
  fillUsers()
  loadData()

  $("#userForm").submit(function (event) {
    event.preventDefault()

    let actions = []
    let user_id = $("#user_id").val()

    $("input[name='system_link[]']").each(function () {
      if ($(this).is(":checked")) {
        actions.push($(this).val())
      }
    })

    let sendingData = {
      user_id: user_id,
      authority_actions: actions,
      action: "Authorities_users",
    }

    $.ajax({
      method: "POST",
      dataType: "json",
      url: "../api/user_authority.php",
      data: sendingData,
      success: function (data) {
        let status = data.status
        let response = data.data

        if (status) {
          console.log(response)
        } else {
          console.log(response)
        }
      },
      error: function (error) {
        console.log("error", error) // Korjattu muuttujan nimi
      },
    })
  })

  $("#all-author").change(function () {
    if ($(this).is(":checked")) {
      $("input[type='checkbox']").prop("checked", true)
    } else {
      $("input[type='checkbox']").prop("checked", false)
    }
  })

  // Päivitä roolien valintatila
  $("#authorityArea").on(
    "change",
    "input[name='role_authority[]']",
    function () {
      let role = $(this).val()
      let checked = $(this).is(":checked")
      $(`input[role='${role}']`).prop("checked", checked)
    }
  )

  // Päivitä system_link checkboxit
  $("#authorityArea").on("change", "input[name='system_link[]']", function () {
    let value = $(this).val()
    if ($(this).is(":checked")) {
      $(`#authorityArea input[type='checkbox'][link_id='${value}']`).prop(
        "checked",
        true
      )
    } else {
      $(`#authorityArea input[type='checkbox'][link_id='${value}']`).prop(
        "checked",
        false
      )
    }
  })

  function fillUsers() {
    let sendingData = {
      action: "getUserList",
    }

    $.ajax({
      method: "POST",
      dataType: "json",
      url: "../api/user.php",
      data: sendingData,
      success: function (data) {
        let status = data.status
        let response = data.data
        let html = ""

        if (status) {
          html += `<option value="0">Select user</option>`
          response.forEach((res) => {
            html += `<option value="${res.id}">${res.username}</option>`
          })
          $("#user_id").append(html)
        }
      },
      error: function (error) {
        console.log("error", error)
      },
    })
  }

  // Lataa data ja luo checkboxit
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
        let system_links = ""
        let system_actions = ""

        if (status) {
          response.forEach((res) => {
            if (res.role !== role) {
              // Sulje edellinen fieldset, jos sellainen on
              if (role !== "") {
                html += "</fieldset></div></div>"
              }

              // Aloita uusi fieldset
              html += `
                <div class="col-sm-4">
                  <fieldset class="authority-border">
                    <legend class="authority-border">
                      <input type="checkbox" class="role-checkbox" name="role_authority[]" value="${res.role}">
                      ${res.role}
                    </legend>`

              role = res.role
            }

            // Lisää system_link
            if (res.name !== system_links) {
              html += `
                <div class="control-group" style="margin-left: 25px !important;">
                  <label class="control-label input-label">
                    <input type="checkbox" name="system_link[]" role="${res.role}" value="${res.link_id}" category_id="${res.category_id}" link_id="${res.link_id}" action_id="${res.action_id}">
                    ${res.name}
                  </label>
                </div>`
              system_links = res.name
            }

            // Lisää system_action
            if (res.action_name !== system_actions) {
              html += `
                <div class="system_action">
                  <label class="control-label input-label">
                    <input type="checkbox" name="system_link[]" role="${res.role}" value="${res.action_id}" category_id="${res.category_id}" link_id="${res.link_id}">
                    ${res.action_name}
                  </label>
                </div>`
              system_actions = res.action_name
            }
          })

          // Sulje viimeinen fieldset, jos sellainen on
          if (role !== "") {
            html += "</fieldset></div></div>"
          }

          $("#authorityArea").html(html)
        }
      },
      error: function (error) {
        console.log("error", error)
      },
    })
  }
})
