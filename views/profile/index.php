<?php
$this->title = Yii::t('app', 'Profile');
?>
<input type="hidden" id="userid" value="<?php echo Yii::$app->session['userid']; ?>" />
<div class="row">
    <div class="col-lg-4 col-md-5">
        <div class="card card-user">
            <br><br><br><br>
            <div class="content">
                <div class="author" >
                    <div style="min-height:200px;">
                        <img src="" id="profilepic-admin" alt="Raised Image" class="img-rounded img-responsive img-raised">
                    </div>
                    <h6 class="card-subtitle text-muted">
                        <progress  style="width:100%;height:5px;margin-bottom: 5px;" id="progressimage" class="hide progress" value="0" max="100">0%</progress>
                    </h6>
                    <h5 class="title title-height adminName" ><?php echo Yii::$app->session['name']; ?></h5>
                    <h5><a href="#"><small><?php echo Yii::$app->session['role']; ?></small></a></h5>
                    
                    <h6 style="cursor:pointer;">
                        <span id="userProfile" class="card-title"> Drop Image Or <i id="profilepic" class="ti-image"></i>
                        </span>&nbsp; 
                        <span id="iconHide"> 
                            <i class="ti-trash" id="picid" onclick="deleteUserImage(<?php echo Yii::$app->session['userid']; ?>);"></i>
                        </span>
                    </h6>                    
                </div>
            </div>
            <hr>
        </div>
    </div>
    <div class="col-lg-8 col-md-7">
        <div  class="card">
            <div id="updateprofile">
            </div>
            <div class="changePassword">
                <div class="content" >
                    <div class="header">
                        <h4 class="title">Change password 
                            <button id="passForm"  class="btn btn-info btn-fill btn-xs btn-wd pull-right">Edit profile</button></span></h4> 
                    </div><br><hr>
                    <div>
                        <form name="form" id="customercam" onsubmit="checkPasswordMatch();">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group" >
                                        <label>Old password:<span class="asterik">*</span>
                                            <span  class="errmsg" id="err-currentpassword"></span> </label>
                                        <input type="password" class="form-control border-input input-sm"   id="currentpassword" onblur="checkCurrentpass();" name="currentpassword"  placeholder="Old Password" required/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group" >
                                        <label>Password:<span class="asterik">*</span>
                                            <span class="errmsg" id="err-newpassword"></span> </label>
                                        <input type="password" class="form-control border-input input-sm" id="newpassword"   name="newpassword"  placeholder="Password" required/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group" >
                                        <label>Confirm password:<span class="asterik">*</span>
                                            <span class="errmsg" id="err-confirmpassword"></span> </label>
                                        <input type="password" class="form-control border-input input-sm"  id="confirmpassword"    name="confirmpassword"   placeholder="Confirm Password" required/>
                                    </div>
                                </div>
                            </div>

                            <div class="text-center">
                                <button type="button" onclick="saveChangePassword();" class="btn btn-info btn-fill btn-wd">Update password</button>
                            </div>
                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="js/profile/profile.js"></script>


