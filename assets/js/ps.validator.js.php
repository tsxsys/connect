<script>
$("#resetform").validate({
    rules: {
        password1: {
            required: true <?php if ($conf->password_policy_enforce == "true") {
    echo ", minlength: ". $conf->password_min_length;
};?>
        }
        , password2: {
            required: true
            , equalTo: "#password1"
        }
    }
});
</script>