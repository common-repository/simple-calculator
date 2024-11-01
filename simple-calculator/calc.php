<?php
  if($_GET['op']=="" || $_GET['num1']=="" || $_GET['num2']==""){
    echo "Error: Please complete all fields.";
    exit;
  }
 
  if($_GET['op'] == "divide" && $_GET['num2'] == "0"){
    echo "Error: Division by zero.";
    exit;
  }
 
  if(!is_numeric($_GET['num1']) || !is_numeric($_GET['num2'])){
    echo "Error: Invalid numbers.";
    exit;
  }
 
 
  switch($_GET['op']){
    case "add":
      echo $_GET['num1'] + $_GET['num2'];
      break;
    case "subtract":
      echo $_GET['num1'] - $_GET['num2'];
      break;
    case "multiply":
      echo $_GET['num1'] * $_GET['num2'];
      break;
    case "divide":
      echo $_GET['num1'] / $_GET['num2'];
      break;
  }
?>
