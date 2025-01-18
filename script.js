const submit_btn = document.getElementById("submit");
const data_table = document.getElementById("data");

submit_btn.onclick = function (e) {
  e.preventDefault();
  const user_id = document.getElementById("user").value;

  fetch(`data.php?user=${user_id}`)
    .then((response) => response.json())
    .then((data) => {
      const table = data_table.querySelector("table");
      const tbody = table.querySelector("tbody") || table.createTBody();
      tbody.innerHTML = "";

      data.forEach((row) => {
        const tr = document.createElement("tr");
        const tdMonth = document.createElement("td");
        const tdBalance = document.createElement("td");

        tdMonth.textContent = row.month;
        tdBalance.textContent = row.balance;

        tr.appendChild(tdMonth);
        tr.appendChild(tdBalance);
        tbody.appendChild(tr);
      });

      data_table.style.display = "block";
    })
    .catch((error) => console.error("Error:", error));
};
