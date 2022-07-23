<?php $this->title = 'Login';?>
<h1 class="text-center mt-3">Login Form</h1>
<?php $form = \app\core\form\Form::create('post', '/login') ?>
<div class="row">
    <div class="col-md-6">
        <?php echo $form->field($model, 'email') ?>
    </div>
    <div class="col-md-6">
        <?php echo $form->field($model, 'password')->passwordField() ?>
    </div>
</div>
<button type="submit" class="btn btn-primary">Login</button>
<?php \app\core\form\Form::end() ?>