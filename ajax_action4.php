<?php

  $con=mysqli_connect("localhost","root","","ajaxcrud4");
  
  $action=$_POST["action"];
  if($action=="Insert"){
    $category=mysqli_real_escape_string($con,$_POST["category"]);
    $sub_category=mysqli_real_escape_string($con,$_POST["sub_category"]);
    $product_name=mysqli_real_escape_string($con,$_POST["product_name"]);
    $price=mysqli_real_escape_string($con,$_POST["price"]);
    $quantity=mysqli_real_escape_string($con,$_POST["quantity"]);

    $sql="insert into product (CATEGORY,SUB_CATEGORY,PRODUCT_NAME,PRICE,QUANTITY) values ('{$category}','{$sub_category}','{$product_name}','{$price}','{$quantity}') ";
    if($con->query($sql)){
      $id=$con->insert_id;
      echo "
        <tr uid='{$id}'>
          <td>{$category}</td>
          <td>{$sub_category}</td>
          <td>{$product_name}</td>
          <td>{$price}</td>
          <td>{$quantity}</td>

          <td><a href='#' class='btn btn-primary edit'>Edit</a></td>
          <td><a href='#' class='btn btn-danger delete'>Delete</a></td>
        </tr>";
    }else{
      echo false;
    }
  }else if($action=="Update"){
    $id=mysqli_real_escape_string($con,$_POST["id"]);
    $category=mysqli_real_escape_string($con,$_POST["category"]);
    $sub_category=mysqli_real_escape_string($con,$_POST["sub_category"]);
    $product_name=mysqli_real_escape_string($con,$_POST["product_name"]);
    $price=mysqli_real_escape_string($con,$_POST["price"]);
    $quantity=mysqli_real_escape_string($con,$_POST["quantity"]);

    $sql="update product SET CATEGORY='{$category}',SUB_CATEGORY='{$sub_category}',PRODUCT_NAME='{$product_name}',PRICE='{$price}',QUANTITY='{$quantity}' where ID='{$id}'";
    if($con->query($sql)){
      echo "
        <td>{$category}</td>
        <td>{$sub_category}</td>
        <td>{$product_name}</td>
        <td>{$price}</td>
        <td>{$quantity}</td>

        <td><a href='#' class='btn btn-primary edit'>Edit</a></td>
        <td><a href='#' class='btn btn-danger delete'>Delete</a></td>";
        
    }else{
      echo false;
    }
  }else if($action=="Delete"){
    $id=$_POST["uid"];
    $sql="delete from product where ID='{$id}'";
    if($con->query($sql)){
      echo true;
    }else{
      echo false;
    }
  }
?>