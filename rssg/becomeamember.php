<?php
  //message Vars
  $msg = '';
  $msgClass = '';

  //check for submit
  if(filter_has_var(INPUT_POST, 'submit')){

    //get form DOMCdataSection
    $name = htmlspecialchars($_POST['name']);
    $phonenumber = htmlspecialchars($_POST['phonenumber']);
    $email = htmlspecialchars($_POST['email']);

    $message = htmlspecialchars($_POST['message']);

  //check required fields
  if(!empty($email) && !empty($name) && !empty($phonenumber) && !empty($message)){
    //passed
    if(!isset($newmember) || ($renewmembership) || ($maillist) <1){
    //check email
    if(filter_var($email, FILTER_VALIDATE_EMAIL) === false){
      //failed
      echo '<script language="javascript" type="text/javascript">
      alert("Please enter a valid email");
      window.location = "becomeamember.php";
      </script> ';
      $msgClass = 'alert-danger';
    }else {
      foreach ($_POST['check'] as $checkboxvalue) {
    $check_msg .= "$checkboxvalue, \r\n";
}
      //passed

      //Reciepient Email
      $toEmail = 'rssgauh@gmail.com';
      $subject = 'Contact Request From ' .$name;
      $body = '<h2> Contact Request </h2>
        <h4>Name: </h4><p>'.$name.'</p>
        <h4>Regarding: </h4><p>'.$check_msg.'</p>
        <h4>Phone number: </h4><p>'.$phonenumber.'</p>
        <h4>Email: </h4><p>'.$email.'</p>
        <h4>Message: </h4><p>'.$message.'</p>
      ';

      //email headers
        $headers = "MIME-Version: 1.0" ."\r\n";
        $headers .= "Content-Type:text/html;charset=UTF-8" . "\r\n";

      //additional headers
      $headers .= "From: " .$name. "<".$email. ">". "\r\n";

      if(mail($toEmail, $subject, $body, $headers)){
        //email sent
        $msg = 'Your form has been sent';
        echo '<script language="javascript" type="text/javascript">
        alert("Your message has been sent");
        window.location = "becomeamember.php";
        </script> ';
      } else{
        //email not sent
        echo '<script language="javascript" type="text/javascript">
        alert("Your message was not sent correctly");
        window.location = "becomeamember.php";
        </script> ';
        $msg = 'Your form was not sent';
      }
    }
  }else {
    echo '<script language="javascript" type="text/javascript">
    alert("Please Check atleast one box");
    window.location = "becomeamember.php";
    </script> ';
    $msgClass = 'alert-danger';
  }
  } else {
    //failed
    echo '<script language="javascript" type="text/javascript">
    alert("Please fill in all the fields");
    window.location = "becomeamember.php";
    </script> ';
    $msgClass = 'alert-danger';
}
  }

?>


<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>About Royal St George Society</title>
    <link rel="stylesheet" href="css/member.css">
  </head>
  <body>

<div class="main">


  <div class="navbar">
    <nav>


      <ul>
        <a href="index.html">
          <li>
          Home
        </li></a>

        <a href="about.html">
          <li>
          About
        </li></a>

          <a href="discounts.html">
          <li>
          Discounts
        </li></a>


        <a href="becomeamember.php">
          <li>
          Become A Member
          </li>
        </a>

      </ul>
    </nav>
  </div>


  <div class="top">
    <div class="logo">
    <img src="images/logo.png" alt="logo">
    </div>
    <div class="HerMajestyIncorporated">
    <img src="images/queen.jpg" alt="queen">
    <p>Incorporated by Royal Charter Patron:
     <span> Her Majesty Queen Elizabeth II </span></p>
    </div>
  </div>

<div class="membership">
  <p>

    <h2>Membership</h2> <br>

    The Royal Society of St.George Abu Dhabi welcomes all who are interested in joining to attend Society events and take advantage of our sponsor discounts. Nationality is not a constraint. <br><br>

    <h3>Membership of the Society is open to:

  <br>  1. All those who subscribe to the Objects of the Society; and who <br>

    <br>2. Are born in England or wherever born being English men or English women or children or remoter issue of the same; or <br>

    <br>3. Not being of English descent nevertheless support the aims and objectives of the Society <br></h3>
    (ie. those that have studied or worked in England and UK as well as those that have a passion for English media, culture, arts and sports, and any person interested to join our social gatherings and assist in the raising of funds for good causes)<br>

</div>
<div id="showcase">
<div id="border">

<div id="membershipfee"
  <br><br>  <h2>To Join</h2><br> Please complete the simple application form below or email rssgauh@gmail.com if you have any questions prior to deciding whether to join.

    Membership fees consist of an annual subscription of AED100 per person.

    Subscription renewal reminders will be emailed to you at the end of your 12 month membership period and you may use the below form to renew for another 12 months.
    Renewal subscriptions fees are AED100.

  </p>
</div>




<div class="formcontainer">
  <?php if($msg != ''): ?>
    <div class="alert <?php echo $msgClass; ?>"><?php echo $msg; ?></div>
  <?php endif; ?>
  <form class="BecomeAMember" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <div class="formgroup">
      <label>Name</label>
      <input type="text" name="name" placeholder="Name" class="formcontrol"  value="<?php echo isset($_POST['name']) ? $name : ''; ?>">
    </div>
    <div class="formgroup">
      <label>Phone-number</label>
      <input type="text" name="phonenumber" placeholder="Phone-number" class="formcontrol"  value="<?php echo isset($_POST['phonenumber']) ? $phonenumber : ''; ?>">
    </div>
    <div class="formgroup">
      <label>Email</label>
      <input type="text" name="email" placeholder="Email" class="formcontrol"  value="<?php echo isset($_POST['email']) ? $email : ''; ?>">
    </div>
    <div class="checkbox">
      <label>New Member</label>
      <input type="checkbox" name="check[]" placeholder="New Member" class="formcontrol"  value="A New Member">
    </div>
    <div class="checkbox">
      <label>Renew Membership</label>
      <input type="checkbox" name="check[]" placeholder="Renew Membership" class="formcontrol"  value="Renewing Membership">
    </div>
    <div class="checkbox">
      <label>Subscribe to Mailing List</label>
      <input type="checkbox" name="check[]" placeholder="Subscribe to Mail List" class="formcontrol"  value="Subscribing to Mail list">
    </div>
    <div class="formgroup">
      <label>Introduction Message</label>
      <textarea name="message" placeholder="Send us a message" rows="8" cols="80" class="formcontrol"><?php echo isset($_POST['message']) ? $message : ''; ?></textarea>
    </div>
    <button type="submit" name="submit" class="submitbutton">Submit</button>

  </form>

</div>
</div>



</div>



  <footer>
  <div class="Footerinfo">
  <div class="contactus">
    Contact Us:<br><a href="mailto:rssgauh@gmail.com">rssgauh@gmail.com</a>
  </div>
  <div class="RSSGhome">
    Visit the British Royal <br> Society of St George: <br><a href="http://www.royalsocietyofstgeorge.com/">RSSG Home</a>
  </div>
  </div>
  <div class="copyright">
  &copy; Royal Society of St. George

<span id="siteseal"><script async type="text/javascript" src="https://seal.starfieldtech.com/getSeal?sealID=PHh9eH2rJ9BZJidpf73UkigxkksgB2FV4mvGPU7pe56ovgitbtczlxzFaeP6"></script></span>
  </div>
  </footer>





</div>



  </body>
</html>
