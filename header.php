<!DOCTYPE html>
<html>

<?php include 'session.php';?>

<style type="text/css">
    * {
        cursor: url(carrot.png), auto !important;
    }
</style>

<nav class="navbar" role="navigation" aria-label="main navigation">
  <div class="navbar-brand">
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