const lineChart = document.getElementById("myChart-left");

new Chart(lineChart, {
  type: "line",
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
      "Sept",
      "Oct",
      "Nov",
      "Dec",
    ],
    datasets: [
      {
        label: "Snacks",
        data: [100, 321, 213, 653, 230, 802, 89, 872, 430, 801, 574, 700],
        borderWidth: 1,
      },
      {
        label: "Beverages",
        data: [31, 543, 763, 312, 543, 876, 123, 542, 876, 233, 546, 768],
        borderWidth: 1,
      },
      {
        label: "Sandwiches",
        data: [432, 745, 432, 765, 123, 564, 785, 234, 867, 32, 674, 784],
        borderWidth: 1,
      },
      {
        label: "Desserts",
        data: [421, 451, 645, 765, 977, 234, 765, 213, 644, 876, 133, 543],
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
    // labels: ["Sun", "Mon", "Tue", "Wed", "Thur", "Fri", "Sat"],
    labels: [
      "Jan",
      "Feb",
      "Mar",
      "Apr",
      "May",
      "Jun",
      "Jul",
      "Aug",
      "Sept",
      "Oct",
      "Nov",
      "Dec",
    ],
    datasets: [
      {
        label: "Snacks",
        data: [100, 321, 213, 653, 230, 802, 89, 872, 430, 801, 574, 700],
        borderWidth: 1,
      },
      {
        label: "Beverages",
        data: [31, 543, 763, 312, 543, 876, 123, 542, 876, 233, 546, 768],
        borderWidth: 1,
      },
      {
        label: "Sandwiches",
        data: [432, 745, 432, 765, 123, 564, 785, 234, 867, 32, 674, 784],
        borderWidth: 1,
      },
      {
        label: "Desserts",
        data: [421, 451, 645, 765, 977, 234, 765, 213, 644, 876, 133, 543],
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
