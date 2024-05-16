// $(document).ready(function () {
//   makeCalendar(currentYear, currentMonth, availableDates);
// });
// const months = [
//   { id: 1, name: 'Jan' },
//   { id: 2, name: 'Feb' },
//   { id: 3, name: 'Mar' },
//   { id: 4, name: 'Apr' },
//   { id: 5, name: 'May' },
//   { id: 6, name: 'Jun' },
//   { id: 7, name: 'Jul' },
//   { id: 8, name: 'Aug' },
//   { id: 9, name: 'Sep' },
//   { id: 10, name: 'Oct' },
//   { id: 11, name: 'Nov' },
//   { id: 12, name: 'Dec' },
// ];
// var currentYear = new Date().getFullYear();
// var currentMonth = new Date().getMonth() + 1;

// function letsCheck(year, month) {
//   var daysInMonth = new Date(year, month, 0).getDate();
//   var firstDay = new Date(year, month, 1).getUTCDay();
//   var array = {
//     daysInMonth: daysInMonth,
//     firstDay: firstDay,
//   };
//   return array;
// }

// function makeCalendar(year, month, availableDates) {
//   var getChek = letsCheck(year, month);
//   getChek.firstDay === 0 ? (getChek.firstDay = 7) : getChek.firstDay;
//   $('#calendarList').empty();
//   for (let i = 1; i <= getChek.daysInMonth; i++) {
//     var isAvailable = isDateAvailable(year, month, i, availableDates);

//     if (i === 1) {
//       var div =
//         '<li onclick="tes()" id="' +
//         i +
//         '" style="grid-column-start: ' +
//         getChek.firstDay +
//         ';"><span class="' +
//         (isAvailable ? 'available' : 'not-available') +
//         '">1</span></li>';
//     } else {
//       var div =
//         '<li onclick="tes()" id="' +
//         i +
//         '" ><span class="' +
//         (isAvailable ? 'available' : 'not-available') +
//         '">' +
//         i +
//         '</span></li>';
//     }
//     $('#calendarList').append(div);
//   }
//   monthName = months.find((x) => x.id === month).name;
//   $('#yearMonth').text(monthName + ' ' + year);
// }

// function isDateAvailable(year, month, day, availableDates) {
//   var currentDate = new Date(year, month - 1, day);

//   for (var i = 0; i < availableDates.length; i++) {
//     var dateParts = availableDates[i].created_at.split(' ');
//     var date = dateParts[0];
//     var time = dateParts[1];

//     var availableDate = new Date(date + 'T' + time);

//     if (currentDate.toDateString() === availableDate.toDateString()) {
//       return true; // Day is available
//     }
//   }

//   return false; // Day is not available
// }

// function nextMonth() {
//   currentMonth = currentMonth + 1;
//   if (currentMonth > 12) {
//     currentYear = currentYear + 1;
//     currentMonth = 1;
//   }
//   $('#calendarList').empty();
//   $('#yearMonth').text(currentYear + ' ' + currentMonth);
//   makeCalendar(currentYear, currentMonth, availableDates);
// }

// function prevMonth() {
//   currentMonth = currentMonth - 1;
//   if (currentMonth < 1) {
//     currentYear = currentYear - 1;
//     currentMonth = 12;
//   }
//   $('#calendarList').empty();
//   $('#yearMonth').text(currentYear + ' ' + currentMonth);
//   makeCalendar(currentYear, currentMonth, availableDates);
// }

// // Example usage:
// var availableDates = [
//   { id: 1, created_at: '2023-12-12 03:11' },
//   { id: 2, created_at: '2023-12-14 03:11' },
//   { id: 3, created_at: '2024-01-04 03:11' },
// ];