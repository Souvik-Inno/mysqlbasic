<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Queries Result</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <div class="query-container container">
    <?php

      require("classes/classFormData.php");
      $data = new FormData();
      $data->connectDB();

      echo "1. list all employee first name with salary greater than 50k.<br>";
      $query = "SELECT employee_details_table.employee_first_name, employee_salary_table.employee_salary
      FROM employee_details_table
      JOIN employee_salary_table
      ON employee_details_table.employee_id = employee_salary_table.employee_id
      AND employee_salary_table.employee_salary > '50k';";
      $result = $data->conn->query($query);
      $res = $result->fetchAll();
      ?>
      <table>
        <tr>
          <th>employee_first_name</th>
          <th>employee_salary</th>
        </tr>
        <?php
        foreach ($res as $row) {
          echo "<tr>";
          echo "<td>" . $row['employee_first_name'] . "</td>";
          echo "<td>" . $row['employee_salary'] . "</td>";
          echo "</tr>";
        }
        ?>
      </table>
      <br>
      <?php

      echo "2. list all employee last name with graduation percentile greater than 70%.<br>";
      $query = "SELECT employee_last_name, graduation_percentage
      from employee_details_table
      where graduation_percentage > '70%';";
      $result = $data->conn->query($query);
      $res = $result->fetchAll();
      ?>
      <table>
        <tr>
          <th>employee_last_name</th>
          <th>graduation_percentage</th>
        </tr>
        <?php
        foreach ($res as $row) {
          echo "<tr>";
          echo "<td>" . $row['employee_last_name'] . "</td>";
          echo "<td>" . $row['graduation_percentage'] . "</td>";
          echo "</tr>";
        }
        ?>
      </table>
      <br>
      <?php
      echo "3. list all employee code name with graduation percentile less than 70%.<br>";
      $query = "SELECT employee_code_table.employee_code_name, emp_table.graduation_percentage
      FROM (select details.employee_id, salary.employee_code, details.graduation_percentage FROM employee_details_table as details JOIN employee_salary_table as salary on details.employee_id = salary.employee_id) as emp_table
      join employee_code_table
      on emp_table.employee_code = employee_code_table.employee_code
      and emp_table.graduation_percentage < '70%';";
      $result = $data->conn->query($query);
      $res = $result->fetchAll();
      ?>
      <table>
        <tr>
          <th>employee_code_name</th>
          <th>graduation_percentage</th>
        </tr>
        <?php
        foreach ($res as $row) {
          echo "<tr>";
          echo "<td>" . $row['employee_code_name'] . "</td>";
          echo "<td>" . $row['graduation_percentage'] . "</td>";
          echo "</tr>";
        }
        ?>
      </table>
      <br>
      <?php

      echo "4. list all employees full name that are not of domain Java.<br>";
      $query = "SELECT emp_table.fullname, employee_code_table.employee_domain
      from (select details.employee_id, CONCAT(details.employee_first_name, ' ', details.employee_last_name) AS fullname , salary.employee_code from employee_details_table as details JOIN employee_salary_table as salary on details.employee_id = salary.employee_id) as emp_table
      join employee_code_table
      on emp_table.employee_code = employee_code_table.employee_code
      and employee_code_table.employee_domain <> 'Java';";
      $result = $data->conn->query($query);
      $res = $result->fetchAll();
      ?>
      <table>
        <tr>
          <th>fullname</th>
          <th>employee_domain</th>
        </tr>
        <?php
        foreach ($res as $row) {
          echo "<tr>";
          echo "<td>" . $row['fullname'] . "</td>";
          echo "<td>" . $row['employee_domain'] . "</td>";
          echo "</tr>";
        }
        ?>
      </table>
      <br>
      <?php

      echo "5. list all employee_domain with sum of it's salary.<br>";
      $query = "SELECT employee_code_table.employee_domain, sum(employee_salary_table.employee_salary) as emp_salary_sum
      from employee_code_table
      join employee_salary_table
      on employee_code_table.employee_code = employee_salary_table.employee_code
      GROUP BY employee_code_table.employee_domain;";
      $result = $data->conn->query($query);
      $res = $result->fetchAll();
      ?>
      <table>
        <tr>
          <th>employee_domain</th>
          <th>emp_salary_sum</th>
        </tr>
        <?php
        foreach ($res as $row) {
          echo "<tr>";
          echo "<td>" . $row['employee_domain'] . "</td>";
          echo "<td>" . $row['emp_salary_sum'] . "</td>";
          echo "</tr>";
        }
        ?>
      </table>
      <br>
      <?php

      echo "6. Write the above query again but dont include salaries which is less than 30k.<br>";
      $query = "SELECT employee_code_table.employee_domain, sum(employee_salary_table.employee_salary) as emp_salary_sum
      from employee_code_table
      join employee_salary_table
      on employee_code_table.employee_code = employee_salary_table.employee_code
      and employee_salary_table.employee_salary >= '30k'
      GROUP BY employee_code_table.employee_domain;";
      $result = $data->conn->query($query);
      $res = $result->fetchAll();
      ?>
      <table>
        <tr>
          <th>employee_domain</th>
          <th>emp_salary_sum</th>
        </tr>
        <?php
        foreach ($res as $row) {
          echo "<tr>";
          echo "<td>" . $row['employee_domain'] . "</td>";
          echo "<td>" . $row['emp_salary_sum'] . "</td>";
          echo "</tr>";
        }
        ?>
      </table>
      <br>
      <?php

      echo "7. list all employee id which has not been assigned employee code.<br>";
      $query = "SELECT employee_details_table.employee_id
      from employee_details_table
      JOIN employee_salary_table
      on employee_details_table.employee_id = employee_salary_table.employee_id
      and (employee_salary_table.employee_code = '' or employee_salary_table.employee_code = NULL);";
      $result = $data->conn->query($query);
      $res = $result->fetchAll();
      ?>
      <table>
        <tr>
          <th>employee_id</th>
        </tr>
        <?php
        foreach ($res as $row) {
          echo "<tr>";
          echo "<td>" . $row['employee_id'] . "</td>";
          echo "</tr>";
        }?>
      </table>
  </div>
</body>

</html>

