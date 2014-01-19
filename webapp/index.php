 <?php
 require_once 'htmlfunc.php';
 insertHeader("Welcome to EverTexts","1");

 ?>
  <div class="container">
      <div class="header">
        <ul class="nav nav-pills pull-right">
          <li class="active"><a href="#">Home</a></li>
          <li><a href="enter.php">Enter</a></li>
          <li><a href="about.php">About</a></li>
          <li><a href="contact.php">Contact</a></li>
        </ul>
        <h3 class="text-muted">EverTexts
        <img src="images/et_icon.png" />
      </h3>
      </div>

      <div class="jumbotron">
        <h1>Hey You</h1>
        <p class="lead"> This is it. This is the start of a beautiful journey. No more need for group
        texting apps, thumb-cramping copy-paste frenzies, or buried life-changing messages.
        Initiate group chats. Export to EverNote &copy;. Take the world by storm. It's that easy!</p>

        <p><a class="btn btn-lg btn-success" href="enter.php" role="button">Sign up today</a></p>
      </div>

      <div class="row marketing">
        <div class="col-lg-6">
          <h4>Subheading</h4>
          <p>Donec id elit non mi porta gravida at eget metus. Maecenas faucibus mollis interdum.</p>

          <h4>Subheading</h4>
          <p>Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Cras mattis consectetur purus sit amet fermentum.</p>

          <h4>Subheading</h4>
          <p>Maecenas sed diam eget risus varius blandit sit amet non magna.</p>
        </div>

        <div class="col-lg-6">
          <h4>Subheading</h4>
          <p>Donec id elit non mi porta gravida at eget metus. Maecenas faucibus mollis interdum.</p>

          <h4>Subheading</h4>
          <p>Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Cras mattis consectetur purus sit amet fermentum.</p>

          <h4>Subheading</h4>
          <p>Maecenas sed diam eget risus varius blandit sit amet non magna.</p>
        </div>
      </div>

<?php
  insertFooter();
  insertEndTags();
?>