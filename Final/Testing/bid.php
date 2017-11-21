<?php require("includes/config.php");
    try {
        $bid = $_POST['bid'];
        $product = $_POST['id'];
        $bidder = $_SESSION['username'];
        $hist = ($_POST['history'] != '' ? $_POST['history'].  ',' . $bidder: $_POST['history']);
        $hist = $hist . ': ' . $bid;

        $stmt = $db->prepare('UPDATE items SET currentBid = :bid, bidHistory = :hist WHERE id = :id');
        $stmt->bindValue(':bid',$bid);
        $stmt->bindValue(':hist',$hist);
        $stmt->bindValue(':id',$product);
        $stmt->execute();

        header("Location: product.php?id=" . $product);
    }
    catch (Exception $e) {
        echo $e->getMessage();
    }
    

?>