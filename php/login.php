<?php      
    include('connection.php');  
    $name = $_POST['kullaniciAdi'];  
    $password = $_POST['sifre'];  
      
        //to prevent from mysqli injection  
        $name = stripcslashes($name);  
        $password = stripcslashes($password);  
        $username = mysqli_real_escape_string($con, $name);  
        $password = mysqli_real_escape_string($con, $password);  
      
//        $sql = "select *from kullanici where name = '$name' and password = '$password'";  
        $sql = "select *from `kullanici` where kullanici_adi='$username' and sifre='$password'";  

        $result = mysqli_query($con, $sql);  
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
        $count = mysqli_num_rows($result);  
          
        if($count == 1){  
            echo "<h1><center> Login successful </center></h1>";  
            include 'user.php';
            
            $currentUser = $con->query("select kullanici.tip from `kullanici` where kullanici_adi = '$username'");
            $sonuc = $currentUser->fetch_assoc();
            $currentUserTip = $sonuc['tip'];
            
            $currentUser = $con->query("select kullanici.kullanici_id from `kullanici` where kullanici_adi = '$username'");
            $sonuc = $currentUser->fetch_assoc();
            $currentUserID = $sonuc['kullanici_id'];

            /*
            ?>
            <form name="myform" method="post" action="index.php">
            <input type="hidden" name="user" value="<?php echo $currentUserID ?>">
            <script language="JavaScript">
            document.myform.submit();
            </script>
            </form>
            <?php
            */          
            
          if($currentUserTip == "A")
          {
            header("Location: https://localhost/coffee-web/admin.php?kullanici=$currentUserID");
          }
          else
          {
            header("Location: https://localhost/coffee-web/index.php?kullanici=$currentUserID");
          }

        }  
        else{  
            echo "<h1> Login failed. Invalid username or password.</h1>";  
        }
