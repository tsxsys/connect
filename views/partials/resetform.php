<form class="md-float-material form-material text-center" id="resetform" name="resetform" method="post">
    <div class="form-group form-default">
        <input class="form-control" name="password1" id="password1" type="password" required autofocus>
        <span class="form-bar"></span>
        <label class="float-label">New Password</label>
    </div>
    <div class="form-group form-default">
        <input class="form-control" name="password2" id="password2" type="password" required>
        <span class="form-bar"></span>
        <label class="float-label">Repeat Password</label>
    </div>
    <input name="t" id="t" value="<?php echo $jwt;?>" hidden>
    <div class="row">
        <div class="col-md-12">
            <button type="button" name="Submit" id="submit"
                    class="btn-md btn-block m-b-20 sgh--lg-button">Reset Password
            </button>
        </div>
    </div>
</form>

