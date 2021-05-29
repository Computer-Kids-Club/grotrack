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
<div class="notification is-primary has-text-centered">

    
    <h1 class='is-size-1'>

        Your UUID is :
        <div class="box">
        <?php
            echo '6sfg51d2dfg54';
        ?>  
        </div>
    
    </h1>

    <br>
    <br>
    <br>

    <div class="has-text-centered">
        <button id="login_button" class="button is-link" onclick="onClickGoToLogin()">Go to Login</button>
    </div>
</div>
</div>

<script type="text/javascript">

function onClickGoToLogin() {
    window.location.href = '/';
}
</script>

</body>
</html>

