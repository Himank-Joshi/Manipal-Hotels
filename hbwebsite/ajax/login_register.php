<?php 

  require('../admin/inc/db_config.php');
  require('../admin/inc/essentials.php');


  date_default_timezone_set("Asia/Kolkata");

    
//Registration Function
  if(isset($_POST['register']))
  {
    $data = filteration($_POST);

    // match password and confirm password field

    if($data['pass'] != $data['cpass']) {
      echo 'pass_mismatch';
      exit;
    }

    // check user exists or not

    $u_exist = select("SELECT * FROM `user_cred` WHERE `email` = ? OR `phonenum` = ? LIMIT 1",
      [$data['email'],$data['phonenum']],"ss");

    if(mysqli_num_rows($u_exist)!=0){
      $u_exist_fetch = mysqli_fetch_assoc($u_exist);
      echo ($u_exist_fetch['email'] == $data['email']) ? 'email_already' : 'phone_already';
      exit;
    }

   $query = "INSERT INTO user_cred (name, email, address, phonenum, pincode, password, is_verified) VALUES
    ('{$data['name']}', '{$data['email']}', '{$data['address']}', '{$data['phonenum']}', '{$data['pincode']}', '{$data['pass']}', '1')";


    if (mysqli_query($con, $query)) {
        echo "1";
    } else {
        echo "ins_failed " ;
    }

    // if(insert($query,$values,'sssssssss')){
    //   echo 1;
    // }
    // else{
    //   echo 'ins_failed';
    // }

  }

//Login Function 
  if(isset($_POST['login']))
  {
    $data = filteration($_POST);

    $u_exist = select("SELECT * FROM `user_cred` WHERE `email`=? OR `phonenum`=? LIMIT 1",
    [$data['email_mob'],$data['email_mob']],"ss");

    if(mysqli_num_rows($u_exist)==0){
      echo 'inv_email_mob';
    }
    else{
      $u_fetch = mysqli_fetch_assoc($u_exist);
      if($u_fetch['is_verified']==0){
        echo 'not_verified';
      }
      else if($u_fetch['status']==0){
        echo 'inactive';
      }
      else{
        if ($data['pass'] != $u_fetch['password']) {
          echo 'invalid_pass';
      }      
        else{
          session_start();
          $_SESSION['login'] = true;
          $_SESSION['uId'] = $u_fetch['id'];
          $_SESSION['uName'] = $u_fetch['name'];
          $_SESSION['uPic'] = $u_fetch['profile'];
          $_SESSION['uPhone'] = $u_fetch['phonenum'];
          echo 1;
        }
      }
    }
  }

  
?>