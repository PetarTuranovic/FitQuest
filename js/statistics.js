document.addEventListener("DOMContentLoaded", function () {
  const filterForm = document.getElementById("filter-form");

  filterForm.addEventListener("submit", function (e) {
    e.preventDefault();

    const month = document.querySelector("#month").value;
    const year = document.querySelector("#year").value;

    const xhr = new XMLHttpRequest();
    xhr.open("POST", "statistics.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onreadystatechange = function () {
      if (xhr.readyState === XMLHttpRequest.DONE) {
        if (xhr.status === 200) {
          document.querySelector(".training-data").innerHTML = xhr.responseText;
        } else {
          console.error("Error:", xhr.statusText);
        }
      }
    };

    xhr.send(
      "month=" + encodeURIComponent(month) + "&year=" + encodeURIComponent(year)
    );
  });
});
