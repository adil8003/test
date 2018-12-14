<?php
$this->title = Yii::t('app', 'Settings');
?>
<input type="hidden" id="userid"  value="<?php echo yii::$app->session['userid'] ?>"/>
<div class="row" >
    <div class="card" id="" >
        <div class="header">
            <h5 class="title">Course  List   </h5>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-12">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#home">Home</a></li>
                    <li><a data-toggle="tab" href="#menu1">Menu 1</a></li>
                    <li><a data-toggle="tab" href="#menu2">Menu 2</a></li>
                    <li><a data-toggle="tab" href="#menu3">Menu 3</a></li>
                </ul>

                <div class="tab-content">
                    <div id="home" class="tab-pane fade in active">
                        <h3>HOME</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                    </div>
                    <div id="menu1" class="tab-pane fade">
                        <h3>Menu 1</h3>
                        <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                    </div>
                    <div id="menu2" class="tab-pane fade">
                        <h3>Menu 2</h3>
                        <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
                    </div>
                    <div id="menu3" class="tab-pane fade">
                        <h3>Menu 3</h3>
                        <p>Eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
                    </div>
                </div>

            </div>

        </div>
    </div>

</div>
<style>
    .js_topic{
        color: #292929;
        font-size: 1.125rem !important;
        font-weight: bold;
        line-height: 1.2;
        padding-top: 3.25rem;
        margin-bottom: 0.625rem;
    }
    .icon-top{
        position: absolute;
        top: 1.25rem;
        right: 1rem;
        width: 3rem;
        height: 3rem;
        font-size: 20px;
        border-radius: 100%;
    }
    #f1_container {
        position: relative;
        border-top: 8px solid #08143ce0;
        /*margin: 10px auto;*/
        width: 325px;
        height: 181px;
        z-index: 1;
        box-shadow: -3px 3px 5px #aaa;
        padding: 8px;
        background: #ffffff;
        border-radius: 2px;
        box-shadow: 0 2px 8px 0 rgba(0, 0, 0, 0.15);
        position: relative;
        transition: box-shadow 0.25s ease-in;

    }
</style>
