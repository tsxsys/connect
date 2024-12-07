<?php
/**
* Page that allows admins to check and delete logs of emails sent by site
* (Does not track emails themselves, only send statuses)
**/
$user_role = 'Admin';
$title = 'Mail Log';
require '../login/misc/pagehead.php';
?>

<link rel="stylesheet" type="text/css" href="' . VIEWS_URL . 'login/js/DataTables/datatables.min.css"/>
<script type="text/javascript" src="' . VIEWS_URL . 'login/js/DataTables/datatables.min.js"></script>
</head>
<body>
  <?php require '../login/misc/pullnav.php'; ?>
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <h3>Manage Roles</h3>

        <table id="mailList" class="table table-sm">
          <thead>
            <th></th>
            <th>Type</th>
            <th>Status</th>
            <th>Recipient</th>
            <th>Response Message</th>
            <th>Timestamp</th>
          </thead>
        </table>
      </div>
    </div>
  </div>

  <script type="TEXT/javascript" src="js/maillog.js"></script>

</body>
</html>
