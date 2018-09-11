<div class="row bg-image">
    <div class="col-md-5 offset-md-3">
        <!--<form class="form-signin" id="loginForm" action="#">-->
        <div class="<?= (validation_errors() !== '') ? 'alert ' : '' ?>alert-danger"
             id="allError" role="alert">
            <?= validation_errors() ?>
        </div>
        <?= form_open() ?>
        <div class="form-label-group">
            <input value="<?= $this->input->cookie('email_cook', true) ? $this->input->cookie('email_cook', true) : set_value('email') ?>"
                   name="email" type="text" id="inputEmail" class="form-control"
                   placeholder="Email address" autofocus>
            <label for="inputEmail">Email address</label>
        </div>

        <div class="form-label-group">
            <input name="pass" type="password" id="inputPassword" class="form-control"
                   placeholder="Password">
            <label for="inputPassword">Password</label>
        </div>
        <div class="form-group">
            <label class="text-danger">Captcha Image : </label>
            <span class="text-success" id="swap-captcha">
                <?php if (isset($captcha['captcha']['Data'])) echo $captcha['captcha']['Data']; ?>
            </span>
            <input type="button" value="refresh" id="refresh-captcha">
        </div>
        <div class="form-inline">
            <label for="captcha" class="text-danger">Captcha Input : </label>
            <input id="captcha" type="text" name="captcha" class="form-control">
            <span class="text-danger">
                <?php if (isset($captcha['captcha']['error'])) echo $captcha['captcha']['error']; ?>
            </span>
        </div>
        <!--reCaptcha-->
        <div class="g-recaptcha" data-sitekey="<?php echo $this->config->item('google_key') ?>"></div>
        <div class="checkbox mb-3">
            <label style="color:yellow">
                <input name="remember" type="checkbox"> Remember
                me <?= $this->session->userdata('user_name') ?>
            </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
        <p class="mt-5 mb-3 text-muted text-center">&copy; 2017-2018</p>
        </form>
    </div>
</div>
