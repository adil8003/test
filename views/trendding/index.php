<?php
$this->title = Yii::t('app', 'Trending');
?>
<input type="hidden" id="user_id" value="<?php echo Yii::$app->session['userid']; ?>" />
<input type="hidden" id="listpage" value="1" />

<div class="row" >
    <div class="card" id="" style="min-height: 628px;">
        <div class="header">
            <h5 class="title">Trending List   </h5>
        </div>
        <hr>
        <div class="col-xs-4">
            <form name="form" style="text-align: center" id="showForm">
                <div class="row" >
                    <div class="col-xs-12">
                        <div class="form-group" >
                            <span  class="errmsg" id="err-title"></span>
                            <input type="text" class="form-control border-input input-xs"  name="title" id="title" placeholder="  Title "
                                   required/>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 ">
                        <div class="form-group" >
                            <span  class="errmsg" id="err-subtitle"></span> 
                            <input type="text" class="form-control border-input input-xs"   id="subtitle" name="subtitle"  placeholder="  Sub title "
                                   required/>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 ">
                        <div class="form-group" >
                            <span  class="errmsg" id="err-offer"></span> 
                            <input type="text" class="form-control border-input input-xs"  id="offer" name="offer"  placeholder="  Offer"
                                   required/>
                        </div>
                    </div>
                </div>
<!--                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group ">
                            <span  class="errmsg" id="err-statusid"></span> 
                            <select class="form-control border-input input-sm" name="statusid" id="statusid" style=" padding: 7px 18px; height: 40px;"  placeholder="- Select Customer Status -">
                                <?php
//                                foreach ($objTstatus as $key => $value) {
//                                    echo "<option selected value='$value->id' >" . $value->name . "</option>";
//                                }
                                ?>
                            </select>
                            <p id="err-orgstatus" class="text-danger"></p>
                        </div>
                    </div>
                </div>-->
                <div class="row">
                    <div class="col-xs-12 ">
                        <div class="form-group" >
                            <span  class="errmsg" id="err-file"></span> <span  class="errmsg" id="err-file1"></span> 
                            <input type="file" class="form-control border-input input-xs"  id="file" name="file"  placeholder="  Offer"
                                   required/>
                        </div>
                    </div>
                </div>

                <div class="text-center">
                    <button type="button" onclick="Savetrendding();" class="btn btn-info btn-fill btn-wd btn-xs">Add Trending</button>
                </div>
                <div class="clearfix"></div><br>
            </form>
        </div>
        <div class="col-xs-8">
            <div class="row " id="Trendinglist">
                <div class="text-danger" id="notAvailable" style="    text-align: center;">

                </div>

            </div>
        </div>
    </div>

</div>
<script src="js/trendding/trendding.js"></script>
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