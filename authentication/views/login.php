<div class="container">
  <h1 class="page-header">Login</h1>

  <form action="controller.php" method="post">
    <fieldset>
      <legend>Login</legend>

      <div class="jumbotron">
      <div class="form-group">
        <label for="email">Email</label>
        <input class="form-control" type="email" name="email" placeholder="Email" required maxlength="100">
      </div>

      <div class="form-group">
        <label for="password">Password</label>
        <input class="form-control" type="password" name="password" placeholder="Password" required maxlength="100" minlength="8">
      </div>
      </div>

      <div class="form-group">
        <input type="hidden" name="action" value="authenticate">
        <button type="submit" class="btn btn-primary"><i class="fa fa-sign-in">&nbsp;</i>Login</button>
      </div>
    </fieldset>
  </form>
</div>
