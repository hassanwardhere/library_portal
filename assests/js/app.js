// // Graph
// var ctx = document.getElementById("myChart");

// var myChart = new Chart(ctx, {
//   type: "line",
//   data: {
//     labels: [
//       "Sunday",
//       "Monday",
//       "Tuesday",
//       "Wednesday",
//       "Thursday",
//       "Friday",
//       "Saturday",
//     ],
//     datasets: [
//       {
//         data: [15339, 21345, 18483, 24003, 23489, 24092, 12034],
//         lineTension: 0,
//         backgroundColor: "transparent",
//         borderColor: "#007bff",
//         borderWidth: 4,
//         pointBackgroundColor: "#007bff",
//       },
//     ],
//   },
//   options: {
//     scales: {
//       yAxes: [
//         {
//           ticks: {
//             beginAtZero: false,
//           },
//         },
//       ],
//     },
//     legend: {
//       display: false,
//     },
//   },
// });

let sidebarLinks = document.querySelectorAll('#alllinks');

sidebarLinks.forEach((link) => {
    link.addEventListener('click', function() {
        // Remove active class from all links
        sidebarLinks.forEach((link) => {
            link.classList.remove('active');
        });
        // Add active class to the clicked link
        this.classList.add('active');
    });
});