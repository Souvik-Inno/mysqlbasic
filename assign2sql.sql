-- Active: 1677580942812@@127.0.0.1@3306@assign2
CREATE DATABASE assign2;
show databases;
USE assign2;

-- Creating table em
create Table employee_code_table(
  employee_code VARCHAR(255),
  employee_code_name VARCHAR(255),
  employee_domain VARCHAR(255),
  PRIMARY KEY (employee_code)
);
CREATE Table employee_salary_table(
  employee_id VARCHAR(255),
  employee_salary VARCHAR(3),
  employee_code VARCHAR(255),
  PRIMARY KEY (employee_id),
  Foreign Key (employee_code) REFERENCES employee_code_table(employee_code)
);
CREATE Table employee_details_table(
  employee_id VARCHAR(255),
  employee_first_name VARCHAR(255),
  employee_last_name VARCHAR(255),
  graduation_percentage VARCHAR(3),
  PRIMARY KEY (employee_id)
);

show TABLES;

INSERT into employee_code_table (employee_code, employee_code_name, employee_domain)
VALUES ("RU001", "su_rohit", "Java");

select * from employee_salary_table;
select * from employee_details_table;
select * from employee_code_table;

-- WAQ to list all employee first name with salary greater than 50k.
select employee_details_table.employee_first_name, employee_salary_table.employee_salary
from employee_details_table
join employee_salary_table
on employee_details_table.employee_id = employee_salary_table.employee_id
and employee_salary_table.employee_salary > "50k";

-- WAQ to list all employee last name with graduation percentile greater than 70%.
SELECT employee_last_name, graduation_percentage
from employee_details_table
where graduation_percentage > "70%";

-- WAQ to list all employee code name with graduation percentile less than 70%.
SELECT employee_code_table.employee_code_name, emp_table.graduation_percentage
from (select details.employee_id, salary.employee_code, details.graduation_percentage from employee_details_table as details JOIN employee_salary_table as salary on details.employee_id = salary.employee_id) as emp_table
join employee_code_table
on emp_table.employee_code = employee_code_table.employee_code
and emp_table.graduation_percentage < "70%";

-- WAQ to list all employee’s full name that are not of domain Java.
SELECT emp_table.fullname, employee_code_table.employee_domain
from (select details.employee_id, CONCAT(details.employee_first_name, " ", details.employee_last_name) AS fullname , salary.employee_code from employee_details_table as details JOIN employee_salary_table as salary on details.employee_id = salary.employee_id) as emp_table
join employee_code_table
on emp_table.employee_code = employee_code_table.employee_code
and employee_code_table.employee_domain <> "Java";

-- WAQ to list all employee_domain with sum of it's salary.
SELECT employee_code_table.employee_domain, sum(employee_salary_table.employee_salary)
from employee_code_table
join employee_salary_table
on employee_code_table.employee_code = employee_salary_table.employee_code
GROUP BY employee_code_table.employee_domain;

-- Write the above query again but dont include salaries which is less than 30k.
SELECT employee_code_table.employee_domain, sum(employee_salary_table.employee_salary)
from employee_code_table
join employee_salary_table
on employee_code_table.employee_code = employee_salary_table.employee_code
and employee_salary_table.employee_salary >= "30k"
GROUP BY employee_code_table.employee_domain;

-- WAQ to list all employee id which has not been assigned employee code.
SELECT employee_details_table.employee_id
from employee_details_table
JOIN employee_salary_table
on employee_details_table.employee_id = employee_salary_table.employee_id
and (employee_salary_table.employee_code = "" or employee_salary_table.employee_code = NULL);
