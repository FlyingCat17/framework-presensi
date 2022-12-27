<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stack Trace</title>
</head>

<style>
    table {
        border-collapse: collapse;
        width: 100%;
    }

    th,
    td {
        text-align: left;
        padding: 8px;
    }

    tr:nth-child(even) {
        background-color: #f2f2f2
    }

    .container {
        background-color: #fff;
        padding: 10px;
    }

    .row {
        margin: 0;
    }

    .col-md-12 {
        padding: 0;
    }

    .table {
        margin-bottom: 0;
    }

    .table-bordered {
        border: 1px solid #dee2e6;
    }

    .table-bordered th,
    .table-bordered td {
        border: 1px solid #dee2e6;
    }

    .table-bordered thead th,
    .table-bordered thead {
        border-bottom-width: 2px;
    }
</style>

<body>
    <?php $data = $this->getBacktrace(); ?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Stack Trace</h1>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>File</th>
                            <th>Line</th>
                            <th>Function</th>
                            <th>Class</th>
                            <th>Type</th>
                            <th>Args</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1 ?>
                        <?php foreach ($data as $key => $value) : ?>
                            <?php if ($value['class'] === "Riyu\Router\Matching") continue; ?>
                            <tr>
                                <td><?= $no ?></td>
                                <td><?= $value['file'] ?></td>
                                <td><?= $value['line'] ?></td>
                                <td><?= $value['function'] ?></td>
                                <td><?= $value['class'] ?></td>
                                <td><?= $value['type'] ?></td>
                                <?php if (count($value) > 0) {
                                    $args = array();
                                    foreach ($value['args'] as $key => $value) {
                                        if (is_object($value)) {
                                            $args[] = get_class($value);
                                        } else {
                                            $args[] = $value;
                                        }
                                    }
                                } ?>
                                <td><?= implode(", ", $args) ?></td>
                            </tr>
                            <?php $no ++ ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>