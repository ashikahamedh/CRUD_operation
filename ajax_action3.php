<?php

$con = mysqli_connect("localhost", "root", "", "ajaxcrud3");

$action = $_POST["action"];
if ($action == "Insert") {

  $category = mysqli_real_escape_string($con, $_POST["category"]);
  $sub_category = mysqli_real_escape_string($con, $_POST["sub_category"]);

  $sql = "INSERT INTO subcategory (CATEGORY, SUB_CATEGORY) VALUES ('{$category}', '{$sub_category}')";

  if ($con->query($sql)) {
    $id = $con->insert_id;
    echo "
      <tr uid='{$id}'>
        <td>{$category}</td>
        <td>{$sub_category}</td>
        <td><a href='#' class='btn btn-primary edit'>Edit</a></td>
        <td><a href='#' class='btn btn-danger delete'>Delete</a></td>
      </tr>";
  } else {
    echo false;
  }
} else if ($action == "Update") {
  $id = mysqli_real_escape_string($con, $_POST["id"]);
  $category = mysqli_real_escape_string($con, $_POST["category"]);
  $sub_category = mysqli_real_escape_string($con, $_POST["sub_category"]);

  $sql = "UPDATE subcategory SET CATEGORY='{$category}', SUB_CATEGORY='{$sub_category}' WHERE ID='{$id}'";

  if ($con->query($sql)) {
    echo "
      <td>{$category}</td>
      <td>{$sub_category}</td>
      <td><a href='#' class='btn btn-primary edit'>Edit</a></td>
      <td><a href='#' class='btn btn-danger delete'>Delete</a></td>";
  } else {
    echo false;
  }
} else if ($action == "Delete") {
  $id = $_POST["uid"];
  $sql = "DELETE FROM subcategory WHERE ID='{$id}'";
  if ($con->query($sql)) {
    echo true;
  } else {
    echo false;
  }
}
?>