document.addEventListener("DOMContentLoaded", function () {
  const emailStatisticsCtx = document
    .getElementById("emailStatisticsChart")
    .getContext("2d")
  const userBehaviorCtx = document
    .getElementById("userBehaviorChart")
    .getContext("2d")
  const salesCtx = document.getElementById("salesChart").getContext("2d")

  new Chart(emailStatisticsCtx, {
    type: "pie",
    data: {
      labels: ["Open", "Bounce", "Unsubscribe"],
      datasets: [
        {
          data: [120, 50, 30],
          backgroundColor: ["#36A2EB", "#FF6384", "#FFCE56"],
        },
      ],
    },
    options: {
      responsive: true,
    },
  })

  new Chart(userBehaviorCtx, {
    type: "line",
    data: {
      labels: ["0h", "4h", "8h", "12h", "16h", "20h", "24h"],
      datasets: [
        {
          label: "Open",
          data: [12, 19, 3, 5, 2, 3, 7],
          borderColor: "#36A2EB",
          fill: false,
        },
        {
          label: "Click",
          data: [2, 3, 20, 5, 1, 4, 9],
          borderColor: "#FF6384",
          fill: false,
        },
        {
          label: "Click Second Time",
          data: [3, 10, 13, 15, 22, 30, 35],
          borderColor: "#FFCE56",
          fill: false,
        },
      ],
    },
    options: {
      responsive: true,
    },
  })

  new Chart(salesCtx, {
    type: "bar",
    data: {
      labels: [
        "Jan",
        "Feb",
        "Mar",
        "Apr",
        "May",
        "Jun",
        "Jul",
        "Aug",
        "Sep",
        "Oct",
        "Nov",
        "Dec",
      ],
      datasets: [
        {
          label: "Tesla Model S",
          data: [65, 59, 80, 81, 56, 55, 40, 65, 59, 80, 81, 56],
          backgroundColor: "#36A2EB",
        },
        {
          label: "BMW 5 Series",
          data: [28, 48, 40, 19, 86, 27, 90, 28, 48, 40, 19, 86],
          backgroundColor: "#FF6384",
        },
      ],
    },
    options: {
      responsive: true,
    },
  })
})
