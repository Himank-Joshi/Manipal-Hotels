<?php 

require('../inc/db_config.php');
require('../inc/essentials.php');
date_default_timezone_set("Asia/Kolkata");
adminLogin();

if(isset($_POST['get_bookings']))
{
  $frm_data = filteration($_POST);

  $query = "SELECT bo.*, bd.* FROM `booking_order` bo
    INNER JOIN `booking_details` bd ON bo.booking_id = bd.booking_id
    WHERE ((bo.booking_status='booked') ) 
    AND (bo.order_id LIKE ? OR bd.phonenum LIKE ? OR bd.user_name LIKE ?) 
    ORDER BY bo.booking_id DESC";

  $res = select($query, ["%$frm_data[search]%","%$frm_data[search]%","%$frm_data[search]%"], 'sss');

  $total_rows = mysqli_num_rows($res);
//
  if($total_rows == 0){
    $output = json_encode(["table_data" => "<b>No Data Found!</b>", "pagination" => '']);
    echo $output;
    exit;
  }
//
  $i = 1;
  $table_data = ""; 

  while($data = mysqli_fetch_assoc($res))
  {
    $date = date("d-m-Y", strtotime($data['datentime']));
    $checkin = date("d-m-Y", strtotime($data['check_in']));
    $checkout = date("d-m-Y", strtotime($data['check_out']));

    if($data['booking_status']=='booked'){
      $status_bg = 'bg-success';
    }
   

    $table_data .="
      <tr>
        <td>$i</td>
        <td>
            Order ID: $data[order_id]
          <br>
          <b>Name:</b> $data[user_name]
          <br>
          <b>Phone No:</b> $data[phonenum]
        </td>
        <td>
          <b>Room:</b> $data[room_name]
          <br>
          <b>Price:</b> ₹$data[price]
        </td>
        <td>
          <b>Amount:</b> ₹$data[total_pay]
          <br>
          <b>Check In:</b> $checkin
          <br>
          <b>Check Out:</b>$checkout
        </td>
      </tr>
    ";

    $i++;
  }

  $pagination = ""; // No pagination in this case

  $output = json_encode(["table_data" => $table_data, "pagination" => $pagination]);

  echo $output;
}

?>
