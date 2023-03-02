<?php
defined('BASEPATH') or exit('No direct script access allowed');
if (isset($this->session->userdata['logged_in'])) {
  $user_id = ($this->session->userdata['logged_in']['user_id']);
  $username = ($this->session->userdata['logged_in']['username']);
  $email = ($this->session->userdata['logged_in']['email']);
  $first = ($this->session->userdata['logged_in']['first_name']);
  $last = ($this->session->userdata['logged_in']['last_name']);
  $iduser = ($this->session->userdata['logged_in']['user_id']);
  $permission = ($this->session->userdata['logged_in']['permission']);
}else{
  
}
$uri = $_SERVER['REQUEST_URI']; 
$user_id_prof = str_replace("/CodeIgniter-3.1.10/index.php/profile/","",$uri);
$profileId = strtok($user_id_prof, '/');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>others/css/menu.css"><!-- CSS menu -->
  <script src="https://kit.fontawesome.com/4701289b74.js" crossorigin="anonymous"></script>

  <!-- CSS only -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  <!-- JS, Popper.js, and jQuery -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  <title>Online Catalogue</title>
</head>
<script>
function confirmActionListpublic(public) {
    var response = confirm("Are you sure?");
    if (response) {
      if(public == 0){
        window.location="<?= base_url() ?>index.php/publicprofile/<?= $user_id?>"
      }else{
        window.location="<?= base_url() ?>index.php/privateprofile/<?= $user_id?>"

      }
    }
  }
</script>
<body>
  <div style="background-color:#333">
    <?php if ($permission == 0) { ?>
      <div class="btn-group">
        <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Users
        </button>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="<?= base_url() ?>index.php/add_user">Add Users</a>
          <a class="dropdown-item" href="<?= base_url() ?>index.php/edit_user">Edit/Delete User Info</a>
        </div>
      </div>
      <button  class="dropbtn" onclick="location.href = '<?=base_url()?>index.php/supportform/';" id="login">Support Form</button>
      <button  class="dropbtn" onclick="location.href = '<?=base_url()?>index.php/profile/<?= $iduser?>/rating'" id="login">Ratings</button>
      <button  class="dropbtn" onclick="location.href = '<?=base_url()?>index.php/profile/<?= $iduser?>/notifications'" id="login">Notification</button>

      <div class="btn-group">
        <button type="button" class="btn  dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Images
        </button>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="<?= base_url() ?>index.php/add_image">Add Image</a>
          <a class="dropdown-item" href="<?= base_url() ?>index.php/edit_image">Edit/Delete Image</a>
          <a class="dropdown-item" href="<?= base_url() ?>index.php/my_image?id=<?php echo $iduser;?>">My Images</a>
        </div>
      </div>
    <?php } else { ?>
      <div class="btn-group">
        <button type="button" class="btn  dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Images
        </button>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="<?= base_url() ?>index.php/add_image">Add Image</a>
          <a class="dropdown-item" href="<?= base_url() ?>index.php/my_image?id=<?php echo $iduser;?>">My Images</a>
        </div>
      </div>
    <?php } ?>




    <div class="btn-group" style="float:right">
      <button type="button" class="btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <?php echo $first, ' ', $last; ?>
      </button>
      <div class="dropdown-menu dropdown-menu-right">
        <a class="dropdown-item" href="<?= base_url() ?>index.php/user_info">Change info</a>
        <?php if ($permission == 0) { ?>
          <a class="dropdown-item" href="<?= base_url() ?>index.php/notifications">Notifications</a>
        <?php } ?>
        <div class="dropdown-divider"></div>
        <a id="logout" class="dropdown-item" href="<?= base_url() ?>index.php/logout">Logout</a>
      </div>
    </div>
  </div>

  <?php 

    //see if its in user page
    /*$test = $_SERVER['REQUEST_URI'];
    $expected_result = '/CodeIgniter-3.1.10/index.php/login_enter';
    $test_name = 'check to see if user page';
    echo $this->unit->run($test, $expected_result, $test_name);*/
    ?>

<head>
    <title>Admin Page</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>others/css/menu.css">
    <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro|Open+Sans+Condensed:300|Raleway' rel='stylesheet' type='text/css'>
</head>

<body>
   <?php 
   if($user_id == $profileId){
    foreach($state as $prof){
        echo "<img src='../../uploads/$prof->profile_banner'class='myImages'id='banner' data-target='#Modalbanner' data-toggle='modal' alt='banner' width='10%' ><br>";
        echo "Username: ".$prof->username.'<br>';
        echo "Gender: ".$prof->gender.'<br>';
        echo "Avatar: ".$prof->avatar.'<br>';
        echo "<img src='../../uploads/$prof->avatar'class='myImages'id='myImg' data-target='#Modal4' data-toggle='modal' alt='profile' width='10%' ><br>";
        echo "Bio: ".$prof->bio.'<br>';
    }
   }else{
    foreach($state as $prof){
        echo "<img src='../../uploads/$prof->profile_banner'class='myImages'id='banner' alt='banner' width='10%' ><br>";
        echo "Username: ".$prof->username.'<br>';
        echo "Gender: ".$prof->gender.'<br>';
        echo "Avatar: ".$prof->avatar.'<br>';
        echo "<img src='../../uploads/$prof->avatar'class='myImages'id='myImg' alt='profile' width='10%' ><br>";
        echo "Bio: ".$prof->bio.'<br>';  
    }
   }
   
   
   if($profileId != $user_id){
    if($followprofile == 0){
      ?><button type="button" class="btn btn-success"onclick='window.location="<?= base_url() ?>index.php/follow/<?= $user_id_prof?>"'>Follow</button><br><?php

    }else if($followprofile == $user_id_prof){
      ?> <button type="button" class="btn btn-success"onclick='window.location="<?= base_url() ?>index.php/unfollow/<?= $user_id_prof?>"'>Unfollow</button><br><?php

    }
 }

 if($profileId == $user_id){
  if($state[0]->profile_state == 0){?>
    <button type="button" class="btn btn-success" onclick='confirmActionListpublic(<?php echo $state[0]->profile_state?>)'>Make Public</button><br>
  <?php }else{?>
  <button type="button" class="btn btn-success" onclick='confirmActionListpublic(<?php echo $state[0]->profile_state?>)'>Make Private</button><br>
  <?php } 
}
if(!empty($state[0])){
  if($user_id_prof == $user_id){
    $state[0]->profile_state = 1;
  }
  if($uri == "/CodeIgniter-3.1.10/index.php/user_info"){
    $profileId = $user_id;
  }
  if($state[0]->profile_state == 0 && $user_id != $profileId){
      echo "<h1>Noone touching this shit boy</h1>";
  }else{
    
      ?>    
      <a href="<?= base_url() ?>index.php/profile/<?= $profileId ?>/rating/"  >RATING</a><br>
            <a href="<?= base_url() ?>index.php/profile/<?= $profileId ?>/customlist/"  >Custom List</a><br>
   
        <a href="<?= base_url() ?>index.php/profile/<?= $profileId ?>/movielist">MOVIES</a><br>
        <a href="<?= base_url() ?>index.php/profile/<?= $profileId ?>/showlist">SHOWS</a><br>
        <a href="<?= base_url() ?>index.php/profile/<?= $profileId ?>/booklist">BOOKS</a><br>
        <a href="<?= base_url() ?>index.php/profile/<?= $profileId ?>/gamelist">GAMES</a><br><br>

        
        <a href="<?= base_url() ?>index.php/profile/<?= $profileId ?>/following/">Following: <?php echo $follow[0]?></a><br>
        <a href="<?= base_url() ?>index.php/profile/<?= $profileId ?>/followers/">Followers: <?php echo $follow[1]?></a><br><br>

        <a href="<?= base_url() ?>index.php/profile/<?= $profileId ?>/comments">COMMENTS</a><br><br>

      <?php
      }
    }
      ?>


<div class="modal" id="Modal4" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Aubrey Drake "Drizzy" Graham</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <?php echo "<img src='../uploads/".$state[0]->avatar."'class='myImages'id='myImg' alt='profile' width='10%' ><br>"; ?>
      <?php echo form_open_multipart("upload_new_avatar/$user_id");?>
        <input type="file" name="avatar" size="20" />
        <input type="submit" value="upload" />
        </form>
      </div>
  </div>
</div>
</div>

<div class="modal" id="Modalbanner" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Aubrey Drake "Drizzy" Graham</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php echo "<img src='../uploads/".$state[0]->profile_banner."'class='myImages'id='myImg' alt='banner' width='10%' ><br>"; ?>
        <?php echo form_open_multipart("upload_new_banner/$user_id");?>
            <input type="file" name="avatar" size="20" />
            <input type="submit" value="upload" />
            </form>
      </div>
    </div>
</div>
</div>