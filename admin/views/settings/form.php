<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><?= $title ?></h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                Save
            </h6>
        </div>
        <div class="card-body">
            <form action="<?= BASE_URL_ADMIN . '?act=setting-save' ?>" method="post">
                <table class="table table-bordered">
                    <tr>
                        <th>Field</th>
                        <th>Value</th>
                    </tr>
                    <?php foreach ($settings as $key => $value) : ?>
                        <tr>
                            <td><?= $key ?></td>
                            <td>
                                <input name="<?= $key ?>" type="text" class="form-control" value="<?= $value ?? null ?>">
                            </td>
                        </tr>
                    <?php endforeach ?>
                </table>

                <button type="submit" class="btn btn-primary">
                    Submit
                </button>
            </form>
        </div>
    </div>
</div>