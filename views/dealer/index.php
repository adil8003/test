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
        
        <div class="col-xs-12">
            <div class="content table-responsive table-full-width">
                <table class="table table-striped" id="tbldealrs">
                    <thead>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>email</th>
                    <th>Organisation name</th>
                    <th>Date</th>
                    <!--<th>Action</th>-->
                    </thead>
                    <tbody>
                      
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<script src="js/dealer/index.js"></script>
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
</style>