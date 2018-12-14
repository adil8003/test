<?php
$this->title = Yii::t('app', 'Advertisement');
$id = (isset($_GET['id'])) ? $_GET['id'] : 0;
?>
<input type="hidden" id="banner_id" value="<?php echo $id; ?>" />
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h4 class="title">Add 1 , Add 2  -  Image 
                    <span class="pull-right text-danger">Image size should be 600 * 300</span></h4>
                <hr>
                <div class="row"> 
               <div class="col-sm-6 imageScroll">
                        <form name="form" id="data" style="text-align: center" enctype="multipart/form-data">
                            <div class="row" >
                                <div class="col-md-6">
                                    <div class="form-group" >
                                        <span  class="errmsg" id="err-title"></span>
                                        <input type="text" class="form-control border-input input-xs"  name="title" id="title" placeholder=" Enter Add 1 title "
                                               required/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group" >
                                        <span  class="errmsg" id="err-subtitle"></span> 
                                        <input type="text" class="form-control border-input input-xs"   id="subtitle" name="subtitle"  placeholder="Enter Add 1 sub title"
                                               required/>
                                    </div>
                                </div>
                            </div>
                            <div class="row" >
                                <div class="col-md-12">
                                    <div class="form-group" >
                                        <span  class="errmsg" id="err-file"></span> 
                                        <input type="file" id="file" class="form-control border-input input-xs"   placeholder="Enter banner sub title"
                                               required/>
                                    </div>
                                </div>

                            </div>
                            <div class="text-center">
                                <button type="button" onclick="saveAddone();" class="btn btn-info btn-fill btn-wd btn-xs">Add</button>
                            </div>
                            <div class="clearfix"></div><br>
                        </form>
                        <div id="florplan" class="card">
                            <li> <b >Add 1</b>.</li>
                            <li> Title: <b id="titleFirst"></b></li>
                            <li>Sub title: <b id="subtitleFirst"></b></li>
                            <div class="card-block">
                                <!--<h4 class="card-title">Drop Image Or <button type="button" id="clickiflorplan" class="btn btn-secondary btn-sm">Click here</button></h4>-->
                                <progress id="progressimage" class="hide progress" value="0" max="100">0%</progress>
                            </div>
                            <div class="" id="florPlanList">
                                <img id="subimg1" class="img-thumbnail card-img-top" width="500" src="images/logo.png" alt="Card image cap">
                            </div>
                        </div>


                    </div>
                    <div class="col-sm-6 imageScroll">
                        <form name="form" id="data" style="text-align: center" enctype="multipart/form-data">
                            <div class="row" >
                                <div class="col-md-6">
                                    <div class="form-group" >
                                        <span  class="errmsg" id="err-title2"></span>
                                        <input type="text" class="form-control border-input input-xs"  name="title" id="title2" placeholder=" Enter Add 2 title "
                                               required/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group" >
                                        <span  class="errmsg" id="err-subtitle2"></span> 
                                        <input type="text" class="form-control border-input input-xs"   id="subtitle2" name="subtitle"  placeholder="Enter Add 2 sub title"
                                               required/>
                                    </div>
                                </div>
                            </div>
                            <div class="row" >
                                <div class="col-md-12">
                                    <div class="form-group" >
                                        <span  class="errmsg" id="err-file2"></span> 
                                        <input type="file" id="file2" class="form-control border-input input-xs"   placeholder="Enter banner sub title"
                                               required/>
                                    </div>
                                </div>

                            </div>
                            <div class="text-center">
                                <button type="button" onclick="saveAddtwo();" class="btn btn-info btn-fill btn-wd btn-xs">Add</button>
                            </div>
                            <div class="clearfix"></div><br>
                        </form>
                        <div id="florplan" class="card">
                            <li> <b>Add 2</b>.</li>
                            <li>Title: <b id="titleSecond"></b></li>
                            <li>Sub title: <b id="subtitleSecond"></b></li>
                            <div class="card-block">
                                <!--<h4 class="card-title">Drop Image Or <button type="button" id="clickiflorplan" class="btn btn-secondary btn-sm">Click here</button></h4>-->
                                <progress id="progressimage" class="hide progress" value="0" max="100">0%</progress>
                            </div>
                            <div class="" id="florPlanList">
                                <img id="bannerpic2" class="img-thumbnail card-img-top" width="500" src="images/logo.png" alt="Card image cap">
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="js/subbanner/subbanner.js"></script>
