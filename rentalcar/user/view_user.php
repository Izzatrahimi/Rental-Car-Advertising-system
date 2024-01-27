<?php
// Include database connection settings
include('../connection/dbconn.php');

include ("../register/session.php");
session_start();

if (!isset($_SESSION['username'])) {
        header('Location: ../login');
    } 
    
?>

<!DOCTYPE html>
<html>
<head>

  <link rel="stylesheet" href="style4.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.3/css/fontawesome.min.css">

</head>

<body>

  <div class="navbar">
  
  <img src="../img/logo.png" style="float: left; width: 85px; height: 75px;">
  <a href="user.php">HOME</a>

  <!--<a href="login/index.html">LOGIN</a>
  <a href="signup/index.html">SIGNUP</a>-->
  <div class="dropdown">
      <button class="dropbtn">USER<i class="fa fa-caret down"></i></button>
      <div class="dropdown-content">
        <a href="view_user.php">View</a>
        <a href="update_user.php">Update</a>
      </div>
    </div>
    
    <div class="dropdown">
      <button class="dropbtn">CAR<i class="fa fa-caret down"></i></button>
      <div class="dropdown-content">
        <a href="view_car.php">View</a>
        <a href="search_car.php">Search</a>
      </div>
    </div>

    <div class="dropdown">
      <button class="dropbtn">BOOKING<i class="fa fa-caret down"></i></button>
      <div class="dropdown-content">
        <a href="add_book_car.php">Add</a>
        <a href="view_book.php">View</a>
      </div>
    </div>
    <a href="../register/logout.php" style="float: right;">Logout</a>
  </div>
</div>

<div class="main">
  <div class="greetinguser" style="margin-top: 70px;">
    <h1>Welcome <?php echo $_SESSION['username']; ?></h1>
    <h3>Rental Car Member Dashboard</h3>
  </div>
</div>
<br><br><br><br><br><br><br>

<div class="container" style="margin-top: 70px;">
  <br>
  <h3 style="color: white">User Data</h3>
  
<?php
  $username = $_SESSION['username'];
  $query = "SELECT * FROM user WHERE username = '$username'";
  $result = mysqli_query($dbconn, $query) or die ("Error: " . mysqli_error($dbconn));
  $numrow = mysqli_num_rows($result);
?>

<tr align="left">
    <td>
    <table width="100%" border="1" align="center" cellpadding="0" cellspacing="0">
      <tr align="left">
        <th width="3%">No</td>
        <th width="26%">Name</td>       
        <th width="27%">Address</td>
        <th width="9%">Phone No</td>
        <th align="center">Action</td>
      </tr>
    
      <?php
    $color="1";
    
    for ($a=0; $a<$numrow; $a++) {
    $row = mysqli_fetch_array($result);
    
    if($color==1){
      echo "<tr>"
    ?>
    <tr>
        <td>&nbsp;<?php echo $a+1; ?></td>
        <td>&nbsp;<?php echo ucwords (strtolower($row['name'])); ?></td>   
        <td><?php echo ucwords (strtolower($row['address'])); ?></td>
        <td>&nbsp;<?php echo $row['phone']; ?></td>
        <td width="5%" align="center"><a class="one" href="detail_user.php?id=<?php echo $row['id'];?>"><button class = "button1">Detail</button></a></td>
       </tr> 
      <?php 
       $color="2";}
     else{
     echo "<tr>"
    ?>
        <td>&nbsp;<?php echo $a+1; ?></td>
        <td>&nbsp;<?php echo ucwords (strtolower($row['name'])); ?></td>   
        
        <td><?php echo ucwords (strtolower($row['address'])); ?></td>
        <td>&nbsp;<?php echo $row['phone']; ?></td>
        <td width="5%" align="center"><a class="one" href="detail_user.php?username=<?php echo $row['username'];?>"><button class = "button1">Detail</button></a></td>
      </tr>
     <?php
      $color="1";
     }
    } 
    if ($numrow==0)
      {
     echo '<tr>
            <td colspan="8"><font color="#FF0000">No record avaiable.</font></td>
         </tr>'; 
    }
    ?>
    </table>
    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>

<br>
  <br>
  <br>

</body>
</html> 
