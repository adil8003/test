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
        <script src="vendor/jquery/jquery.js"></script>
        <script type='text/javascript' src='js/common/common.js' ></script>
        <link rel="shortcut icon" href="img/favicon.ico">
    </head>
    <body>
        <?php $this->beginBody() ?>
        <div class="wrapper">
            <div class="sidebar" data-background-color="white" data-active-color="danger">
                <div class="sidebar-wrapper">
                    <div class="logo">
                        <a href="#" class="simple-text">
                            KASHISH
                            <div style="font-size:8px" id="version">  </div>
                         </a>
                    </div>
                    <ul  class="nav" id="sidemenus">
                        <?php // if (Yii::$app->session['role'] === 'Admin') { ?>
                            <li class="active">
                                <a class="" href="index.php?r=dashboard">
                                    <i class="ti-dashboard"></i>
                                    <p>Dashboard</p>
                                </a>
                            </li>
                            <li class="sub-menu">
                                <a href="index.php?r=jewellery">
                                    <i class="ti-id-badge"></i>
                                    <p>jewellery</p>
                                </a>
                            </li>
                            <li class="sub-menu">
                                <a href="index.php?r=banner">
                                    <i class="ti-id-badge"></i>
                                    <p>Banner</p>
                                </a>
                            </li>
<!--                            <li class="sub-menu">
                                <a href="index.php?r=subbanner">
                                    <i class="ti-id-badge"></i>
                                    <p>Add - 1 AND ADD - 2</p>
                                </a>
                            </li>-->
                            <li class="sub-menu">
                                <a href="index.php?r=trendding">
                                    <i class="ti-id-badge"></i>
                                    <p>WHAT’S TRENDDING</p>
                                </a>
                            </li>
                            <li class="sub-menu">
                                <a href="index.php?r=newarrivals">
                                    <i class="ti-id-badge"></i>
                                    <p>New arrivals</p>
                                </a>
                            </li>
                            <li class="sub-menu">
                                <a href="index.php?r=dress">
                                    <i class="ti-id-badge"></i>
                                    <p>Dress categories</p>
                                </a>
                            </li>
<!--                            <li class="sub-menu">
                                <a href="index.php?r=dealer">
                                    <i class="ti-id-badge"></i>
                                    <p>Dealers</p>
                                </a>
                            </li>-->
                            <li class="sub-menu">
                               <a href="index.php?r=profile">
                                    <i class="ti-id-badge"></i>
                                    <p>Profile</p>
                                </a>
                            </li>
                            <li class="sub-menu">
                                <a href="index.php?r=settings">
                                    <i class="ti-settings"></i>
                                    <p>Settings</p>
                                </a>
                            </li>
                            <li class="sub-menu">
                                <a href="index.php?r=site/logout">
                                    <i class="ti-lock"></i>
                                    <p>Logout</p>
                                </a>
                            </li>

                    </ul>
                </div>
            </div>

            <div class="main-panel">  
                <nav class="navbar navbar-default">
                    <div class="container-fluid">
                        <div class="navbar-header">
                            <div id="alert-msg" class="alert"> </div>
                            <button type="button" class="navbar-toggle">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar bar1"></span>
                                <span class="icon-bar bar2"></span>
                                <span class="icon-bar bar3"></span>
                            </button>
                            <a class="navbar-brand" href="#">Hi <?php echo Yii::$app->session['name']; ?> <span style="font-size: 15px;"> </span></a>
                        </div>
                        <div class="collapse navbar-collapse">
                            <ul class="nav navbar-nav navbar-right">
                                <!-- <alert></alert>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <i class="ti-bell"></i>
                                        <p class="notification">5</p>
                                        <p>Notifications</p>
                                        <b class="caret"></b>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a href="#">Notification 1</a></li>
                                        <li><a href="#">Notification 2</a></li>
                                        <li><a href="#">Notification 3</a></li>
                                        <li><a href="#">Notification 4</a></li>
                                        <li><a href="#">Another notification</a></li>
                                    </ul>
                                </li> -->
                                <!--  <li>
                                     <a href="index.php?r=site/logout">
                                         <i class="ti-lock"></i>
                                         <p>Logout</p>
                                     </a>
                                 </li> -->
                            </ul>

                        </div>
                    </div>
                </nav>


                <div class="content">
                    <div class="container-fluid">
                        <!--<div id="main-content">-->
                            <!--<section class="content">-->
                        <?= $content ?>
                        <!--</section>wrapper end-->
                        <!--</div>main content end-->
                    </div>
                </div>

            </div>
<!--            <footer class="footer footercss hide">
                <div class="container-fluid">
                    <nav class="pull-left">
                        <ul>
                            <li>
                                <a href="#">
                                    Home
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    Privacy Policy
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    Terms & Conditions
                                </a>
                            </li>
                        </ul>
                    </nav>
                    <div class="copyright pull-right">
                        &copy; <?php echo $today = date("F j, Y"); ?>, made with <i class="fa fa-heart heart" id="demo"></i> by <a href="https://www.imgapti.com">IMGAPTI</a>
                    </div>
                </div>
            </footer>-->
        </div>

        <!-- javascripts -->
        <script>
            $(document).ready(function () {
              getVersion();


                var strUrl = window.location.href;
                var curURl = getUrlMenu();
                var strLastUrl = strUrl.replace(curURl, '');
                var curText = getCurText(strLastUrl);
                $('#sidemenus li ').each(function (k, v) {
                    $(this).removeClass('active');
                    var txt = $(this).find('a p').html().trim().toLowerCase();
                    if (curText == txt) {
                        $(this).addClass('active');
                    }
                })
                function getCurText(strLastUrl) {
                    var curtext = 'dashboard';
                    var n = strLastUrl.indexOf('/');
                    var text = strLastUrl.substring(0, n != -1 ? n : strLastUrl.length);
                    switch (text) {
                        case 'course':
                            curtext = 'courses';
                            break;
                        case 'dashboard':
                            curtext = 'dashboard';
                            break;
                        case 'banner':
                            curtext = 'banner';
                            break;
                        case 'subbanner':
                            curtext = 'subbanner';
                            break;
                        case 'trendding':
                            curtext = 'trendding';
                            break;
                        case 'settings':
                            curtext = 'settings';
                            break;
                        case 'employeecourses':
                            curtext = 'course';
                            break;
                        case 'employeeorganisation':
                            curtext = 'organisation';
                            break;
                        case 'users':
                            curtext = 'users';
                            break;
                        case 'orgusers':
                            curtext = 'employees';
                            break;
                        case 'admincourse':
                            curtext = 'courses';
                            break;
                    }
                    return curtext;
                }
            });
              function getVersion() {
                    $.ajax({
                        url: '/package.json',
                        async: false,
                        success: function (data) {
                            $('#version').html('<div style="font-size:8px" id="version">version  '+ data.version +'</div>')
                        },
                        error: function (data) {
                            showMessage('danger', 'Please try again.');
                        }
                    });
                }
        </script>
        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>