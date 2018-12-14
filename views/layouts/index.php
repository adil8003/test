<?php
$this->title = Yii::t('app', 'Dashboard');
echo  $objUser->username ;
?>
<div class="container">
	<form method="POST" action="index.php?r=site/verification">
	<div class="signin row">
		<h3 class="card-title text-center">Business Management Solutions</h3>
		<div class="col-sm-12">
			<div class="card card-block">
				<p class="card-text text-center"><i class="fa fa-user fa-fw fa-5x"></i></p>
				<div class="input-group">
					<span class="input-group-addon"><i class="fa fa-lock"></i></span>
					<input type="text" class="form-control" placeholder="Username">
				</div>
				<p class="card-text"></p>
				<div class="input-group">
					<span class="input-group-addon"><i class="fa fa-unlock-alt"></i></span>
					<input type="text" class="form-control" placeholder="Password">
				</div>
				<p class="card-text"></p>
				<button type="submit" class="btn btn-primary btn-sm btn-block">Sign in</button>
			</div>
		</div>
	</div>
	</form>
</div> <!-- /container
