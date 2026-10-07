/* ============================================================
   KIPLA Calendar & Activity Schedule 2026–2027
   Renders the printed family calendar flyer (KIPLA #1 and
   KIPLA #2) as month cards: event list + highlighted mini
   calendar grid. Red = closed/break, blue = academic,
   yellow = special events.
   ============================================================ */
(function () {
  "use strict";

  /* ---- Location #1 calendar data (July 2026 – June 2027) ---- */
  var CAL_1 = [
    { y: 2026, m: "July", n: 7, ev: [
      { t: "Sneak-a-Peek", d: "July 9", r: [[9, 9]], c: "yellow" },
      { t: "Leadership Development", d: "July 27–28", r: [[27, 28]], c: "blue" },
      { t: "Teacher’s 1st Week", d: "July 29–31", r: [[29, 31]], c: "blue" }
    ]},
    { y: 2026, m: "August", n: 8, ev: [
      { t: "Leadership Development", d: "Aug 1", r: [[1, 1]], c: "blue" },
      { t: "1st Day of School", d: "Aug 3", r: [[3, 3]], c: "blue" },
      { t: "Assessment", d: "Aug 10–14", r: [[10, 14]], c: "blue" },
      { t: "All About Me", d: "Aug 17–21", r: [[17, 21]], c: "yellow" },
      { t: "Make-Fruit Salad", d: "Aug 28", r: [[28, 28]], c: "yellow" },
      { t: "Friendship Picnic", d: "Aug 28", r: [[28, 28]], c: "yellow" }
    ]},
    { y: 2026, m: "September", n: 9, ev: [
      { t: "Grandparents Recognition", d: "Sept 11", r: [[11, 11]], c: "yellow" },
      { t: "Teacher Workday", d: "Sept 25", r: [[25, 25]], c: "blue" }
    ]},
    { y: 2026, m: "October", n: 10, ev: [
      { t: "Georgia Pre-K Week", d: "Oct 5–9", r: [[5, 9]], c: "blue" },
      { t: "Assessment", d: "Oct 12–16", r: [[12, 16]], c: "blue" },
      { t: "Trunk-or-Treat", d: "Oct 29", r: [[29, 29]], c: "yellow" },
      { t: "Fall Festival & Petting Zoo", d: "Oct 30", r: [[30, 30]], c: "yellow" }
    ]},
    { y: 2026, m: "November", n: 11, ev: [
      { t: "Teacher Workday", d: "Nov 3", r: [[3, 3]], c: "blue" },
      { t: "Assessment", d: "Nov 9–13", r: [[9, 13]], c: "blue" },
      { t: "Thanksgiving Luncheon", d: "Nov 20", r: [[20, 20]], c: "yellow" },
      { t: "Thanksgiving Break — Academy Closed", d: "Nov 23–27", r: [[23, 27]], c: "red" }
    ]},
    { y: 2026, m: "December", n: 12, ev: [
      { t: "Conferences Week", d: "Dec 7–11", r: [[7, 11]], c: "blue" },
      { t: "Winter Wonderland", d: "Dec 17", r: [[17, 17]], c: "yellow" },
      { t: "Secret Santa", d: "Dec 18", r: [[18, 18]], c: "yellow" },
      { t: "Winter Break — Academy Closed", d: "Dec 21–Jan 2", r: [[21, 31]], c: "red" }
    ]},
    { y: 2027, m: "January", n: 1, ev: [
      { t: "Teacher Workday", d: "Jan 4", r: [[4, 4]], c: "blue" },
      { t: "Assessment", d: "Jan 5–8", r: [[5, 8]], c: "blue" },
      { t: "Career Month", d: "Jan 11–15", r: [[11, 15]], c: "yellow" },
      { t: "MLK Day — Academy Closed", d: "Jan 18", r: [[18, 18]], c: "red" },
      { t: "100 Days Celebration", d: "Jan 29", r: [[29, 29]], c: "yellow" },
      { t: "Fire Station Visit", d: "TBA", r: [], c: "yellow" }
    ]},
    { y: 2027, m: "February", n: 2, ev: [
      { t: "Muffins & Donuts", d: "Feb 12", r: [[12, 12]], c: "yellow" },
      { t: "Pre-K Break", d: "Feb 15–19", r: [[15, 19]], c: "red" },
      { t: "Teacher Workday", d: "Feb 19", r: [[19, 19]], c: "blue" },
      { t: "Black History Program", d: "Feb 26", r: [[26, 26]], c: "yellow" }
    ]},
    { y: 2027, m: "March", n: 3, ev: [
      { t: "Dr. Seuss Read Across America", d: "Mar 1–5", r: [[1, 5]], c: "yellow" },
      { t: "Easter Egg Hunt", d: "Mar 25", r: [[25, 25]], c: "yellow" },
      { t: "Good Friday — Academy Closed", d: "Mar 26", r: [[26, 26]], c: "red" },
      { t: "Assessment", d: "Mar 29–Apr 2", r: [[29, 31]], c: "blue" },
      { t: "Picture Day / Library Trip", d: "TBA", r: [], c: "yellow" }
    ]},
    { y: 2027, m: "April", n: 4, ev: [
      { t: "Spring Break — Academy Closed", d: "Apr 5–9", r: [[5, 9]], c: "red" },
      { t: "Conferences", d: "Apr 12–16", r: [[12, 16]], c: "blue" },
      { t: "Parent-Teacher Visits", d: "TBA", r: [], c: "yellow" },
      { t: "Kindergarten Visit", d: "TBA", r: [], c: "yellow" },
      { t: "Field Trip", d: "TBA", r: [], c: "yellow" }
    ]},
    { y: 2027, m: "May", n: 5, ev: [
      { t: "Summer Camp Registration", d: "May 3", r: [[3, 3]], c: "yellow" },
      { t: "Teacher Appreciation", d: "May 3–7", r: [[3, 7]], c: "yellow" },
      { t: "C. Group AM & PM", d: "May 14", r: [[14, 14]], c: "yellow" },
      { t: "Cultural Arts / Speaking", d: "TBA", r: [], c: "yellow" },
      { t: "Pre-K Last Day", d: "May 28", r: [[28, 28]], c: "yellow" },
      { t: "Teacher Workday", d: "May 28", r: [[28, 28]], c: "blue" }
    ]},
    { y: 2027, m: "June", n: 6, ev: [
      { t: "Summer Camp", d: "June 1–July 23", r: [[1, 30]], c: "blue" }
    ]}
  ];

  /* ---- Location #2: same schedule with the noted differences ---- */
  var CAL_2 = JSON.parse(JSON.stringify(CAL_1));
  CAL_2[0].ev[0] = { t: "Pre-K 1 & 2 Sneak-a-Peek Orientation (at KIPLA #1), 1:00 PM", d: "July 9", r: [[9, 9]], c: "yellow" };
  CAL_2[4].ev[2] = { t: "Thanksgiving Lunch / Drive", d: "Nov 20", r: [[20, 20]], c: "yellow" };
  CAL_2[10].ev[2] = { t: "C. Group AM & PM", d: "May 6", r: [[6, 6]], c: "yellow" };

  var CALENDARS = { "1": CAL_1, "2": CAL_2 };

  /* ---- rendering ---- */
  var PRIORITY = { red: 3, blue: 2, yellow: 1 };
  var WEEKDAYS = ["S", "M", "T", "W", "T", "F", "S"];

  function renderMonth(month) {
    var first = new Date(month.y, month.n - 1, 1);
    var total = new Date(month.y, month.n, 0).getDate();
    var offset = first.getDay();

    // day -> highlight color (red beats blue beats yellow)
    var hl = {};
    month.ev.forEach(function (e) {
      e.r.forEach(function (range) {
        for (var day = range[0]; day <= range[1]; day++) {
          if (!hl[day] || PRIORITY[e.c] > PRIORITY[hl[day]]) hl[day] = e.c;
        }
      });
    });

    var head = WEEKDAYS.map(function (w) { return "<th>" + w + "</th>"; }).join("");
    var all = [];
    for (var i = 0; i < offset; i++) all.push("<td></td>");
    for (var d = 1; d <= total; d++) {
      var cls = hl[d] ? "cal-day is-" + hl[d] : "cal-day";
      all.push("<td><span class=\"" + cls + "\">" + d + "</span></td>");
    }
    while (all.length % 7 !== 0) all.push("<td></td>");

    var rows = "";
    for (var r = 0; r < all.length; r += 7) rows += "<tr>" + all.slice(r, r + 7).join("") + "</tr>";

    var events = month.ev.map(function (e) {
      return "<li class=\"e-" + e.c + "\"><span><strong>" + e.d + "</strong> · " + e.t + "</span></li>";
    }).join("");

    return (
      "<div class=\"cal-month\">" +
        "<div class=\"cal-month__head\">" +
          "<img src=\"/kipla-preview/sunflower.png\" alt=\"\" />" +
          "<h3>" + month.m + " " + month.y + "</h3>" +
        "</div>" +
        "<div class=\"cal-month__body\">" +
          "<table class=\"cal-grid\"><thead><tr>" + head + "</tr></thead><tbody>" + rows + "</tbody></table>" +
          "<ul class=\"cal-events\">" + events + "</ul>" +
        "</div>" +
      "</div>"
    );
  }

  function renderCalendar(key) {
    var container = document.getElementById("cal-months");
    if (!container) return;
    container.innerHTML = CALENDARS[key].map(renderMonth).join("");
  }

  /* ---- location toggle ---- */
  document.querySelectorAll(".cal-tab").forEach(function (tab) {
    tab.addEventListener("click", function () {
      document.querySelectorAll(".cal-tab").forEach(function (t) {
        t.classList.remove("is-active");
        t.setAttribute("aria-selected", "false");
      });
      tab.classList.add("is-active");
      tab.setAttribute("aria-selected", "true");
      renderCalendar(tab.getAttribute("data-cal"));
    });
  });

  renderCalendar("1");
})();
