<?php
include_once 'connection.php';
session_start();

if (isset($_SESSION['cart_items']) && count($_SESSION['cart_items']) > 0) {
    // If there are items in the cart, display them
    $cart_items = $_SESSION['cart_items'];
    ?>
  <table>
    <thead>
      <tr>
        <th>Product</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Total</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php
foreach ($cart_items as $item) {
        ?>
        <tr>
          <td><?php echo $item['name']; ?></td>
          <td><?php echo $item['price']; ?></td>
          <td><?php echo $item['quantity']; ?></td>
          <td><?php echo $item['price'] * $item['quantity']; ?></td>
          <td>
            <a href="remove_cart_item.php?id=<?php echo $item['id']; ?>">Remove</a>
          </td>
        </tr>
        <?php
}
    ?>
    </tbody>
    <tfoot>
      <tr>
        <td colspan="3">Total:</td>
        <td><?php echo get_cart_total(); ?></td>
        <td></td>
      </tr>
    </tfoot>
  </table>
  <?php
} else {
    // If there are no items in the cart, display a message
    echo "<p>Your cart is empty.</p>";
}

function get_cart_total()
{
    $total = 0;
    if (isset($_SESSION['cart_items']) && count($_SESSION['cart_items']) > 0) {
        foreach ($_SESSION['cart_items'] as $item) {
            $total += $item['price'] * $item['quantity'];
        }
    }
    return $total;
}
?>
