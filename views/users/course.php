<?php
$this->title = Yii::t('app', 'courses');
?>
<input type="hidden" id="userid"  value="<?php echo yii::$app->session['userid'] ?>"/>
<input type="hidden" id="listpage" value="1" />
<div class="row" >
    <div class="card" id="" >
        <div class="header">
            <h5 class="title">Course  List  <span>
<!--                    <div class="border-input input-md btn btn-info btn-fill btn-xs btn-wd pull-right">
                        <select onchange="CardBox();" id="box" class=" border-input input-md btn btn-info btn-fill btn-xs btn-wd" style="margin: -4px;">
                            <option value="Active">Change layout</option>
                            <option  value="1">Card box</option>
                            <option value="2">Horizontal card</option>
                        </select>
                    </div>-->
                </span> </h5>
        </div>
        <hr>
        <div class="row coursemargin" id="list-course">
            <!--<p id="notAvailable"></p>-->
            <div class="alert alert-danger" id="notAvailable" >
                <button type="button" aria-hidden="true" class="close">×</button>
                <span><b> </b> </span>
            </div>
        </div>
    </div>
</div>
<script src="js/users/course.js"></script>
