const lineChart = document.getElementById("myChart-left");

new Chart(lineChart, {
  type: "line",
  data: {
    labels: ["Sun", "Mon", "Tue", "Wed", "Thur", "Fri", "Sat"],
    datasets: [
      {
        label: "N/A",
        data: [120, 190, 300, 500, 240, 350, 140],
        borderWidth: 1,
      },
      {
        label: "N/A",
        data: [320, 420, 200, 50, 150, 230, 90],
        borderWidth: 1,
      },
      {
        label: "N/A",
        data: [70, 110, 350, 260, 80, 430, 430],
        borderWidth: 1,
      },
    ],
  },
  options: {
    scales: {
      y: {
        beginAtZero: true,
      },
    },
  },
});

const barChart = document.getElementById("myChart-right");

new Chart(barChart, {
  type: "bar",
  data: {
    labels: ["Sun", "Mon", "Tue", "Wed", "Thur", "Fri", "Sat"],
    datasets: [
      {
        label: "N/A",
        data: [1200, 3190, 3324, 5424, 2554, 3000, 8000],
        borderWidth: 1,
      },
      {
        label: "N/A",
        data: [2320, 3420, 1200, 4130, 3150, 5230, 3390],
        borderWidth: 1,
      },
      {
        label: "N/A",
        data: [2570, 4160, 4450, 860, 2380, 4350, 6330],
        borderWidth: 1,
      },
    ],
  },
  options: {
    scales: {
      y: {
        beginAtZero: true,
      },
    },
  },
});
