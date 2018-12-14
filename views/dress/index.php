<?php
$this->title = Yii::t('app', 'Dress');
?>
<input type="hidden" id="listpage" value="1" />

<div class="row" >
    <div class="card" id="" style="min-height: 628px;">
        <div class="header">
            <h5 class="title">Type of dress  <span>

                    <input type="button" onclick="showAddForm();" id="addshirtbutton" class="btn btn-info btn-fill btn-wd btn-xs pull-right" value="Add shirt type"></span></h5>
        </div>
        <hr>
        <div class="col-xs-6">
            <form name="form">
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group ">
                            <span  class="errmsg" id="err-typeofdress"></span> 
                            <input type="text"  class="form-control border-input input-xs"  id="typeofdress" name="typeofdress"  placeholder="Add type"
                                   required/>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <button type="button" onclick="AddtypeofDress();" class="btn btn-info btn-fill btn-wd btn-xs pull-right">Add type</button>
                            <!--<input type="button" onclick="AddtypeofDress();"  class="btn btn-info btn-fill btn-wd btn-xs pull-right" value="Add type">-->
                    </div>
                </div>
                <div class="clearfix"></div>
            </form>
            <form name="form" style="text-align: center" id="addForm">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group ">
                            <label>Dress type:<span class="asterik">*</span><span  class="errmsg" id="err-shirttypeid"></span> </label>
                             <select class="form-control border-input input-sm" name="shirttypeid" id="shirttypeid" style=" padding: 7px 18px; height: 40px;"  placeholder="- Select Customer Status -">
                                    </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 ">
                        <div class="form-group" >
                            <span  class="errmsg" id="err-qty"></span> 
                            <label>Total available qty:<span class="asterik">*</span><span  class="errmsg" id="err-qty"></span> </label>
                            <input type="text" class="form-control border-input input-xs"  id="qty" name="qty"  placeholder="  Total Qty"
                                   required/>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 ">
                        <div class="form-group" >
                            <label>Offer:<span  class="errmsg" id="err-offer"></span> </label>
                            <input type="text" class="form-control border-input input-xs"  id="offer" name="offer"  placeholder="  Offer"
                                   required/>
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <button type="button" onclick="Saveshirttype();" class="btn btn-info btn-fill btn-wd btn-xs">save</button>
                </div>
                <div class="clearfix"></div><br>
            </form>
            <form name="form" style="text-align: center" id="updateForm">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group ">
                            <label>Dress type:<span class="asterik">*</span><span  class="errmsg" id="err-shirttypeid"></span> </label>
                            <input type="text" class="form-control border-input input-xs" disabled="disabled" id="ushirttypeid" name="ushirttypeid" placeholder="  Total Qty">                            
                            <!--<select class="form-control border-input input-sm" name="ushirttypeid" id="ushirttypeid" style=" padding: 7px 18px; height: 40px;"  placeholder="- Select Customer Status -">-->
                            <!--<option id="selectedid"></option>-->
                            <?php
//                                foreach ($objShirttype as $key => $value) {
//                                    echo "<option selected value='$value->id' >" . $value->name . "</option>";
//                                }
                            ?>
                            <!--</select>-->
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 ">
                        <div class="form-group" >
                            <span  class="errmsg" id="err-qty"></span> 
                            <label>Total available qty:<span class="asterik">*</span><span  class="errmsg" id="uerr-qty"></span> </label>
                            <input type="text" class="form-control border-input input-xs"  id="uqty" name="qty"  placeholder="  Total Qty"
                                   required/>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 ">
                        <div class="form-group" >
                            <label>Offer:<span  class="errmsg" id="uerr-offer"></span> </label>
                            <input type="text" class="form-control border-input input-xs"  id="uoffer" name="offer"  placeholder="  Offer"
                                   required/>
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <button type="button" onclick="UpdateSaveshirttype();" class="btn btn-info btn-fill btn-wd btn-xs">Update</button>
                </div>
                <div class="clearfix"></div><br>
            </form>
        </div>
        <div class="col-xs-6">
            <div class="row " id="ShirtList">
                <div class="text-danger" id="notAvailable" style="    text-align: center;">

                </div>

            </div>
        </div>
    </div>

</div>
<script src="js/dress/index.js"></script>
<style>
    #pagination {
        float: right !important;
        display: inline-block;
        padding-left: 0;
        margin: 20px 0;
        border-radius: 4px;
    }
    .morecontent span {
        display: none;
    }
    .morelink {
        display: block;
    }
    .js_topic{
        color: #292929;
        font-size: 1.125rem !important;
        font-weight: bold;
        line-height: 1.2;
        padding-top: 3.25rem;
        margin-bottom: 0.625rem;
    }
    .icon-top{
        position: absolute;
        top: 1.25rem;
        right: 1rem;
        width: 3rem;
        height: 3rem;
        font-size: 20px;
        border-radius: 100%;
    }
    #f1_container {
        position: relative;
        border-top: 8px solid #dd0330;
        /*margin: 10px auto;*/
        width: 316px;
        height: 300px;
        z-index: 1;
        box-shadow: -3px 3px 5px #aaa;
        padding: 8px;
        background: #ffffff;
        border-radius: 2px;
        box-shadow: 0 2px 8px 0 rgba(0, 0, 0, 0.15);
        position: relative;
        transition: box-shadow 0.25s ease-in;

    }
    .shadow{-webkit-box-shadow:  -18px 17px 9px -17px rgba(212,26,26,1);
            -moz-box-shadow: -18px 17px 9px -17px rgba(212,26,26,1);
            box-shadow: -16px 16px 7px -17px rgba(212,26,26,1);
            /*height: 20px !important;*/
            min-height: 100px;
            margin: 14px;
            padding: 6px;
            word-wrap: break-word;
    }
</style>