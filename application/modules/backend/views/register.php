<div class="wrapper-login">
    <?=form_open_multipart('',array('id'=>'form-register'))?>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputEmail4">Email</label>
                <input name="email_new" type="text" class="form-control form-control-sm"
                       id="inputEmail4" placeholder="Email">
            </div>
            <div class="form-group col-md-6">
                <label for="name">Full name</label>
                <input name="name" type="text" class="form-control form-control-sm"
                       id="name" placeholder="Password">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="pass">Password</label>
                <input name="pass_new" type="password" class="form-control form-control-sm"
                       id="pass" placeholder="Password">
            </div>
            <div class="form-group col-md-6">
                <label for="inputPassword4">Password confirm</label>
                <input name="pass_new_confirm" type="password" class="form-control form-control-sm"
                       id="inputPassword4" placeholder="Password confirm">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputCity">Captcha Confirm</label>
                <input name="captcha" type="text" class="form-control form-control-sm"
                       id="inputCity" placeholder="Enter captcha">
                <span class="text-danger small"><?=form_error('captcha')?></span>
            </div>
            <div class="form-group col-md-4">
                <label for="inputState">City</label>
                <select name="city" id="inputState" class="form-control form-control-sm">
                    <option selected>Choose...</option>
                    <option>...</option>
                </select>
            </div>
            <div class="form-group col-md-2">
                <label for="inputZip">avatar</label>
                <input type="file" name="avatar" class="form-control form-control-sm"
                       id="inputZip">
                <span class="text-danger small"><?=form_error('avatar')?></span>
            </div>
        </div>
        <div class="form-group">
            <span class="image-wrapper">
                <img src="public/images/5.jpg" alt="images" width="100" height="100">
                <a href="#"><i class="fa fa-remove icon-position"></i></a>
            </span>

        </div>
        <div class="form-group">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="pass-show">
                <label class="form-check-label" for="pass-show">
                    Show password
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="auto-login">
                <label class="form-check-label" for="auto-login">
                    Auto Login
                </label>
            </div>
        </div>
        <button name="btn-register" type="submit" class="btn btn-primary">Register</button>
    </form>
</div>