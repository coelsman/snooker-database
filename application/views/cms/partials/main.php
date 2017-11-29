<!DOCTYPE html>
<html lang="en" class="app">
<head>
  <meta charset="utf-8" />
  <title>Snooker Database - CMS</title>
  <base href="<?php echo base_url(); ?>">
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" /> 
  <link rel="stylesheet" href="assets/libs/bootstrap/css/bootstrap.min.css" type="text/css" />
  <link rel="stylesheet" href="assets/css/animate.css" type="text/css" />
  <link rel="stylesheet" href="assets/css/font-awesome.min.css" type="text/css" />
  <link rel="stylesheet" href="assets/css/font.css" type="text/css" />
  <!-- <link rel="stylesheet" href="assets/js/calendar/bootstrap_calendar.css" type="text/css" /> -->
  <!-- <link rel="stylesheet" href="assets/js/jconfirm/jquery-confirm.min.css" type="text/css" /> -->
  <link rel="stylesheet" href="assets/libs/angular/angular.table.min.css" type="text/css" />
  <link rel="stylesheet" href="assets/css/app.css" type="text/css" />
  <!--[if lt IE 9]>
    <script src="assets/js/ie/html5shiv.js"></script>
    <script src="assets/js/ie/respond.min.js"></script>
    <script src="assets/js/ie/excanvas.js"></script>
  <![endif]-->

  <script type="text/javascript" src="assets/libs/jquery/jquery-2.2.4.min.js"></script>
  <script type="text/javascript" src="assets/libs/angular/angular.min.js"></script>
  <script type="text/javascript" src="assets/libs/bootstrap/js/bootstrap.min.js"></script>
</head>
<body class="" ng-app="snkApp">
  <div id="onload-in-progress"></div>
  <div id="onload-loaded" ng-cloak>
    <?php // if (permission_is_logged_in()): ?>
      <section class="vbox">
        <header class="bg-dark dk header navbar navbar-fixed-top-xs">
          <?php $this->load->view('cms/partials/header'); ?>
        </header>
        <section>
          <section class="hbox stretch">
            <!-- .aside -->
            <aside class="bg-dark b-r lter aside-md hidden-print hidden-xs" id="nav">
              <section class="vbox">
                <?php $this->load->view('cms/partials/menu'); ?>
              </section>
            </aside>
            <!-- /.aside -->
            <section id="content">
              <section class="vbox">
                <section class="bg-white scrollable padder" style="padding-bottom:80px;" ng-view>
                  
                </section>
              </section>
              <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen, open" data-target="#nav,html"></a>
            </section>
            <aside class="bg-light lter b-l aside-md hide" id="notes">
              <div class="wrapper">Notification</div>
            </aside>
          </section>
        </section>
        <!-- <footer id="footer">
          <p class="text-center">RTB System</p>
        </footer> -->
      </section>
    <?php // else:
      // $this->load->view('admin/'.$pageContent);
    // endif; ?>
    <?php $this->load->view('cms/partials/footer'); ?>
  </div>
  <script type="text/javascript">
    $(window).bind("load", function () {
        $('#onload-in-progress').fadeOut(100);
    });
  </script>
</body>
</html>