<?php
$this->title = Yii::t('app', 'Edit');
$id = (isset($_GET['id'])) ? $_GET['id'] : 0;
?>
<input type="hidden" id="p_id" value="<?php echo $id; ?>" />
<div class="row">
    <div class="col-lg-4 col-md-5">
        <div class="card card-user"><br>
            <h5 class="title text-center">Product Images 
                </h5><hr>
            <br>
            <br>
            <br>
            <div class="content">
                
                <div class="author">
                    <div class="row"> 
                        <div class="col-sm-12  imageScroll">
                            <div id="imageamaneti" class="card">
                                <!--<li>Upload multiple image.</li>-->
                                <!--                                <div class="card-block">
                                                                    <h4 class="card-title">Drop Image Or <button type="button" id="clickimageamaneti" class="btn btn-secondary btn-sm">Click here</button></h4>
                                                                    <progress id="progressimage" class="hide progress" value="0" max="100">0%</progress>
                                                                </div>-->
                                <form enctype="multipart/form-data">
<!--                                    <p  class="errmsg" id="err-files"></p> 
                                    <input type="file" name="files[]" id="files" multiple="">
                                    <br>-->
                                    <div class="row" >
                                        <div class="col-md-12">
                                            <div class="form-group" >
                                                <label>Select image:<span class="asterik">*</span><span  class="errmsg" id="err-files"></span> </label>
                                                <input type="file" multiple="multiple" class="form-control border-input input-sm " name="files[]" id="files" placeholder="  "
                                                       required/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button type="button" onclick="uploadImages();" class="btn btn-info btn-fill btn-wd">Upload image</button>
                                    </div>
                                </form>
                                <div  class="errmsg" style="color:red" id="err-file"></div> 
                                <!--<hr style="color:red;">-->
                                <br>
                                <div class="" id="shirtList">
                                    <img id="imageId22" class="img-thumbnail card-img-top" src="images/logo.png" alt="shirt image ">
                                </div>
                            </div>
                        </div>

                    </div>            
                </div>
            </div>
            <hr>
        </div>
    </div>
    <div class="col-lg-8 col-md-7">
        <div  class="card">
            <div class="header">
                <h4 class="title">Edit product
                    <span>
                        <a href="index.php?r=newarrivals"  <button class="btn btn-info btn-fill btn-xs btn-wd pull-right">Back</button></a>
                    </span> </h4>
            </div><hr>
            <div id="updateprofile">
                <div class="content" >
                    <form name="form" >
                        <div class="row" >
                            <div class="col-md-6 ">
                                <div class="form-group" >
                                    <label>Title:<span class="asterik">*</span><span  class="errmsg" id="err-title"></span> </label>
                                    <input type="text" value="<?php echo $objNewarrivalproduct->title ?>" class="form-control border-input input-sm" name="title" id="title" placeholder="  Organisationa Name "
                                           required/>
                                </div>
                            </div>
                            <div class="col-md-6 ">
                                <div class="form-group" >
                                    <label>Sub title: <span  class="errmsg" id="err-subtitle"></span> </label>
                                    <input type="text" value="<?php echo $objNewarrivalproduct->subtitle ?>" class="form-control border-input input-sm" name="subtitle" id="subtitle" placeholder="Description "
                                           required/>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group" >
                                    <label>Offer:<span class="asterik">*</span><span  class="errmsg" id="err-offer"></span> </label>
                                    <input type="text" readonly=""  value="<?php echo $objNewarrivalproduct->offer ?>" class="form-control border-input input-sm" name="offer" id="offer" placeholder=" Offer "
                                           required/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group" >
                                    <label>Price:<span class="asterik">*</span><span  class="errmsg" id="err-price"></span> </label>
                                    <input type="text" onblur="GetOfferPrice();" value="<?php echo $objNewarrivalproduct->price ?>" class="form-control border-input input-sm" name="price" id="price" placeholder=" Fees "
                                           required/>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group" >
                                    <label>Final price:<span class="asterik">*</span><span  class="errmsg" id="err-offerprice"></span> </label>
                                    <input type="text" readonly="" value="<?php echo $objNewarrivalproduct->offerprice ?>" class="form-control border-input input-sm" name="offerprice" id="offerprice" placeholder=" Fees "
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
                                            if ($value->id == $objNewarrivalproduct->statusid) {
                                                echo "<option selected value='$value->id' >" . $value->name . "</option>";
                                            } else {
                                                echo "<option value='$value->id' >" . $value->name . "</option>";
                                            }
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
                                            if ($value->id == $objNewarrivalproduct->productstatusid) {
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
                            <button type="button" onclick="updateProduct();" class="btn btn-info btn-fill btn-wd">Update</button>
                        </div>
                        <div class="clearfix"></div><br>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="js/newarrivals/edit.js"></script>

<style>
    .imageScroll{
        /*overflow-y: auto;*/
        height: 600px;
        overflow-y: hidden;
        overflow-y: scroll;
    }
</style>