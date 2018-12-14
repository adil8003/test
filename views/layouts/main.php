<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
	    <!-- The fav icon -->
    <link rel="shortcut icon" href="img/favicon.ico">
    <script src="/vendor/jquery/jquery.js"></script>
</head>
<body>

<?php $this->beginBody() ?>
<section id="container" class="">  <!-- container section start -->
	<header class="header dark-bg">
        <div class="toggle-nav">
            <div class="icon-reorder tooltips" data-original-title="Toggle Navigation" data-placement="bottom"><i class="icon_menu"></i></div>
        </div>
		<!--logo start-->
		<a href="index.html" class="logo">Business <span class="lite">Management</span></a>
		<!--logo end-->
		<div class="top-nav notification-row hide">
			<!-- notificatoin dropdown start-->
			<ul class="nav pull-right top-menu">

				<!-- user login dropdown start-->
				<li class="dropdown">
					<a data-toggle="dropdown" class="dropdown-toggle" href="#">
						<span class="profile-ava">
							<i class="icon_profile"></i>
						</span>
						<span class="username">Jenifer Smith</span>

					</a>
					<ul class="dropdown-menu extended logout">
						<div class="log-arrow-up"></div>
						<li class="eborder-top">
							<a href="#"><i class="icon_profile"></i> My Profile</a>
						</li>
						<li>
							<a href="login.html"><i class="icon_key_alt"></i> Log Out</a>
						</li>
					</ul>
				</li>
				<!-- user login dropdown end -->
			</ul>
			<!-- notificatoin dropdown end-->
		</div>
      </header>
      <!--header end-->

      <!--sidebar start-->
      <aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu">
                  <li class="active">
                      <a class="" href="index.html">
                          <i class="icon_house_alt"></i>
                          <span>Dashboard</span>
                      </a>
                  </li>
				    <li class="sub-menu">
                      <a href="javascript:;" class="">
                          <i class="icon_desktop"></i>
                          <span>UI Fitures</span>
                          <span class="menu-arrow arrow_carrot-right"></span>
                      </a>
                      <ul class="sub">
                          <li><a class="" href="general.html">Elements</a></li>
                          <li><a class="" href="buttons.html">Buttons</a></li>
                          <li><a class="" href="grids.html">Grids</a></li>
                      </ul>
                  </li>
				  <li class="active">
                      <a class="" href="index.html">
                          <i class="icon_house_alt"></i>
                          <span>Logout</span>
                      </a>
                  </li>
              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>
      <!--sidebar end-->


    <section id="main-content"><!--main content start-->
        <section class="wrapper"> <!--wraper start-->

		<?= $content ?>

		</section><!--wrapper end-->
    </section><!--main content end-->
</section>  <!-- container section end -->
    <!-- javascripts -->
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
