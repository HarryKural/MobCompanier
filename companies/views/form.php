<div class="container">
  <div class="row">
      <form action="controller.php" method="post" class="col s12">
        <div class="field">
        <fieldset>
          <legend>Company Information</legend>
          <div class="jumbotron">
          <div class="row">
            <div class="form-group">
              <label for="name">Name</label>
              <input id="name" class="form-control" type="text" name="name" value="<?= isset( $company ) ? $company->name : '' ?>" required maxlength="100">
            </div>
          </div>

          <div class="row">
              <div class="form-group" data-provide="datepicker">
                  <label for="founded">Founded On</label>
                  <input name="founded" class="form-control" type="text" placeholder="mm/dd/yyyy"  id="example1" value="<?= isset( $company ) ? $company->founded : '' ?>" required>
            </div>

              <label for="website" data-error="Please enter a URL" data-success="Perfect!">Website</label>
              <div class="input-group form-group">
                <span class="input-group-addon" id="basic-addon3">https://example.com/users/</span>
                <input id="website" name="website" type="url" class="form-control" aria-describedby="basic-addon3" value="<?= isset( $company ) ? $company->website : '' ?>" required>
             </div>
          </div>
          </div>

            <div class="form-group">
              <input type="hidden" name="action" value="<?= isset( $action ) ? $action : 'add' ?>">

              <?php if ( isset( $action ) && $action == 'update' ): ?>
                <input type="hidden" name="id" value="<?= $company->id ?>">
                <button type="submit" class="btn btn-primary"><i class="fa fa-pencil">&nbsp;</i>Update Company</button>
              <?php else: ?>
                <button type="submit" class="btn btn-success"><i class="fa fa-plus">&nbsp;</i>Add Company</button>
              <?php endif ?>
              <button class="btn btn-danger" type="reset"><span class="glyphicon glyphicon-refresh"></span> Reset</button>
          </div>
        </fieldset>
      </form>
    </div>
  </div>
