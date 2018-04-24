<script src="js/scripts.js"></script>
  <script>
  function logout() {
    serviceCall({request:"logout"}, function(res) {
      window.location = "login.php";
    });
  }
  </script>