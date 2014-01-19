 <?php
 require_once 'htmlfunc.php';
 insertHeader("Awaken Thyself | EverTexts");

 ?>
      <script type="text/javascript" src="js/modal.js"></script>

      <div class="jumbotron">
        <h1>Hey You</h1>
        <p class="lead"> This is it. This is the start of a beautiful journey. No more need for group
        texting apps, thumb-cramping copy-paste frenzies, or buried life-changing messages.
        Initiate group chats. Export to EverNote &copy;. Take the world by storm. It's that easy!</p>

        <p><a class="btn btn-lg btn-success" data-toggle="modal" href="#myModal" role="button">
          Sign up today
        </a></p>
        <!-- Modal -->
        <div class="modal fade" id="#myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Modal title</h4>
              </div>
              <div class="modal-body">
                ...
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
              </div>
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

      </div>
      

<?php
  insertFooter();
  insertEndTags();
?>