<?php
include('authentication.php');
include("includes/header.php");
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Statisztika</h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table striped">
                        <thread>
                            <tr>
                                <th>Összes könyv</th>
                                <td>
                                    <?php
                                        include("dbcon.php");
                                        $ref_table = 'books';
                                        $total_count = $database->getReference($ref_table)->getSnapshot()->numChildren();
                                        echo $total_count;
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Összes kölcsönzés</th>
                                <td>szám</td>
                            </tr>
                            <tr>
                                <th>Legkedvelebb stílus</th>
                                <td>szám</td>
                            </tr>
                            <tr>
                                <th>Összes selejtezett könyv</th>
                                <td>szám</td>
                            </tr>
                            <tr>
                                <th>Összes kölcsönző</th>
                                <td>
                                <?php
                                        include("dbcon.php");
                                        $ref_table = 'loaners';
                                        $total_count = $database->getReference($ref_table)->getSnapshot()->numChildren();
                                        echo $total_count;
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Összes aktív kölcsönző</th>
                                <td>szám</td>
                            </tr>
                        </thread>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include("includes/footer.php");
?>