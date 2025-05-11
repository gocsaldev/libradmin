<?php
$_POST["navbar"] = 1;
include('authentication.php');
include("includes/header.php");
include("includes/footer.php");

?>
<br>
<button id="scrollToTop" onclick="scrollToTop()">⬆</button>
<script>
    window.onscroll = function () {
        const scrollButton = document.getElementById('scrollToTop');
        if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
            scrollButton.style.display = 'block';
        } else {
            scrollButton.style.display = 'none';
        }
    };

    function scrollToTop() {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }
</script>
<script>
    window.onload = function () {
        const elements = document.querySelectorAll('*');
        elements.forEach((element) => {
            element.classList.add('fade-in');
        });

        const loanerDropdown = document.getElementById('loaner');
        const selectedOption = loanerDropdown.options[loanerDropdown.selectedIndex];
        const rentNameField = document.getElementById('rent_name');
        rentNameField.value = selectedOption.text;
    };
</script>

<div class="container">
    <div class="row justify-content-center d-flex">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4>
                        Könyv szerkesztés
                        <a href="allomany.php" class="btn btn-danger float-end">Vissza</a>
                    </h4>
                </div>
                <div class="card-body" style="overflow: scroll;">
                    <?php
                    include("dbcon.php");

                    if (isset($_GET["id"])) {
                        $key_child = $_GET['id'];
                        $ref_table = "books";
                        $getdata = $database->getReference('books')->getChild($key_child)->getValue();

                        if ($getdata > 0) {
                    ?>
                            <form action="code.php" method="POST">
                                <input type="hidden" name="key" value="<?= $key_child; ?>">
                                <div class="form-group mb-3">
                                    <label for="">Cím</label>
                                    <input type="text" name="title" class="form-control" value="<?= $getdata['title']; ?>" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="">Alcím</label>
                                    <input type="text" name="sec_title" class="form-control" value="<?= $getdata['sec_title']; ?>">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="">Szerző</label>
                                    <input type="text" name="writer" class="form-control" value="<?= $getdata['writer']; ?>" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="">Csoportosítás</label>
                                    <select name="category" class="form-control">
                                        <option value="Regény" <?= ($getdata['category'] == 'Regény') ? 'selected' : ''; ?>>Regény</option>
                                        <option value="Dráma" <?= ($getdata['category'] == 'Dráma') ? 'selected' : ''; ?>>Dráma</option>
                                        <option value="Ismeretterjesztő" <?= ($getdata['category'] == 'Ismeretterjesztő') ? 'selected' : ''; ?>>Ismeretterjesztő</option>
                                        <option value="Tartós tankönyv" <?= ($getdata['category'] == 'Tartós tankönyv') ? 'selected' : ''; ?>>Tartós tankönyv</option>
                                        <option value="Munkafüzet" <?= ($getdata['category'] == 'Munkafüzet') ? 'selected' : ''; ?>>Munkafüzet</option>
                                        <option value="Vers" <?= ($getdata['category'] == 'Vers') ? 'selected' : ''; ?>>Vers</option>
                                        <option value="Mese" <?= ($getdata['category'] == 'Mese') ? 'selected' : ''; ?>>Mese</option>
                                        <option value="Hanganyag" <?= ($getdata['category'] == 'Hanganyag') ? 'selected' : ''; ?>>Hanganyag</option>
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="">Leltári szám</label>
                                    <input type="text" name="whouse_id" class="form-control" value="<?= $getdata['whouse_id']; ?>">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="">Megjelenés éve</label>
                                    <input type="number" name="rel_year" class="form-control" value="<?= $getdata['rel_year']; ?>">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="">Lelőhely</label>
                                    <input type="text" name="spot" class="form-control" value="<?= $getdata['spot']; ?>">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="">Állapot</label>
                                    <select name="condition" class="form-control">
                                        <option value="Új" <?= ($getdata['condition'] == 'Új') ? 'selected' : ''; ?>>Új</option>
                                        <option value="Újszerű" <?= ($getdata['condition'] == 'Újszerű') ? 'selected' : ''; ?>>Újszerű</option>
                                        <option value="Megőrzött" <?= ($getdata['condition'] == "Megőrzött") ? 'selected' : '' ?>>Megőrzött</option>
                                        <option value="Használt" <?= ($getdata['condition'] == "Használt") ? 'selected' : '' ?>>Használt</option>
                                        <option value="Sérült" <?= ($getdata['condition'] == "Sérült") ? 'selected' : '' ?>>Sérült</option>
                                        <option value="Selejt" <?= ($getdata['condition'] == "Selejt") ? 'selected' : '' ?>>Selejt</option>
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="">Érték (Ft)</label>
                                    <input type="number" name="worth" class="form-control" value="<?= $getdata['worth']; ?>">
                                </div>
                                <div class="form-group mb-3">
                                    <button type="submit" name="update-book" class="btn btn-primary">Szerkesztés</button>
                                </div>
                            </form>
                    <?php
                        } else {
                            $_SESSION['status'] = "Hibás ID";
                            header("Location: allomany.php");
                            exit();
                        }
                    } else {
                        $_SESSION['status'] = "Nem található";
                        header("Location: allomany.php");
                        exit();
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4>Kölcsönzés</h4>
                </div>
                <div class="card-body" style="overflow: scroll;">
                    <form action="code.php" method="POST">
                        <input type="hidden" name="key" value="<?= $key_child; ?>">
                        <input type="hidden" name="rent_name" id="rent_name" value="">
                        <div class="form-group mb-3">
                            <label for="">Kölcsönző neve</label>
                            <?php                             
                            // Check if book is rented out by checking rent_name instead of loaner_uid
                            $isRented = !empty($getdata['rent_name']);
                            
                            if ($isRented): ?>
                                <!-- Display a read-only textbox if the book is already rented -->
                                <input type="text" class="form-control" value="<?= htmlspecialchars($getdata['rent_name']); ?>" disabled>
                                <input type="hidden" name="rent_name" value="<?= htmlspecialchars($getdata['rent_name']); ?>">
                                <?php
                                // Find the loaner_uid by matching the name
                                foreach ($loaners as $uid => $loaner) {
                                    if ($loaner['name'] === $getdata['rent_name']) {
                                        echo '<input type="hidden" name="loaner_uid" value="' . htmlspecialchars($uid) . '">';
                                        break;
                                    }
                                }
                                ?>
                            <?php else: ?>
                                <!-- Only show dropdown when no current loaner -->
                                <select name="loaner_uid" id="loaner" class="form-control" required>
                                    <option value="">Válasszon kölcsönzőt...</option>
                                    <?php
                                    if (!empty($loaners)) {
                                        foreach ($loaners as $uid => $loaner) {
                                            echo '<option value="' . htmlspecialchars($uid) . '">' . htmlspecialchars($loaner['name']) . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            <?php endif; ?>
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Kezdeti dátum</label>
                            <input type="date" name="rent_date1" class="form-control" value="<?= isset($getdata['rent_date1']) ? $getdata['rent_date1'] : ''; ?>" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Vége dátum</label>
                            <input type="date" name="rent_date2" class="form-control" value="<?= isset($getdata['rent_date2']) ? $getdata['rent_date2'] : ''; ?>" required>
                        </div>
                        <?php if (!empty($getdata['rent_name']) || !empty($getdata['rent_date1']) || !empty($getdata['rent_date2'])) : ?>
                        <button type="submit" name="del-rent" class="btn btn-warning">Visszavonás</button>
                        <?php endif; ?>
                        <button type="submit" name="update-book" class="btn btn-primary">Mentés</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    // Update the hidden rent_name field based on the selected loaner
    document.getElementById('loaner').addEventListener('change', function () {
        const selectedOption = this.options[this.selectedIndex];
        const rentNameField = document.getElementById('rent_name');
        rentNameField.value = selectedOption.text;
    });
</script>