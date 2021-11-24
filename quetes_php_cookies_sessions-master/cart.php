<?php require 'inc/data/products.php'; ?>
<?php require 'inc/head.php'; ?>

<?php
  // Vérification que l'user est loggué
  if(empty($_SESSION['loginname'])) {
  	header('Location: http://localhost:8000/quetes_php_cookies_sessions-master/login.php');
   exit();
  }
?>

<?php
 // Retire un élément du panier
 if(!empty($_GET)) {
 	if ($_SESSION['cart'][$catalog[$_GET['remove_from_cart']]['name']] > 0) {
     $_SESSION['cart'][$catalog[$_GET['remove_from_cart']]['name']] -= 1; 
 }}
?>

<section class="cookies container-fluid">
    <div class="row">
        <?php
        echo "<br><br> Voici votre panier : <br><br>";
        foreach ($_SESSION['cart'] as $id => $number) {
        		echo "==> ", $id, " : ", $number, "<br>";
        }
        ?>
        <br><br>
    </div>

    <div class="row">
        <?php foreach ($catalog as $id => $cookie) { ?>
            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                <figure class="thumbnail text-center">
                    <img src="assets/img/product-<?= $id; ?>.jpg" alt="<?= $cookie['name']; ?>" class="img-responsive">
                    <figcaption class="caption">
                        <h3><?= $cookie['name']; ?></h3>
                        <p><?= $cookie['description']; ?></p>
                        <a href="?remove_from_cart=<?= $id; ?>" class="btn btn-primary">
                            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Remove from cart
                        </a>
                    </figcaption>
                </figure>
            </div>
        <?php } ?>
    </div>
</section>

<?php require 'inc/foot.php'; ?>
