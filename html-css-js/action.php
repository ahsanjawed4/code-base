<?php
  if(isset($_REQUEST["addData"])){
    // echo "<pre>";
    //   print_r($_REQUEST);
    // echo "</pre>";
    ksort($_REQUEST);
    echo "<pre>";
      print_r($_REQUEST);
  }
  else
    header("location:./");
?>
