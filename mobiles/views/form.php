<div class="container">
<div class="row">
  <form action="controller.php" method="post" enctype="multipart/form-data">
  
  <fieldset>
    <legend>Mobile Information</legend>
    <div class="jumbotron">
    <div class="form-group">
      <label for="name">Name</label>
      <input class="form-control" type="text" name="name" maxlength="100" required value="<?= isset( $mobile ) ? $mobile->name : '' ?>">
    </div>

    <label for="price">Price</label>
    <div class="form-group input-group">
      <span class="input-group-addon">$</span>
      <input class="form-control" type="number" name="price" min="0.01" step="any" aria-label="Amount (to the nearest dollar)" required value="<?= isset( $mobile ) ? $mobile->price : '' ?>">
      <span class="input-group-addon">.00</span>
    </div>

    <div class="form-group">
      <label for="company_id">Company</label>
      <select class="form-control" name="company_id" required>
        <option value="">...select a company...</option>
        <?php foreach ( $companies as $company ): ?>
          <option value="<?= $company->id ?>" <?= isset( $mobile ) && $mobile->company->id == $company->id ? 'selected' : '' ?>><?= $company->name ?></option>
        <?php endforeach ?>
      </select>
    </div>

    <div class="form-group">
      <input type="hidden" name="MAX_FILE_SIZE" value="30000">
      <label for="image">Upload Image</label>
      <input type="file" name="image">
    </div>
    </div>

    <div class="form-group">
      <input type="hidden" name="action" value="<?= isset( $action ) ? $action : 'add' ?>">

      <?php if ( isset( $action ) && $action == 'update' ): ?>
        <input type="hidden" name="current_image" value="<?= isset( $mobile->image ) ? $mobile->image : '' ?>">
        <input type="hidden" name="id" value="<?= $mobile->id ?>">
        <button type="submit" class="btn btn-primary"><i class="fa fa-pencil">&nbsp;</i>Update Mobile</button>
      <?php else: ?>
        <button type="submit" class="btn btn-success"><i class="fa fa-plus">&nbsp;</i>Add Mobile</button>
      <?php endif ?>
        <button class="btn btn-danger" type="reset"><span class="glyphicon glyphicon-refresh"></span> Reset</button>
    </div>
  </fieldset>

  </form>
  </div>
</div>
