<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stack Trace</title>
</head>
<style>
    <?php $this->assets('css/style.css'); ?>
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
                            <th>Args</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1 ?>
                        <?php foreach ($data as $key => $value) : ?>
                            <?php if (isset($value['class']) && $value['class'] === "Riyu\Router\Matching") continue; ?>
                            <tr>
                                <td><?= $no ?></td>
                                <?php if (isset($value['file'])) {
                                    echo '<td>' . $value["file"] . '</td>';
                                } else {
                                    echo "<td>tidak ada</td>";
                                }; ?>
                                <?php if (isset($value['line'])) {
                                    echo "<td>" . $value['line'] . "</td>";
                                } else {
                                    echo "<td></td>";
                                } ?>
                                <?php if (isset($value['function'])) {
                                    echo "<td>" . $value['function'] . "</td>";
                                } else {
                                    echo "<td></td>";
                                } ?>
                                <?php if (isset($value['class'])) {
                                    echo "<td>" . $value['class'] . "</td>";
                                } else {
                                    echo "<td></td>";
                                } ?>
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
                                <?php if (is_array($args)) {
                                    $args = array_map(function ($value) {
                                        if (is_array($value)) {
                                            return implode(", ", $value);
                                        }
                                        return $value;
                                    }, $args);
                                } ?>
                                <td><?= implode(", ", $args) ?></td>
                            </tr>
                            <?php $no++ ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>