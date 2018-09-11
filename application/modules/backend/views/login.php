<div class="wrapper-login">
    <?=form_open()?>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="email">Email</label>
                <input value="<?=set_value('email')?>" name="email" type="text" class="form-control form-control-sm" id="email" placeholder="Email">
                <span class="text-danger small"><?=form_error('email')?></span>
            </div>
            <div class="form-group col-md-6">
                <label for="pass">Password</label>
                <input name="pass" type="password" class="form-control form-control-sm" id="pass" placeholder="Password">
                <span class="text-danger small"><?=form_error('pass')?></span>
            </div>
        </div>
        <div class="form-group ">
            <label for="inputAddress">Address</label>
            <input type="text" class="form-control form-control-sm" id="inputAddress" placeholder="1234 Main St">
        </div>

        <div class="form-group">
            <div class="custom-control custom-checkbox mr-sm-2">
                <input class="custom-control-input" type="checkbox" id="customControlAutosizing">
                <label class="custom-control-label" for="customControlAutosizing">
                    Check me out
                </label>
            </div>
        </div>
        <button name="login_button" type="submit" class="btn btn-primary">Sign in</button>
    </form>
</div>