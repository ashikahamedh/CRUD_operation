<?php

  $con=mysqli_connect("localhost","root","","ajaxcrud2");
  
  $action=$_POST["action"];
  if($action=="Insert"){
  $category=mysqli_real_escape_string($con,$_POST["category"]);
    
    $sql="insert into maincategory (CATEGORY) values ('{$category}') ";
 
 
    
    if($con->query($sql)){
      $id=$con->insert_id;
      echo "
        <tr uid='{$id}'>
          <td>{$category}</td>
      
          <td><a href='#' class='btn btn-primary edit'>Edit</a></td>
          <td><a href='#' class='btn btn-danger delete'>Delete</a></td>
        </tr>";
    }else{
      echo false;
    }
  }else if($action=="Update"){
    $id=mysqli_real_escape_string($con,$_POST["id"]);
    $category=mysqli_real_escape_string($con,$_POST["category"]);
   
    $sql="update maincategory SET CATEGORY='{$category}' where ID='{$id}'";
    if($con->query($sql)){
      echo "
        <td>{$category}</td>
        <td><a href='#' class='btn btn-primary edit'>Edit</a></td>
        <td><a href='#' class='btn btn-danger delete'>Delete</a></td>";
        
    }else{
      echo false;
    }
  }else if($action=="Delete"){
    $id=$_POST["uid"];
    $sql="delete from maincategory where ID='{$id}'";
    if($con->query($sql)){
      echo true;
    }else{
      echo false;
    }
  }
?>