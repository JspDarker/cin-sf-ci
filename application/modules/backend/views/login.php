<div class="wrapper-login">
    <div class="form-group ">
        <span class="text-warning"><span
                    class="text-danger">Message for Account</span> | <?= $this->session->flashdata('message_login'); ?></span>
    </div>
    <?= form_open() ?>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="email">Email</label>
            <input value="<?= $this->input->cookie('email', true) ? $this->input->cookie('email', true) : set_value('email') ?>"
                   name="email" type="text" class="form-control form-control-sm"
                   id="email" placeholder="Email">
            <span class="text-danger small"><?= form_error('email') ?></span>
        </div>
        <div class="form-group col-md-6">
            <label for="pass">Password</label>
            <input value="<?= $this->input->cookie('pass', true) ? $this->input->cookie('pass', true) : '' ?>"
                   name="pass" type="password" class="form-control form-control-sm"
                   id="pass" placeholder="Password">
            <span class="text-danger small"><?= form_error('pass') ?></span>
        </div>
    </div>
    <div class="form-group ">
        <label for="inputAddress">Address</label>
        <input type="text" class="form-control form-control-sm" id="inputAddress"
               placeholder="1234 Main St">
    </div>

    <div class="form-group">
        <div class="custom-control custom-checkbox mr-sm-2">
            <input class="custom-control-input" <?= set_checkbox('checkbox_login', 1) ?>
                   type="checkbox" name="checkbox_login" value="1"
                   id="customControlAutosizing">
            <label class="custom-control-label" for="customControlAutosizing">
                Check me out
            </label>
            <span class="text-warning"><?= form_error('checkbox'); ?></span>
        </div>
    </div>
    <button name="login_button" type="submit" class="btn btn-primary">Sign in</button>
    </form>
</div>