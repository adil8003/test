<?php
$this->title = Yii::t('app', 'Edit');
$id = (isset($_GET['id'])) ? $_GET['id'] : 0;
?>
<input type="hidden" id="shirttypeid" value="<?php echo $id; ?>" />
<input type="hidden" id="listpage" value="1" />
<div class="row">
    <div class="col-lg-4 col-md-5">
        <div class="card card-user">
            <div id="updateprofile">
                <div class="content" >
                    <form name="form" enctype="multipart/form-data">
                        <div class="row" >
                            <div class="col-md-12">
                                <div class="form-group" >
                                    <label>Title:<span class="asterik">*</span><span  class="errmsg" id="err-title"></span> </label>
                                    <input type="text" class="form-control border-input input-sm"  name="title" id="title" placeholder="  Title "
                                           required/>
                                </div>
                            </div>
                        </div>
                        <div class="row" >
                            <div class="col-md-12">
                                <div class="form-group" >
                                    <label>Offer:<span class="asterik">*</span><span  class="errmsg" id="err-offer"></span> </label>
                                    <input type="text" readonly="readonly" value="<?php echo $objShirts->offer ?>" class="form-control border-input input-sm" name="offer" id="offer" placeholder=" Offer "
                                           required/>
                                </div>
                            </div>
                        </div>
                        <div class="row" >
                            <div class="col-md-12">
                                <div class="form-group" >
                                    <label>Price:<span class="asterik">*</span><span  class="errmsg" id="err-price"></span> </label>
                                    <input type="text" onblur="GetOfferPrice();" class="form-control border-input input-sm"  name="price" id="price" placeholder=" Price "
                                           required/>
                                </div>
                            </div>
                        </div>
                        <div class="row" >
                            <div class="col-md-12">
                                <div class="form-group" >
                                    <label>Final Price:<span class="asterik">*</span><span  class="errmsg" id="err-offerprice"></span> </label>
                                    <input type="text" readonly="" class="form-control border-input input-sm"  name="offerprice" id="offerprice" placeholder=" Offer Price "
                                           required/>
                                </div>
                            </div>
                        </div>
                        <div class="row" >
                            <div class="col-md-12">
                                <div class="form-group ">
                                    <label>Product status: <span  class="errmsg" id="err-statusid"></span> </label>
                                    <select class="form-control border-input input-sm" style="padding: 7px 18px;height:40px;" id="productstatusid" name="productstatusid" placeholder="- Select  Status -">
                                        <?php
                                        foreach ($objProductstatus as $key => $value) {
                                            echo "<option value='$value->id' >" . $value->name . "</option>";
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
                                    <select class="form-control border-input input-sm" style=" padding: 7px 18px; height: 40px;" id="producttypeid" name="producttypeid" placeholder="- Select  Status -">
                                        <?php
                                        foreach ($objProducttype as $key => $value) {
                                            echo "<option value='$value->id' >" . $value->name . "</option>";
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
                                    <select class="form-control border-input input-sm" style=" padding: 7px 18px; height: 40px;" id="statusid" name="statusid" placeholder="- Select  Status -">
                                        <?php
                                        foreach ($objStatus as $key => $value) {
                                            echo "<option value='$value->id' >" . $value->name . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row" >
                            <div class="col-md-12">
                                <div class="form-group" >
                                    <label>Select image:<span class="asterik">*</span><span  class="errmsg" id="err-file"></span> </label>
                                    <input type="file" multiple="multiple" class="form-control border-input input-sm " name="file" id="file" placeholder="  "
                                           required/>
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="button" onclick="saveShirtProduct();" class="btn btn-info btn-fill btn-wd">Save Product</button>
                        </div>
                        <div class="clearfix"></div><br>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-8 col-md-7">
        <div  class="card">
            <div class="header">
                <h4 class="title">Product List
                    <span>
                        <a href="index.php?r=trendding"  <button class="btn btn-info btn-fill btn-xs btn-wd pull-right">Back</button></a>
                    </span> </h4>
            </div><hr>
            <div id="updateprofile">
                <div class="content" style="    padding: 0px 9px 10px 10px;" id="loadtweets">
                    <div class="row" id="sProduct">
                        <div class="text-danger" id="notAvailable" style="    text-align: center;">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="js/dress/add.js"></script>
<style>
    img {
    max-width: 100%;
    /*height: auto;*/
}

.item {
    width: 120px;
    height: 120px;
/*    height: auto;
    float: left;
    margin: 3px;
    padding: 3px;*/
}
</style>