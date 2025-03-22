<?php
include('authentication.php');
include("includes/header.php");
?>
<div class="container">
<br>
    <div class="row">
        <div class="col-md-12">
            <div class="card" style="height: 850px;">
                <div class="card-header">
                    <h4>Statisztika</h4>
                </div>
                <div class="card-body" style= "overflow: scroll;">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <!--Kölcsönzők statisztikái-->
                            <tr>
                                <th colspan="2" style = "text-align: center;">Kölcsönzők adatai</th>
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
                                <th>Összes kölcsönző</th>
                                <td>
                                    <?php
                                        $ref_table = 'loaners';
                                        $total_loaners = $database->getReference($ref_table)->getSnapshot()->numChildren();
                                        echo $total_loaners;
                                    ?>
                                </td>
                            </tr>

                            <!--Könyvek statisztikái-->
                            <tr>
                                <th colspan="2" style = "text-align: center;">Könyvek adatai</th>
                            </tr>
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
                                <th>Bent lévő könyvek száma</th>
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
                                <th>Kint lévő könyvek száma</th>
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
                                <th colspan="2" style="text-align: center;">Könyvek állapot szerint</th>
                            </tr>
                            <tr>
                                <th>Új könyvek száma</th>
                                <td>
                                    <?php
                                        $new_count = 0;
                                        foreach ($books as $book) {
                                            if (isset($book['condition']) && $book['condition'] == 'Új') {
                                                $new_count++;
                                            }
                                        }
                                        echo $new_count;
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Újszerű könyvek száma</th>
                                <td>
                                    <?php
                                        $novel_count = 0;
                                        foreach ($books as $book) {
                                            if (isset($book['condition']) && $book['condition'] == 'Újszerű') {
                                                $novel_count++;
                                            }
                                        }
                                        echo $novel_count;
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Megőrzött könyvek száma</th>
                                <td>
                                    <?php
                                        $retained_count = 0;
                                        foreach ($books as $book) {
                                            if (isset($book['condition']) && $book['condition'] == 'Megőrzött') {
                                                $retained_count++;
                                            }
                                        }
                                        echo $retained_count;
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Használt könyvek száma</th>
                                <td>
                                    <?php
                                        $used_count = 0;
                                        foreach ($books as $book) {
                                            if (isset($book['condition']) && $book['condition'] == 'Használt') {
                                                $used_count++;
                                            }
                                        }
                                        echo $used_count;
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Sérült könyvek száma</th>
                                <td>
                                    <?php
                                        $damaged_count = 0;
                                        foreach ($books as $book) {
                                            if (isset($book['condition']) && $book['condition'] == 'Sérült') {
                                                $damaged_count++;
                                            }
                                        }
                                        echo $damaged_count;
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Selejtezett könyvek száma</th>
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
                            <!--Könyvek kategória statisztika-->
                            <tr>
                                <th colspan="2" style="text-align: center;">Könyvek kategória szerint</th>
                            </tr>
                            <tr>
                                <th>Regények száma</th>
                                <td>
                                    <?php
                                        $novels_count = 0;
                                        foreach ($books as $book) {
                                            if (isset($book['category']) && $book['category'] == 'Regény') {
                                                $novels_count++;
                                            }
                                        }
                                        echo $novels_count;
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Ismeretterjesztő könyvek száma</th>
                                <td>
                                    <?php
                                        $nonfiction_count = 0;
                                        foreach ($books as $book) {
                                            if (isset($book['category']) && $book['category'] == 'Ismeretterjesztő') {
                                                $nonfiction_count++;
                                            }
                                        }
                                        echo $nonfiction_count;
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Drámák száma</th>
                                <td>
                                    <?php
                                        $drama_count = 0;
                                        foreach ($books as $book) {
                                            if (isset($book['category']) && $book['category'] == 'Dráma') {
                                                $drama_count++;
                                            }
                                        }
                                        echo $drama_count;
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Tartós könyvek száma</th>
                                <td>
                                    <?php
                                        $llbooks_count = 0;
                                        foreach ($books as $book) {
                                            if (isset($book['category']) && $book['category'] == 'Tartós könyv') {
                                                $llbooks_count++;
                                            }
                                        }
                                        echo $llbooks_count;
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Munkafüzetek száma</th>
                                <td>
                                    <?php
                                        $wb_count = 0;
                                        foreach ($books as $book) {
                                            if (isset($book['category']) && $book['category'] == 'Munkafüzet') {
                                                $wb_count++;
                                            }
                                        }
                                        echo $wb_count;
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Versek száma</th>
                                <td>
                                    <?php
                                        $novel_count = 0;
                                        foreach ($books as $book) {
                                            if (isset($book['category']) && $book['category'] == 'Vers') {
                                                $novel_count++;
                                            }
                                        }
                                        echo $novel_count;
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Mesék száma</th>
                                <td>
                                    <?php
                                        $story_count = 0;
                                        foreach ($books as $book) {
                                            if (isset($book['category']) && $book['category'] == 'Mese') {
                                                $story_count++;
                                            }
                                        }
                                        echo $story_count;
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Hanganyagok száma</th>
                                <td>
                                    <?php
                                        $audio_count = 0;
                                        foreach ($books as $book) {
                                            if (isset($book['category']) && $book['category'] == 'Hanganyag') {
                                                $audio_count++;
                                            }
                                        }
                                        echo $audio_count;
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