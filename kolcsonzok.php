<?php
    $_POST["navbar"] = 1;
    include('authentication.php');
    include("includes/header.php");
    include("includes/footer.php");
    
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
        <?php
            if(isset($_SESSION['status'])){
                echo "<br>";
                echo "<h5 class='alert alert-success'>".$_SESSION['status']."</h5>";
                unset($_SESSION["status"]);
            }
        ?>
        
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
        <div class="card">
            <div class="card-header">
                <h4>
                    Rendszerbe vett kölcsönzők<br>
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#loanerAddModal">
                        Kölcsönző felvétele
                    </button>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#searchModal">
                        Keresés
                    </button>
                </h4>
            </div>
            <div class="card-body" style="overflow: scroll;">
                <table class="table table-bordered table striped">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Név</th>
                            <th>Cím</th>
                            <th>Email</th>
                            <th>Telefon</th>
                            <th>Reg. idő</th>
                            <th>Műveletek</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            include("dbcon.php");

                            $ref_table = "loaners";
                            $fetchdata = $database->getReference($ref_table)->getValue();

                            if (!empty($fetchdata) && is_array($fetchdata)) {
                                $i = 1;
                                foreach ($fetchdata as $key => $row) {
                                    if (!is_array($row)) continue;
                                    ?>
                                    <tr>
                                        <td><?= $i++; ?></td>
                                        <td><?= htmlspecialchars($row['name'] ?? ''); ?></td>
                                        <td><?= htmlspecialchars($row['add'] ?? ''); ?></td>
                                        <td><?= htmlspecialchars($row['email'] ?? ''); ?></td>
                                        <td><?= htmlspecialchars($row['phone'] ?? ''); ?></td>
                                        <td><?= htmlspecialchars($row['date'] ?? ''); ?></td>
                                        <td>
                                            <!-- Edit -->
                                            <a href="edit_loaner.php?id=<?= $key; ?>" class="btn btn-primary btn-sm">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                                                </svg>
                                            </a>
                                            <!-- Delete Trigger -->
                                            <button type="button" class="btn btn-danger btn-sm" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#staticBackdrop"
                                                    data-key="<?= $key ?>">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                                    <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0"/>
                                                </svg>
                                            </button>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            } else {
                                ?>
                                <tr>
                                    <td colspan="7">No Record Found</td>
                                </tr>
                                <?php
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>    

<!-- Add Modal -->
<div class="modal fade" id="loanerAddModal" tabindex="-1" aria-labelledby="loanerModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loanerModalLabel">Kölcsönző felvétele</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="code.php" method="POST">
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="">Név</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Cím</label>
                        <input type="text" name="add" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Email cím</label>
                        <input type="text" name="email" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Telefonszám</label>
                        <input type="text" name="phone" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Mégsem</button>
                    <button type="submit" name="new-loaner" class="btn btn-primary">Kölcsönző felvétele</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Törlés visszaigazolás</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="code.php" method="POST">
                <div class="modal-body">
                    Biztosan törölni szeretné?<br>
                    A törlés <strong>nem</strong> visszavonható!
                    <input type="hidden" name="delete_key" id="deleteKey">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Mégsem</button>
                    <button type="submit" name="delete-loaner" class="btn btn-danger" value="<?= $key; ?>">Törlés</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Search modal -->
<div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Kölcsönző keresése</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="code.php" method="POST">
        <div class="modal-body">
          <div class="form-group mb-3">
            <label for="">Név</label>
            <input type="text" name="search_name" class="form-control">
          </div>
          <div class="form-group mb-3">
            <label for="">Cím</label>
            <input type="text" name="search_add" class="form-control">
          </div>
          <div class="form-group mb-3">
            <label for="">Email cím</label>
            <input type="text" name="search_email" class="form-control">
          </div>
          <div class="form-group mb-3">
            <label for="">Telefonszám</label>
            <input type="text" name="search_phone" class="form-control">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Mégsem</button>
          <button type="submit" name="search-loaner" class="btn btn-primary">Kölcsönző keresése</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  var deleteModal = document.getElementById('staticBackdrop');
  deleteModal.addEventListener('show.bs.modal', function (event) {
      var button = event.relatedTarget;
      var bookKey = button.getAttribute('data-key');

        // Set the value of the hidden input field in the modal
      var deleteBtn = deleteModal.querySelector('button[name="delete-loaner"]');
      deleteBtn.value = bookKey;
  });
</script>

<button id="scrollToTop" onclick="scrollToTop()">⬆</button>

<script>
    // Show or hide the "Scroll to Top" button based on scroll position of the card-body
    const cardBody = document.querySelector('.card-body');
    const scrollToTopButton = document.getElementById('scrollToTop');

    cardBody.addEventListener('scroll', function () {
        if (cardBody.scrollTop > 200) {
            scrollToTopButton.style.display = 'block';
        } else {
            scrollToTopButton.style.display = 'none';
        }
    });

    // Scroll to the top of the card-body
    function scrollToTop() {
        cardBody.scrollTo({ top: 0, behavior: 'smooth' });
    }
</script>