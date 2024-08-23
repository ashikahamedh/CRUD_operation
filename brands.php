<?php
  include "common/header.php";
  include "common/sidebar.php";
 ?>


<section class="home-section">
<div class="home-content">
  <i class='bx bx-menu' ></i>
  <span class="text">BRANDS</span>
</div>






<div class="modal" tabindex="-1" role="dialog" id='modal_frm'>
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Brand Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id='frm'>
      <input type='hidden' name='action' id='action' value='Insert'>
      <input type='hidden' name='id' id='uid' value='0'>
      <div class='form-group'>
        <label>Brand</label>
        <input type='text' name='brand' id='name' required class='form-control'>
      </div>
      
      <input type='submit' value='Submit' class='btn btn-success'>
    </form>
      </div>
    </div>
  </div>
</div>



  <div class='container mt-5'>
      <p class='text-right'><a href='#' class='btn btn-success' id='add_record'>Add Brand</a></p>
    
    <table class='table table-bordered'>
    <thead>
      <th>Brand</th>
      <th>Edit</th>
      <th>Delete</th>
    </thead>
    <tbody id='tbody'>
      <?php 
        $con=mysqli_connect("localhost","root","","ajaxcrud");
        $sql="select * from brands ORDER BY brands ASC";
        $res=$con->query($sql);
       

        while($row=$res->fetch_assoc()){
          echo "
            <tr uid='{$row["ID"]}'>
              <td>{$row["BRANDS"]}</td>
          
              <td><a href='#' class='btn btn-primary edit'>Edit</a></td>
              <td><a href='#' class='btn btn-danger delete'>Delete</a></td>
            </tr>
          ";
        }
      ?>
    </tbody>
    </table>
  </div>
    <script>
      $(document).ready(function(){
        var current_row=null;
        $("#add_record").click(function(){
          $("#modal_frm").modal();
        });
        
        $("#frm").submit(function(event){
          event.preventDefault();
          $.ajax({
            url:"ajax_action.php",
            type:"post",
            data:$("#frm").serialize(),
            beforeSend:function(){
              $("#frm").find("input[type='submit']").val('Loading...');
            },
            success:function(res){
            
              if(res){
                if($("#uid").val()=="0"){
                  $("#tbody").append(res);
                }else{
                  $(current_row).html(res);
                }
              }else{
                alert("Failed Try Again");
              }
              $("#frm").find("input[type='submit']").val('Submit');
              clear_input();
              $("#modal_frm").modal('hide');
            }
          });
        });
        
        $("body").on("click",".edit",function(event){
          event.preventDefault();
          current_row=$(this).closest("tr");
          $("#modal_frm").modal();
          var id=$(this).closest("tr").attr("uid");
          var brand=$(this).closest("tr").find("td:eq(0)").text();
        
          $("#action").val("Update");
          $("#uid").val(id);
          $("#name").val(brand);
         
        });
        
        $("body").on("click",".delete",function(event){
          event.preventDefault();
          var id=$(this).closest("tr").attr("uid");
          var cls=$(this);
          if(confirm("Are You Sure")){
            $.ajax({
              url:"ajax_action.php",
              type:"post",
              data:{uid:id,action:'Delete'},
              beforeSend:function(){
                $(cls).text("Loading...");
              },
              success:function(res){
                if(res){
                  $(cls).closest("tr").remove();
                }else{
                  alert("Failed TryAgain");
                  $(cls).text("Try Again");
                }
              }
            });
          }
        });
        
        function clear_input(){
          $("#frm").find(".form-control").val("");
          $("#action").val("Insert");
          $("#uid").val("0");
        }
      });
    </script>
          
<?php
   include "common/footer.php";
   ?>

</body>
</html>