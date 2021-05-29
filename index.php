<!DOCTYPE html>
<html>
<body>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.2/css/bulma.min.css">
<div class="container is-max-widescreen">
  <div class="notification is-primary has-text-centered">
        <h1 class='is-size-1'>Grotrack</h1>
  </div>
</div>

<div class="container is-max-widescreen">
  <div class="notification is-primary">

    <div class="field">
    <label class="label">UUID</label>
    <div class="control">
        <input id="login_textbox" class="input" type="text" placeholder="your uuid here">
    </div>
    </div>

    <div class="field is-grouped">
    <div class="control">
        <button id="login_button" class="button is-link" onclick="onClickLogin()">Login</button>
    </div>
    </div>
  </div>
</div>

<div class="container is-max-widescreen">
  <div class="notification is-primary">

    <div class="field">
    <label class="label">Name</label>
    <div class="control">
        <input id="signup_textbox" class="input is-warning" type="text" placeholder="your name here" value="">
    </div>
    <p class="help is-warning">This name might be valid.</p>
    </div>

    <div class="field">
    <div class="control">
        <label class="checkbox">
        <input id="checkbox_terms" type="checkbox">
        I agree to the <a href="#">terms and conditions</a>
        </label>
    </div>
    </div>

    <div class="field is-grouped">
    <div class="control">
        <button id="signup_button" class="button is-warning " onclick="onClickSignup()" disabled>Sign Up</button>
    </div>
    </div>
  </div>
</div>
<?php

echo 'Hi';

?>  

<script type="text/javascript">

function onClickLogin() {
    console.log("Login Clicked!");
}

function onClickSignup() {
    console.log("Signup Clicked!");
    let terms_checked = document.getElementById("checkbox_terms").checked
    console.log("Signup terms: " + terms_checked);
}

function checkSignupValid() {
    let terms_checked = document.getElementById("checkbox_terms").checked
    let signup_text = document.getElementById("signup_textbox").value

    let valid = terms_checked && signup_text;

    let signup_button = document.getElementById("signup_button")
    
    if(valid) {
        console.log("Signup Check: OK!");
        signup_button.disabled = false;
    } else {
        console.log("Signup Check: FAILED!");
        signup_button.disabled = true;
    }
}

window.onload = () => {
    console.log("Hello world!");

    const signup_textbox = document.getElementById('signup_textbox');
    signup_textbox.addEventListener('input', checkSignupValid);

    const checkbox_terms = document.getElementById('checkbox_terms');
    checkbox_terms.addEventListener('input', checkSignupValid);
}
</script>

</body>
</html>


<php?

