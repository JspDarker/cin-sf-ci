<div class="row bg-image">
    <div class="col-md-5 offset-md-3">
        <!--<form class="form-signin" id="loginForm" action="#">-->
        <div class="alert-danger" id="allError" role="alert">
            <?=validation_errors()?>
        </div>
        <?=form_open()?>
            <div class="text-center m-1">
                <img class="mb-4" src="https://getbootstrap.com/docs/4.0/assets/brand/bootstrap-solid.svg" alt="" width="40" height="40">
            </div>

            <div class="form-label-group">
                <input value="<?=set_value('email')?>" name="email" type="text" id="inputEmail" class="form-control" placeholder="Email address">
                <label for="inputEmail">Email address</label>
            </div>

            <div class="form-label-group">
                <input name="pass" type="password" id="inputPassword" class="form-control" placeholder="Password" autofocus>
                <label for="inputPassword">Password</label>
            </div>

            <div class="checkbox mb-3">
                <label style="color:yellow">
                    <input type="checkbox" value="remember-me"> Remember me <?=$this->session->userdata('user_name')?>
                </label>
            </div>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
            <p class="mt-5 mb-3 text-muted text-center">&copy; 2017-2018</p>
        </form>
    </div>
</div>
