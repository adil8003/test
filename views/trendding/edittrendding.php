<?php
$this->title = Yii::t('app', 'Edit');
$id = (isset($_GET['id'])) ? $_GET['id'] : 0;
?>
<input type="hidden" id="t_id" value="<?php echo $id; ?>" />
<div class="row">
     <div class="col-lg-4 col-md-5">
        <div class="card card-user">
            <br><br><br><br>
            <div class="content">
                <div class="author" id="courseImage">
                    <img src="" id="curspic" alt=" course image" class="img-rounded img-responsive img-raised"><br>
                    <h6 class="card-title">Drop Image Or <button type="button" id="coursepic" class="btn btn-secondary btn-sm">Click here</button></h6>
                    <h6 class="card-subtitle text-muted">
                        <progress id="progressimage" class="hide progress" value="0" max="100">0%</progress>
                    </h6><br>
                    <a href="#" id="iconHide" > 
                        <i class="ti-trash" id="picid" onclick="getTrendid(<?php echo $id; ?>);"></i>
                    </a><br>
                     <div  class="errmsg" style="color:red" id="err-file"></div> 
                </div>
                <hr>
            </div>
        </div>
    </div>
    <div class="col-lg-8 col-md-7">
        <div  class="card">
            <div class="header">
                <h4 class="title">Edit
                    <span>
                        <a href="index.php?r=trendding"  <button class="btn btn-info btn-fill btn-xs btn-wd pull-right">Back</button></a>
                    </span> </h4>
            </div><hr>
            <div id="updateprofile">
                <div class="content" >
                    <form name="form" >
                        <div class="row" >
                            <div class="col-md-6 ">
                                <div class="form-group" >
                                    <label>Title:<span class="asterik">*</span><span  class="errmsg" id="err-title"></span> </label>
                                    <input type="text" class="form-control border-input input-sm" value="<?php echo $objTrendding->title ?>" name="title" id="title" placeholder="  Title "
                                           required/>
                                </div>
                            </div>
                            <div class="col-md-6 ">
                                <div class="form-group" >
                                    <label>Sub title: <span  class="errmsg" id="err-subtitle"></span> </label>
                                    <input type="text" class="form-control border-input input-sm"  value="<?php echo ($objTrendding->subtitle)?>"   name="subtitle" id="subtitle" placeholder="Sub title "
                                           required/>
                                </div>
                            </div>
                        </div>


                        <div class="row" >
                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label>Status:<span class="asterik">*</span><span  class="errmsg" id="err-statusid"></span> </label>
                                    <select class="form-control border-input input-sm" name="statusid" id="statusid" style=" padding: 7px 18px; height: 40px;"  placeholder="- Select Customer Status -">
                                        <?php
                                        foreach ($objTstatus as $key => $value) {
                                            if ($value->id == $objTrendding->statusid) {
                                                echo "<option selected value='$value->id' >" . $value->name . "</option>";
                                            } else {
                                                echo "<option value='$value->id' >" . $value->name . "</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                    <p id="err-orgstatus" class="text-danger"></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group" >
                                    <label>Offer:<span class="asterik">*</span><span  class="errmsg" id="err-offer"></span> </label>
                                    <input type="text" class="form-control border-input input-sm" value="<?php echo $objTrendding->offer ?>" name="offer" id="offer" placeholder=" Offer "
                                           required/>
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="button" onclick="saveUpdate();" class="btn btn-info btn-fill btn-wd">Update</button>
                        </div>
                        <div class="clearfix"></div><br>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="js/trendding/edit.js"></script>