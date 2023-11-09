<!-- NOTE: REPLACE THE TABLE WITH ACCEPTED APPOINTMENTS -->

<!-- DIPSLAY AND SEARCH FOR PATIENTS -->

<?php
include('dbconn.php')
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>PHP MySQL Ajax Live Search</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
</head>
<body>


<div class="container mt-4">
    <p><h2>PHP MySQL Ajax Live Search</h2></p>
    <h6 class="mt-5"><b>Search Name</b></h6>

    <!-- get user input -->
    <div class="input-group mb-4 mt-3">
         <div class="form-outline">
            <input type="text" id="getName">
        </div>
    </div>
    
    <!-- display patients_table1's data that are from verified accounts -->
    <table class="table table-striped">
        <thead>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
          </tr>
        </thead>
       
        <tbody id="showdata">
          <?php  
                $sql = "SELECT * FROM patients_table1 WHERE verified = 1";
                $query = mysqli_query($conn,$sql);

                while($row = mysqli_fetch_assoc($query))
                {
                  $email = $row['active_gmail'];
                  $first_name = $row['first_name'];
                  $last_name = $row['last_name'];

                  echo"<tr>";
                    echo"<td><h6>".$row['id']."</h6></td>";
                    echo"<td><h6>".$row['first_name']."</h6></td>";
                    echo"<td>".$row['active_gmail']."</td>";
                    echo "<td><a href='more-info.php?active_gmail=$email&first_name=$first_name&last_name=$last_name'>Medical Info</a></td>";
                    echo "<td><a href='p_booking-history.php?active_gmail=$email&first_name=$first_name&last_name=$last_name'>Booking History</a></td>";
                  echo"</tr>";   
                }
            ?>
        </tbody>
    </table>
</div>

<!-- connected to searchajax.php -->
<script>
  $(document).ready(function(){
   $('#getName').on("keyup", function(){
     var getName = $(this).val();
     $.ajax({
       method:'POST',
       url:'searchajax.php',
       data:{name:getName},
       success:function(response)
       {
            $("#showdata").html(response);
       } 
     });
   });
  });
</script>


</body>
</html>