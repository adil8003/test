<?php
$this->title = Yii::t('app', 'Add product');
?>
<input type="hidden" id="user_id" value="<?php echo Yii::$app->session['userid']; ?>" />
<div class="row">

    <div class="col-lg-12 col-md-7">
        <div  class="card">
            <div class="header">
                <h4 class="title">New Arrivals Add product
                    <span>
                        <a href="index.php?r=newarrivals"  <button class="btn btn-info btn-fill btn-xs btn-wd pull-right">Back</button></a>
                    </span> </h4>
            </div><hr>
            <div id="updateprofile">
                <div class="content">
                    <form name="form" enctype="multipart/form-data">
                        <div class="row" >
                            <div class="col-md-6 ">
                                <div class="form-group" >
                                    <label>Title:<span class="asterik">*</span><span  class="errmsg" id="err-title"></span> </label>
                                    <input type="text" class="form-control border-input input-sm" name="title" id="title" placeholder=" Title "
                                           required/>
                                </div>
                            </div>
                            <div class="col-md-6 ">
                                <div class="form-group" >
                                    <label>Sub title: <span  class="errmsg" id="err-subtitle"></span> </label>
                                    <input type="text" class="form-control border-input input-sm" name="subtitle" id="subtitle" placeholder="Sub title "
                                           required/>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group" >
                                    <label>Offer:<span class="asterik">*</span><span  class="errmsg" id="err-offer"></span> </label>
                                    <input type="text"   class="form-control border-input input-sm" name="offer" id="offer" placeholder=" Offer "
                                           required/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group" >
                                    <label>Original Price:<span class="asterik">*</span><span  class="errmsg" id="err-price"></span> </label>
                                    <input type="text" class="form-control border-input input-sm" name="price" id="price" placeholder=" Price "
                                           required/>
                                </div>
                            </div>
                        </div>
                        <div class="row">
<!--                            <div class="col-md-6">
                                <div class="form-group" >
                                    <label>Final Price:<span class="asterik">*</span><span  class="errmsg" id="err-offerprice"></span> </label>
                                    <input type="text" readonly="" class="form-control border-input input-sm"  name="offerprice" id="offerprice" placeholder=" Offer Price "
                                           required/>
                                </div>
                            </div>-->
                            <div class="col-md-12">
                                <div class="form-group" >
                                    <label>Select image:<span class="asterik">*</span><span  class="errmsg" id="err-file"></span> </label>
                                    <input type="file" class="form-control border-input input-sm" name="files[]" id="files" multiple="" placeholder="  "
                                           required/>
                                </div>
                            </div>
                        </div>
                        <div class="row" >
                            <div class="col-md-6 ">
                                <div class="form-group ">
                                    <label>Product status: <span  class="errmsg" id="err-statusid"></span> </label>
                                    <select class="form-control border-input input-sm" style=" padding: 7px 18px; height: 40px;" id="statusid" name="statusid" placeholder="- Select  Status -">
                                        <?php
                                        foreach ($objStatus as $key => $value) {
                                            echo "<option value='$value->id' >" . $value->name . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label>Product Mode: <span  class="errmsg" id="err-productstatusid"></span> </label>
                                    <select class="form-control border-input input-sm" style=" padding: 7px 18px; height: 40px;" id="productstatusid" name="productstatusid " placeholder="- Select  Status -">
                                        <?php
                                        foreach ($objProductstatus as $key => $value) {
                                            echo "<option value='$value->id' >" . $value->name . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="button" onclick="saveProduct();" class="btn btn-info btn-fill btn-wd">Save Product</button>
                        </div>
                        <div class="clearfix"></div><br>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="js/newarrivals/add.js"></script>