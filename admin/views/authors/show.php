<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><?= $title ?></h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                Detail
            </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <tr>
                        <th>Field</th>
                        <th>Value</th>
                    </tr>
                    <?php foreach ($author as $fieldName => $value) : ?>
                        <tr>
                            <td><?= $fieldName ?></td>
                            <td><?= $value ?></td>
                        </tr>
                    <?php endforeach ?>
                </table>

                <a href="<?= BASE_URL_ADMIN ?>?act=authors" class="btn btn-danger">Back</a>
            </div>
        </div>
    </div>
</div>