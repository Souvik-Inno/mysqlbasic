<?php

  /**
   *  Class FormData contains data entered through form.
   */
  class FormData {

    /**
     *  @var string $inputFirstName
     *    Contains first name entered through form.
     */
    public $inputFirstName;
    /**
     *  @var string $inputLatName
     *    Contains last name entered through form.
     */
    public $inputLastName;
    /**
     *  @var string $inputGradPercent
     *    Contains graduation percentage entered through form.
     */
    public $inputGradPercent;
    /**
     *  @var string $inputSalary
     *    Contains salary entered through form.
     */
    public $inputSalary;
    /**
     *  @var string $inputCodeName
     *    Contains Code name entered through form.
     */
    public $inputCodeName;
    /**
     *  @var string $inputDomain
     *    Contains Domain name entered through form.
     */
    public $inputDomain;
    /**
     *  @var PDO $conn
     *    Used for connecting to database.
     */
    public $conn;
    /**
     *  @var string $empId
     *    Contains Employee ID generated automatically.
     */
    public $empId;
    /**
     *  @var string $empCode
     *    Contains Employee Code generated automatically.
     */
    public $empCode;

    /**
     *  @var array $errors 
     *    For storing errors generated.
     */
    public $errors = [
      'inputFirstName' => '',
      'inputLastName' => '',
      'inputGradPercent' => '',
      'inputSalary' => '',
      'inputCodeName' => '',
      'inputDomain' => ''
    ];

    /**
     *  Constructor to initialize class variables.
     */
    public function __construct() {
      if (isset($_POST['formSubmit'])) {
        $this->inputFirstName = $_POST['inputFirstName'];
        $this->inputLastName = $_POST['inputLastName'];
        $this->inputGradPercent = $_POST['inputGradPercent'];
        $this->inputSalary = $_POST['inputSalary'];
        $this->inputCodeName = $_POST['inputCodeName'];
        $this->inputDomain = $_POST['inputDomain'];
        $this->empId = $this->autoincemp();
        $this->empCode = "su_" . $_POST['inputFirstName'];
      }
      
    }

    /**
     *  Function to connect to Database.
     */
    public function connectDB() {
      require_once("classes/classPass.php");
      $pass = new Pass();
      try {
        $this->conn = new PDO("mysql:host={$pass->getServerName()};dbname={$pass->getDBName()}", $pass->getusername(), $pass->getPassword());
        // Set the PDO error mode to exception.
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      }
      catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
      }
    }

    /**
     *  Function to generate Employee ID automatically.
     * 
     *  @return string
     *    returns the generated employee ID.
     */
    public function autoincemp() {
      $this->connectDB();
      global $value2;
      $query = "SELECT employee_id from employee_salary_table order by employee_id";
      $stmt = $this->conn->prepare($query);
      $stmt->execute();
      $value = $stmt->rowCount() + 1;
      $value = str_pad($value, 3, 0, STR_PAD_LEFT);
      $id  = 'RU' . strval($value);
      return $id;
    }

    /**
     *  Function to store the values inserted though form to database.
     */
    public function storeDB() {
      $this->connectDB();
      $query1 = "INSERT INTO employee_details_table (employee_id, employee_first_name, employee_last_name, graduation_percentage)
      VALUES(:empId, :inputFirstName, :inputLastName, :inputGradPercent);";
      $query2 = "INSERT INTO employee_code_table (employee_code, employee_code_name, employee_domain)
      VALUES(:empCode, :inputCodeName, :inputDomain); ";
      $query3 = "INSERT INTO employee_salary_table (employee_id, employee_salary, employee_code)
      VALUES(:empId, :inputSalary, :empCode); ";

      $query = $query1 . $query2 . $query3;

      $stmt = $this->conn->prepare($query);
      $stmt->bindParam(':inputFirstName', $this->inputFirstName);
      $stmt->bindParam(':inputLastName', $this->inputLastName);
      $stmt->bindParam(':inputGradPercent', $this->inputGradPercent);
      $stmt->bindParam(':inputGradPercent', $this->inputGradPercent);

      $stmt->bindParam(':inputCodeName', $this->inputCodeName);
      $stmt->bindParam(':inputDomain', $this->inputDomain);

      $stmt->bindParam(':empId', $this->empId);
      $stmt->bindParam(':inputSalary', $this->inputSalary);
      $stmt->bindParam(':empCode', $this->empCode);

      if ($stmt->execute()) {
        echo "New record created successfully";
      }
      else{
        echo "error";
      }
    }

    /**
     *  Checks errors in the form.
     * 
     *  @return bool
     *    Returns TRUE if no errors are found.
     *    Else returns FALSE.
     */
    public function errorCheck() {
      $errorCount = 0;
      if (empty($this->inputFirstName)) {
        $this->errors['inputFirstName'] = "*First Name is required.";
        $errorCount++;
      }
      if (empty($this->inputLastName)) {
        $this->errors['inputLastName'] = "*Last Name is required.";
        $errorCount++;
      }
      if (empty($this->inputGradPercent)) {
        $this->errors['inputGradPercent'] = "*Grad percent is required.";
        $errorCount++;
      }
      if (empty($this->inputSalary)) {
        $this->errors['inputSalary'] = "*Salary is required.";
        $errorCount++;
      }
      if (empty($this->inputCodeName)) {
        $this->errors['inputCodeName'] = "*Code Name is required.";
        $errorCount++;
      }
      if (empty($this->inputDomain)) {
        $this->errors['inputDomain'] = "*Domain Name is required.";
        $errorCount++;
      }
      if ($errorCount == 0) {
        return TRUE;
      }
      return FALSE;
    }

  }
?>
