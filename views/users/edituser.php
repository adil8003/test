<?php
$this->title = Yii::t('app', 'Edit user');
$id = (isset($_GET['id'])) ? $_GET['id'] : 0;
?>
<input type="hidden" id="user_id" value="<?php echo $id; ?>" />

<div class="row">
    <div class="col-lg-4 col-md-5">
        <div class="card card-user">
            <br><br><br><br>
            <div class="content">
                <div class="author" id="userProfile">
                    <img src="" id="userimage" alt="Raised Image" class="img-rounded img-responsive img-raised"><br>
                    <h6 class="card-title">Drop Image Or <button type="button" id="profilepic" class="btn btn-secondary btn-sm">Click here</button></h6>
                    <h6 class="card-subtitle text-muted">
                        <progress id="progressimage" class="hide progress" value="0" max="100">0%</progress>
                    </h6><br>
                    <a href="#" id="iconHide" >
                        <i class="ti-trash" id="picid" onclick="getUserid(<?php echo Yii::$app->session['userid']; ?>);"></i>
                    </a><br>

                </div>
            </div>
            <hr>
        </div>
    </div>
    <div class="col-lg-8 col-md-7">
        <div  class="card">
            <div class="header">
                <h4 class="title">Edit user  <span>
                    <a href="index.php?r=users"  <button class="btn btn-info btn-fill btn-xs btn-wd pull-right">Back</button></a>
                </span></h4>
            </div><hr>
            <div id="editUser">
            </div>
        </div>
    </div>
</div>
<script src="js/users/editusers.js"></script>



