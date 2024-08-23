<?php

  $con=mysqli_connect("localhost","root","","ajaxcrud");
  
  $action=$_POST["action"];
  if($action=="Insert"){
  $brand=mysqli_real_escape_string($con,$_POST["brand"]);
    
    $sql="insert into brands (BRANDS) values ('{$brand}') ";
 
 
    
    if($con->query($sql)){
      $id=$con->insert_id;
      echo "
        <tr uid='{$id}'>
          <td>{$brand}</td>
      
          <td><a href='#' class='btn btn-primary edit'>Edit</a></td>
          <td><a href='#' class='btn btn-danger delete'>Delete</a></td>
        </tr>";
    }else{
      echo false;
    }
  }else if($action=="Update"){
    $id=mysqli_real_escape_string($con,$_POST["id"]);
    $brand=mysqli_real_escape_string($con,$_POST["brand"]);
   
    $sql="update brands SET BRANDS='{$brand}' where ID='{$id}'";
    if($con->query($sql)){
      echo "
        <td>{$brand}</td>
        <td><a href='#' class='btn btn-primary edit'>Edit</a></td>
        <td><a href='#' class='btn btn-danger delete'>Delete</a></td>";
        
    }else{
      echo false;
    }
  }else if($action=="Delete"){
    $id=$_POST["uid"];
    $sql="delete from brands where ID='{$id}'";
    if($con->query($sql)){
      echo true;
    }else{
      echo false;
    }
  }
?>