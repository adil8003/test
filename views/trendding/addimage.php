<?php
$this->title = Yii::t('app', 'Edit');
$id = (isset($_GET['id'])) ? $_GET['id'] : 0;
?>
<input type="hidden" id="trenddingproductid" value="<?php echo $id; ?>" />
<div class="row">
    <div class="col-lg-4 col-md-5">
        <div class="card card-user"><br>
            <h5 class="title text-center">Shirt Images 
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
            <div id="updateprofile">
            </div>
            <div class="changePassword">
                <div class="content" >
                    <div class="header">
                        <h4 class="title">Edit product 
                    </div><br><hr>
                    <div>
                        <form name="form" enctype="multipart/form-data">
                            <div class="row" >
                                <div class="col-md-12">
                                    <div class="form-group" >
                                        <label>Title:<span class="asterik">*</span><span  class="errmsg" id="err-title"></span> </label>
                                        <input type="text" value="<?php echo $objTrenddingproduct->title ?>" class="form-control border-input input-sm"  name="title" id="title" placeholder="  Title "
                                               required/>
                                    </div>
                                </div>
                            </div>
                            <div class="row" >
                                <div class="col-md-12">
                                    <div class="form-group" >
                                        <label>Offer:<span class="asterik">*</span><span  class="errmsg" id="err-offer"></span> </label>
                                        <input type="text" readonly="readonly" value="<?php echo $objTrenddingproduct->offer ?>" class="form-control border-input input-sm" name="offer" id="offer" placeholder=" Offer "
                                               required/>
                                    </div>
                                </div>
                            </div>
                            <div class="row" >
                                <div class="col-md-12">
                                    <div class="form-group" >
                                        <label>Price:<span class="asterik">*</span><span  class="errmsg" id="err-price"></span> </label>
                                        <input type="text" onblur="GetOfferPrice();" value="<?php echo $objTrenddingproduct->price ?>" class="form-control border-input input-sm"  name="price" id="price" placeholder=" Price "
                                               required/>
                                    </div>
                                </div>
                            </div>
                            <div class="row" >
                                <div class="col-md-12">
                                    <div class="form-group" >
                                        <label>Final Price:<span class="asterik">*</span><span  class="errmsg" id="err-offerprice"></span> </label>
                                        <input type="text" readonly="" value="<?php echo $objTrenddingproduct->offerprice ?>" class="form-control border-input input-sm"  name="offerprice" id="offerprice" placeholder=" Offer Price "
                                               required/>
                                    </div>
                                </div>
                            </div>
                            <div class="row" >
                                <div class="col-md-12">
                                    <div class="form-group ">
                                        <label>Product status:</label>
                                        <select class="form-control border-input input-sm" style=" padding: 7px 18px; height: 40px;" id="productstatusid" name="productstatusid" placeholder="- Select Customer Status -">
                                            <?php
                                            foreach ($objProductstatus as $key => $value) {
                                                if ($value->id == $objTrenddingproduct->productstatusid) {
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
                            <div class="row" >
                                <div class="col-md-12">
                                    <div class="form-group ">
                                        <label>Product Type: <span  class="errmsg" id="err-statusid"></span> </label>
                                        <select class="form-control border-input input-sm" style=" padding: 7px 18px; height: 40px;" id="producttypeid" name="producttypeid" placeholder="- Select Customer Status -">
                                            <?php
                                            foreach ($objProducttype as $key => $value) {
                                                if ($value->id == $objTrenddingproduct->producttypeid) {
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
                            <div class="row" >
                                <div class="col-md-12">
                                    <div class="form-group ">
                                        <label>Status: <span  class="errmsg" id="err-statusid"></span> </label>
                                        <select class="form-control border-input input-sm" style=" padding: 7px 18px; height: 40px;" id="statusid" name="statusid" placeholder="- Select Customer Status -">
                                            <?php
                                            foreach ($objStatus as $key => $value) {
                                                if ($value->id == $objTrenddingproduct->statusid) {
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
                                <button type="button" onclick="updateProduct();" class="btn btn-info btn-fill btn-wd">Update Product</button>
                            </div>
                            <div class="clearfix"></div><br>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="js/trendding/addimage.js"></script>

<style>
    .imageScroll{
        /*overflow-y: auto;*/
        height: 600px;
        overflow-y: hidden;
        overflow-y: scroll;
    }
</style>
