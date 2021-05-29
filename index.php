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
    <p id="login_invalid" class="help is-danger" style="display: none">This UUID is invalid.</p>
    </div>

    <div class="field is-grouped">
    <div class="control">
        <button id="login_button" class="button is-link" onclick="onClickLogin()" disabled>Login</button>
    </div>
    </div>
  </div>
</div>

<div class="container is-max-widescreen">
  <div class="notification is-primary">

    <div class="field">
    <label class="label">Name</label>
    <div class="control">
        <input id="signup_textbox" class="input" type="text" placeholder="your name here" value="">
    </div>
    <p id="signup_invalid" class="help is-danger" style="display: none">This name is invalid.</p>
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

//echo 'Hi';

?>  

<script type="text/javascript">

const login_url = "/login.php";
const signup_url = "/signup.php";

function onClickLogin() {
    console.log("Login Clicked!");

    let login_invalid = document.getElementById("login_invalid")
    let login_button = document.getElementById("login_button")
    let login_textbox = document.getElementById("login_textbox")
    let login_text = login_textbox.value

    login_button.classList.add("is-loading");

    var xhr = new XMLHttpRequest();
    xhr.open("POST", login_url, true);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.send(JSON.stringify({
        uuid: login_text
    }));
    xhr.onload = function () {
        console.log("Got Login Response!");

        var response_obj = JSON.parse(xhr.responseText);

        console.log("Response: " + response_obj.success);

        if(response_obj.success) {
            window.location.href = '/add_gro_page.php';
        } else {
            login_button.classList.remove("is-loading");
            login_textbox.classList.add("is-danger");
            login_invalid.style.display = 'block';
            
        }
    };
}

function onClickSignup() {
    console.log("Signup Clicked!");
    
    let signup_invalid = document.getElementById("signup_invalid")
    let signup_button = document.getElementById("signup_button")
    let signup_textbox = document.getElementById("signup_textbox")
    let signup_text = signup_textbox.value

    signup_button.classList.add("is-loading");

    var xhr = new XMLHttpRequest();
    xhr.open("POST", signup_url, true);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.send(JSON.stringify({
        name: signup_text
    }));
    xhr.onload = function () {
        console.log("Got Signup Response!");
        console.log("Response: " + xhr.responseText);

        var response_obj = JSON.parse(xhr.responseText);

        console.log("Response: " + response_obj.success);

        if(response_obj.success) {
            window.location.href = '/signup_success.php';
        } else {
            signup_button.classList.remove("is-loading");
            signup_textbox.classList.add("is-danger");
            signup_invalid.style.display = 'block';
            
        }
    };
}

function checkLoginValid() {
    let login_text = document.getElementById("login_textbox").value

    let login_button = document.getElementById("login_button")
    
    if(login_text) {
        console.log("Login Check: OK!");
        login_button.disabled = false;
    } else {
        console.log("Login Check: FAILED!");
        login_button.disabled = true;
    }
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

    const login_textbox = document.getElementById('login_textbox');
    login_textbox.addEventListener('input', checkLoginValid);

    const signup_textbox = document.getElementById('signup_textbox');
    signup_textbox.addEventListener('input', checkSignupValid);

    const checkbox_terms = document.getElementById('checkbox_terms');
    checkbox_terms.addEventListener('input', checkSignupValid);
}
</script>

</body>
</html>


<php?

