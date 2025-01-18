<?php

include_once('db.php');
include_once('model.php');
//include_once('test.php');

$conn = get_connect();

// Uncomment to see data in db
//run_db_test($conn);
?>
    
<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User transactions information</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <h1>User transactions information</h1>
  <form>
    <label for="user">Select user:</label>
    <select name="user" id="user">
    <?php
    $conn = get_connect();
    $users = get_users($conn);
    foreach ($users as $id => $name) {
        echo "<option value=\"$id\">".$name."</option>";
    }
    ?>
    </select>
    <input id="submit" type="submit" value="Show">
  </form>

  <div id="data">
      <h2>Transactions</h2>
      <table>
          <thead>
              <tr><th>Month</th><th>Balance</th></tr>
          </thead>
          <tbody>
              <!-- Rows will be inserted here by JavaScript -->
          </tbody>
      </table>
  </div>  
<script src="script.js"></script>
</body>
</html>
