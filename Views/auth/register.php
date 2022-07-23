<?php
use \app\core\form\TextareaField;
$this->title = 'Đăng ký'
?>

<?php $form = \app\core\form\Form::create('post', '/register') ?>
<div class="row">
    <div class="col-md-6">
        <?php echo $form->field($model, 'firstname') ?>
    </div>
    <div class="col-md-6">
        <?php echo $form->field($model, 'lastname') ?>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <?php echo $form->field($model, 'email') ?>
    </div>
    <div class="col-md-6">
        <?php echo $form->field($model, 'password')->passwordField() ?>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <?php echo $form->field($model, 'passwordConfirmation')->passwordField() ?>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <?php echo new TextareaField($model, 'avatar') ?>
    </div>
</div>
<button type="submit" class="btn btn-primary">Register</button>
<?php \app\core\form\Form::end() ?>
<!--<h1 class="text-center">Resgister Users</h1>-->
<!--<div class="container">-->
<!--    <form action="/register" method="post">-->
<!--        <div class="row">-->
<!--            <div class="col-md-6">-->
<!--                <div class="form-group">-->
<!--                    <label for="firstName">First Name</label>-->
<!--                    <input type="text" name="firstName" id="firstName" value="--><?php //echo $model->firstName ?? '' 
                                                                                        ?>
<!--"-->
<!--                           placeholder="First Name" class="form-control --><?php //echo $model->hasError('firstName') ?' is-invalid' :''; 
                                                                                ?>
<!--" >-->
<!--                    <div class="invalid-feedback">-->
<!--                        --><?php //echo $model->getFirstError('firstName')
                                ?>
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="col-md-6">-->
<!--                <div class="form-group">-->
<!--                    <label for="lastName">Last Name</label>-->
<!--                    <input type="text" name="lastName" id="lastName" placeholder="Last Name" class="form-control">-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--        <div class="row">-->
<!--            <div class="col-md-6">-->
<!--                <div class="form-group">-->
<!--                    <label for="email">Email</label>-->
<!--                    <input type="text" name="email" id="email" placeholder="Email" class="form-control">-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="col-md-6">-->
<!--                <div class="form-group">-->
<!--                    <label for="password">Password</label>-->
<!--                    <input type="text" name="password" id="password" placeholder="Password" class="form-control">-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--        <div class="row">-->
<!--            <div class="col-md-6">-->
<!--                <div class="form-group">-->
<!--                    <label for="passwordConfirmation">Password Confirmation</label>-->
<!--                    <input type="text" name="passwordConfirmation" id="passwordConfirmation" placeholder="Password Confirmation" class="form-control">-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="col-md-6"></div>-->
<!--        </div>-->
<!---->
<!--        <div class="form-group">-->
<!--            <button type="submit" class="btn btn-primary" style="float:right">Register</button>-->
<!--        </div>-->
<!--    </form>-->
<!--</div>-->