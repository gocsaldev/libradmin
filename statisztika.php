<?php
include('authentication.php');
include("includes/header.php");
?>
<div class="container">
<br>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Statisztika</h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
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
                                <td>
                                    <?php
                                        $ref_table = 'books';
                                        $books = $database->getReference($ref_table)->getSnapshot()->getValue();
                                        $total_loans = 0;
                                        foreach ($books as $book) {
                                            if (isset($book['rent_name']) && !empty($book['rent_name'])) {
                                                $total_loans++;
                                            }
                                        }
                                        echo $total_loans;
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Legkedveltebb stílus</th>
                                <td>
                                    <?php
                                        $styles = [];
                                        foreach ($books as $book) {
                                            if (isset($book['category'])) {
                                                if (!isset($styles[$book['category']])) {
                                                    $styles[$book['category']] = 0;
                                                }
                                                $styles[$book['category']]++;
                                            }
                                        }
                                        arsort($styles);
                                        $most_popular_style = key($styles);
                                        echo $most_popular_style;
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Összes selejtezett könyv</th>
                                <td>
                                    <?php
                                        $discarded_count = 0;
                                        foreach ($books as $book) {
                                            if (isset($book['condition']) && $book['condition'] == 'Selejt') {
                                                $discarded_count++;
                                            }
                                        }
                                        echo $discarded_count;
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Összes kölcsönző</th>
                                <td>
                                    <?php
                                        $ref_table = 'loaners';
                                        $total_loaners = $database->getReference($ref_table)->getSnapshot()->numChildren();
                                        echo $total_loaners;
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Összes bent lévő könyv</th>
                                <td>
                                    <?php
                                        $books_in = 0;
                                        foreach ($books as $book) {
                                            if (!isset($book['rent_name']) || empty($book['rent_name'])) {
                                                $books_in++;
                                            }
                                        }
                                        echo $books_in;
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Összes kint lévő könyv</th>
                                <td>
                                    <?php
                                        $books_out = 0;
                                        foreach ($books as $book) {
                                            if (isset($book['rent_name']) && !empty($book['rent_name'])) {
                                                $books_out++;
                                            }
                                        }
                                        echo $books_out;
                                    ?>
                                </td>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include("includes/footer.php");
?>