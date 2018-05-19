<div class="container">
  <h1 class="page-header"><?= $company->name ?></h1>
  <?php if ( is_authenticated() ): ?>
    <p><a href="../mobiles/?action=create"><i class="fa fa-plus">&nbsp;</i>Create Mobile</a></p>
  <?php endif ?>

  <?php if ( $company->mobiles ): ?>
    <table class="table table-striped table-condensed table-hover">
      <thead>
        <tr>
          <th>Thumbnail</th>
          <th>Name</th>
          <th>Price</th>
          <?php if ( is_authenticated() ): ?>
            <th>Edit</th>
            <th>Delete</th>
          <?php endif ?>
        </tr>
      </thead>

      <tbody>
        <?php foreach ( $company->mobiles as $mobile ): ?>
          <tr>
            <td>
              <?php if ( !empty( $mobile->image ) ): ?>
                <img style="max-width: 100px; max-height: 100px;" class="img-thumbnail" src="../uploads/images/<?= $mobile->image ?>" alt="Mobile Image">
              <?php endif ?>
            </td>
            <td><?= $mobile->name ?></td>
            <td><?= $mobile->price_formatted ?></td>
            <?php if ( is_authenticated() ): ?>
              <td><a href="../mobiles/index.php?action=edit&id=<?= $mobile->id ?>"><i class="fa fa-pencil"></i></a></td>
              <td>
                <form action="../mobiles/controller.php">
                  <input type="hidden" name="action" value="delete">
                  <input type="hidden" name="id" value="<?= $mobile->id ?>">
                  <button type="submit" style="border: none; background: none; color: #337ab7; padding: 0; margin: 0;" onclick="return confirm('Are you sure you want to delete <?= $mobile->name ?>')"><i class="fa fa-remove"></i></button>
                </form>
              </td>
            <?php endif ?>
          </tr>
        <?php endforeach ?>
      </tbody>
    </table>
  <?php endif ?>
</div>
