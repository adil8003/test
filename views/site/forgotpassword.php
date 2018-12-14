<?php
$this->title = Yii::t('app', 'Forgot password');
?>
<div class="jumbotron">
    <div class="container">
        <div class="col-sm-8 col-sm-offset-2">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="login-card card" style="min-height: 400px;">
                        <div class="header text-center">
                            <h4 class="title" style="color:#fff">Forgot password</h4>
                        </div><br><br><br>
                        <div class="content">
                            <form id="form-login" onsubmit="checkPasswordMatch(); ">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group" >
                                            <label style="color: #fff !important">Username:<span class="asterik">*</span>
                                                <span  class="errmsg" style="color: #fff !important" id="err-email"></span> </label>
                                            <input  type="email" class="form-control border-input" onblur="checkEmail();" placeholder="Email" name="email"  id="email" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group" >
                                            <label style="color: #fff !important">New Password:<span class="asterik">*</span>
                                                <span class="errmsg" style="color: #fff !important"  id="err-newpassword"></span> </label>
                                            <input  type="password" class="form-control border-input"  placeholder="New password" id="newpassword" name="newpassword"  required>  
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group" >
                                            <label style="color: #fff !important">Confirm Password:<span class="asterik">*</span>
                                                <span class="errmsg"  style="color: #fff !important" id="err-confirmpassword"></span> </label>
                                            <input  type="password" class="form-control border-input"  placeholder="Confirm password" id="confirmpassword" name="confirmpassword"  required>  
                                        </div>
                                    </div>
                                </div>

                                <div class="text-center">
                                    <button   type="button" onclick="saveChangePassword();" class="btn btn-info btn-fill btn-wd">Save password</button>
                                </div>
                                <div class="clearfix"></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="js/site/login.js"></script>