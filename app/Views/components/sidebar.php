<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

<ul class="sidebar-nav" id="sidebar-nav">

  <li class="nav-item">
  <a class="nav-link <?php echo (uri_string() == '') ? "" : "collapsed" ?>" href="/">
      <i class="bi bi-grid"></i>
      <span>Home</span>
    </a>
  </li><!-- End Dashboard Nav -->

  <li class="nav-item">
  <a class="nav-link <?php echo (uri_string() == 'keranjang') ? "" : "collapsed" ?>" href="keranjang">
      <i class="bi bi-cart-check"></i>
      <span>Keranjang</span>
    </a>
  </li><!-- End Dashboard Nav -->
  
  <li class="nav-item">
  <a class="nav-link <?php echo (uri_string() == 'produk') ? "" : "collapsed" ?>" href="produk">
      <i class="bi bi-receipt"></i>
      <span>Produk</span>
    </a>
  </li><!-- End Dashboard Nav -->

  <li class="nav-item">
    <a class="nav-link <?php echo (uri_string() == 'profile') ? "" : "collapsed" ?>" href="profile">
        <i class="bi bi-person"></i>
        <span>Profile</span>
    </a>
</li><!-- End Profile Nav -->

  <li class="nav-item">
  <a class="nav-link collapsed" href="<?= base_url('/diskon') ?>">
    <i class="bi bi-cash-coin"></i>
    <span>Diskon</span>
  </a>
</li>
  

  <li class="nav-item">
  <a class="nav-link <?php echo (uri_string() == 'contact') ? "" : "collapsed" ?>" href="contact">
      <i class="bi bi-card-list"></i>
      <span>Contact</span>
    </a>
  </li><!-- End Dashboard Nav -->

</ul>

</aside><!-- End Sidebar-->