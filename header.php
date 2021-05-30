<!DOCTYPE html>
<html>

<title>GroTrack</title>

<?php include 'session.php';?>

<style type="text/css">
    * {
        cursor: url(carrot.png), auto !important;
    }
    .explosion {
	 position: absolute;
	 width: 600px;
	 height: 600px;
	 pointer-events: none;
    }
    .explosion .particle {
        position: absolute;
        width: 10px;
        height: 10px;
        border-radius: 50%;
        animation: pop 1s reverse forwards;
        animation-timing-function: linear;
    }
    @keyframes pop {
        from {
            opacity: 0;
        }
        to {
            top: 50%;
            left: 50%;
            opacity: 1;
        }
    }
    html, body {
        height: 100%;
    }
 
</style>

<link rel="shortcut icon" type="image/png" href="/carrot.png"/>

<script
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script>
<script type="text/javascript">
// click event listener
$('body').on('click', function(e) {
  explode(e.pageX, e.pageY);
})

// explosion construction
function explode(x, y) {
  var particles = 15,
    // explosion container and its reference to be able to delete it on animation end
    explosion = $('<div class="explosion"></div>');

  // put the explosion container into the body to be able to get it's size
  $('body').append(explosion);

  // position the container to be centered on click
  explosion.css('left', x - explosion.width() / 2);
  explosion.css('top', y - explosion.height() / 2);

  for (var i = 0; i < particles; i++) {
    // positioning x,y of the particle on the circle (little randomized radius)
    var x = (explosion.width() / 2) + rand(80, 150) * Math.cos(2 * Math.PI * i / rand(particles - 10, particles + 10)),
      y = (explosion.height() / 2) + rand(80, 150) * Math.sin(2 * Math.PI * i / rand(particles - 10, particles + 10)),
      angle = rand(0, 360), // randomize the color rgb
      size = rand(50, 150)/100.0, // randomize the color rgb
        // particle element creation (could be anything other than div)
      elm = $('<img src="/carrot.png" class="particle" style="' + 
        'transform: rotate(' + angle + 'deg) ' + 
        'scale(' + size + '); ' + 
        'top: ' + y + 'px; ' +
        'left: ' + x + 'px"></div>');

    if (i == 0) { // no need to add the listener on all generated elements
      // css3 animation end detection
      elm.one('webkitAnimationEnd oanimationend msAnimationEnd animationend', function(e) {
        explosion.remove(); // remove this explosion container when animation ended
      });
    }
    explosion.append(elm);
  }
}

// get random number between min and max value
function rand(min, max) {
  return Math.floor(Math.random() * (max + 1)) + min;
}
</script>

<nav class="navbar" role="navigation" aria-label="main navigation">
  <div class="navbar-brand">
    <img src="/carrot.png" width="64" height="64">
    <a class="navbar-item is-size-3" href="/">
        Grotrack
    </a>

  </div>

  <div id="navbarBasicExample" class="navbar-menu">
    <div class="navbar-start">
      <a class="navbar-item" href="/add_gro_page.php">
        View Gros
      </a>

      <a class="navbar-item" href="/barcode.php">
        Add Gros
      </a>

    </div>

    <div class="navbar-end">
        <?php
        if($_SESSION["uuid"]) {
        ?>
        <div class="navbar-item">
            <div class="buttons">
                <a class="button is-light" href="/logout.php">
                    Log out
                </a>
            </div>
        </div>
        <?php
        } else {
        ?>
        <div class="navbar-item">
            <div class="buttons">
                <a class="button is-primary" href="/">
                    <strong>Sign up</strong>
                </a>
                <a class="button is-light" href="/">
                    Log in
                </a>
            </div>
        </div>
        <?php
        }
        ?>
      
    </div>
  </div>
</nav>

</html>