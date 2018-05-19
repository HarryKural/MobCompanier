<div class="container">
  <h1 class="page-header">Companies</h1>
  <?php if ( is_authenticated() ): ?>
    <p><a href="?action=create"><i class="fa fa-plus">&nbsp;</i>Create Company</a></p>
  <?php endif ?>

  <?php if ( isset( $companies ) ): ?>
    <table class="table table-striped table-condensed table-hover">
      <thead>
        <tr>
          <th>Name</th>
          <th>Founded On</th>
          <th>Website</th>
          <th>Show</th>
          <?php if ( is_authenticated() ): ?>
            <th>Edit</th>
            <th>Delete</th>
          <?php endif ?>
        </tr>
      </thead>

      <tbody>
        <?php foreach ( $companies as $company ): ?>
          <tr>
            <td><?= $company->name ?></td>
            <td><?= $company->founded ?></td>
            <td><a href="<?= $company->website ?>"><?= $company->website ?></a></td>
            <td><a href="?action=show&id=<?= $company->id ?>"><i class="fa fa-eye"></i></a></td>
            <?php if ( is_authenticated() ): ?>
              <td><a href="?action=edit&id=<?= $company->id ?>"><i class="fa fa-pencil"></i></a></td>
              <td>
                <form action="controller.php" method="post">
                  <input type="hidden" name="action" value="delete">
                  <input type="hidden" name="id" value="<?= $company->id ?>">
                  <button type="submit" style="border: none; background: none; color: #337ab7; padding: 0; margin: 0;" onclick="return confirm('Are you sure you want to permanently delete <?= $company->name ?>')">
                    <i class="fa fa-remove"></i>
                  </button>
                </form>
              </td>
            <?php endif ?>
          </tr>
        <?php endforeach ?>
      </tbody>
    </table>
  <?php endif ?>
</div>
