<?php
$this->title = Yii::t('app', 'Edit ');
$id = (isset($_GET['id'])) ? $_GET['id'] : 0;
?>
<input type="hidden" id="banner_id" value="<?php echo $id; ?>" />
<div class="row">
    <div class="col-lg-4 col-md-5">
        <div class="card card-user">
            <br><br><br><br>
            <div class="content">
                <div class="author" >
                    <div style="min-height:200px;">
                        <img src="" id="bannerpic" alt="Raised Image" class="img-rounded img-responsive img-raised">
                    </div>
                    <h6 class="card-subtitle text-muted">
                        <progress  style="width:100%;height:5px;margin-bottom: 5px;" id="progressimage" class="hide progress" value="0" max="100">0%</progress>
                    </h6>

                    <h6 style="cursor:pointer;">
                        <span id="bannerImages" class="card-title"> Drop Image Or <i id="profilepic" class="ti-image"></i>
                        </span>&nbsp; 
                        <span id="iconHide"> 
                            <i class="ti-trash" id="picid" onclick="deleteUserImage(<?php echo $id; ?>);"></i>
                        </span>
                        <div  class="errmsg" style="color:red" id="err-file"></div> 
                    </h6>                    
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-8 col-md-7">
        <div  class="card">
            <div class="header">
                <h4 class="title">Edit banner
                    <span>
                        <a href="index.php?r=banner"  <button class="btn btn-info btn-fill btn-xs btn-wd pull-right">Back</button></a>
                    </span> </h4>
            </div><hr>
            <div id="updateprofile">
                <div class="content" >
                    <form name="form" >
                        <div class="row" >
                            <div class="col-md-12">
                                <div class="form-group" >
                                    <label>Title:<span class="asterik">*</span><span  class="errmsg" id="err-title"></span> </label>
                                    <input type="text" value="<?php echo $objBanner->title ?>" class="form-control border-input input-sm"  name="title" id="title" placeholder="  Title "
                                           required/>
                                </div>
                            </div>
                        </div>
                        <div class="row" >
                            <div class="col-md-12 ">
                                <div class="form-group" >
                                    <label>Sub title:<span class="asterik">*</span><span  class="errmsg" id="err-subtitle"></span> </label>
                                    <input type="text" value="<?php echo $objBanner->subtitle ?>"  class="form-control border-input input-sm"   id="subtitle" name="subtitle"  placeholder="  Sub title "
                                           required/>
                                </div>
                            </div>
                        </div>
                        <div class="row" >
                            <div class="col-md-12 ">
                                <div class="form-group ">
                                    <label>Banner status: <span  class="errmsg" id="err-statusid"></span> </label>
                                    <select class="form-control border-input input-sm" style=" padding: 7px 18px; height: 40px;" id="statusid" name="statusid" placeholder="- Select  Status -">

                                        <?php
                                        foreach ($objStatus as $key => $value) {
                                            if ($value->id == $objBanner->statusid) {
                                                echo "<option selected value='$value->id' >" . $value->name . "</option>";
                                            } else {
                                                echo "<option value='$value->id' >" . $value->name . "</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="button" onclick="updateBanner();" class="btn btn-info btn-fill btn-wd">Update banner</button>
                        </div>
                        <div class="clearfix"></div><br>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="js/banner/editbanner.js"></script>