<!doctype html>
<html class="no-js" lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Login | Kiaalap - Kiaalap Admin Template</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- favicon
		============================================ -->
  <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
  <!-- Google Fonts
		============================================ -->
  <link href="https://fonts.googleapis.com/css?family=Play:400,700" rel="stylesheet">
  <!-- Bootstrap CSS
		============================================ -->
  <link rel="stylesheet" href="<?php echo base_url('optimum'); ?>/css/bootstrap.min.css">
  <!-- Bootstrap CSS
		============================================ -->
  <link rel="stylesheet" href="<?php echo base_url('optimum'); ?>/css/font-awesome.min.css">

  <!-- animate CSS
		============================================ -->
  <link rel="stylesheet" href="<?php echo base_url('optimum'); ?>/css/animate.css">
  <!-- normalize CSS
		============================================ -->
  <link rel="stylesheet" href="<?php echo base_url('optimum'); ?>/css/normalize.css">
  <!-- main CSS
		============================================ -->
  <link rel="stylesheet" href="<?php echo base_url('optimum'); ?>/css/main.css">

  <!-- forms CSS
		============================================ -->
  <link rel="stylesheet" href="<?php echo base_url('optimum'); ?>/css/form/all-type-forms.css">
  <!-- style CSS
		============================================ -->
  <link rel="stylesheet" href="<?php echo base_url('optimum'); ?>/style.css">
  <!-- responsive CSS
		============================================ -->
  <link rel="stylesheet" href="<?php echo base_url('optimum'); ?>/css/responsive.css">
  <!-- modernizr JS
		============================================ -->
  <script src="<?php echo base_url('optimum'); ?>/js/vendor/modernizr-2.8.3.min.js"></script>
</head>

<body>
  <!--[if lt IE 8]>
		<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
	<![endif]-->
  <div class="error-pagewrap">
    <div class="error-page-int">
      <div class="text-center m-b-md custom-login">
        <h3>PLEASE LOGIN TO ADMIN</h3>
      </div>
      <div class="content-error">
        <div class="hpanel">
          <div class="panel-body">
            <form id="ajaxlog">
              <div class="form-group">
                <label class="control-label" for="username">Username</label>
                <input type="text" placeholder="example@gmail.com" title="Please enter you username" required="" value="" name="id" id="id" class="form-control">
              </div>
              <div class="form-group">
                <label class="control-label" for="password">Password</label>
                <input type="password" title="Please enter your password" placeholder="******" required="" value="" name="password" id="password" class="form-control">
              </div>
              <input type="hidden" name="<?=$this->security->get_csrf_token_name()?>" value="<?=$this->security->get_csrf_hash()?>" />
              <button type="submit" class="btn btn-success btn-block loginbtn">Login</button>
            </form>
          </div>
        </div>
      </div>
      <div class="text-center login-footer">
        <p>Copyright © 2021. All rights reserved.</p>
      </div>
    </div>
  </div>
  <!-- jquery
		============================================ -->
  <script src="<?php echo base_url('optimum'); ?>/js/vendor/jquery-1.12.4.min.js"></script>
  <!-- bootstrap JS
		============================================ -->
  <script src="<?php echo base_url('optimum'); ?>/js/bootstrap.min.js"></script>

  <!-- main JS
		============================================ -->
  <script src="<?php echo base_url('optimum'); ?>/js/main.js"></script>

  <script type="text/javascript">

  $(document).ready(function(){
    $('#ajaxlog').on('submit', function(event){
      event.preventDefault();
      var formData = $('#ajaxlog').serialize();
      $.post( "<?php echo base_url('ajaxlog') ?>", formData)
      .done(function( data ) {
        var data = JSON.parse(data);
        if(data.status) {
          window.location.replace(data.url);
        } else {
          shakeModal(data.msg);
        }
      });
    });

    function shakeModal(msg){
      $('#loginModal .modal-dialog').addClass('shake');
      $('.error').addClass('alert alert-danger').html(msg);
      $('input[type="password"]').val('');
      setTimeout( function(){
        $('#loginModal .modal-dialog').removeClass('shake');
      }, 1000 );
    }
  });

  </script>

</body>

</html>
