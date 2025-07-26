<!-- Sidebar -->
<aside class="sidebar">
    <div class="sidebar-container">
        <ul class="sidebar-menu">
            <li class="menu-header">Main Menu</li>
            <li class="<?php echo isset($active_menu) && $active_menu == 'dashboard' ? 'active' : ''; ?>">
                <a href="index.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
            </li>
            
            <li class="menu-header">Management</li>
            <li class="<?php echo isset($active_menu) && $active_menu == 'users' ? 'active' : ''; ?>">
                <a href="#"><i class="fas fa-users"></i> Users</a>
            </li>
            <li class="<?php echo isset($active_menu) && $active_menu == 'products' ? 'active' : ''; ?>">
                <a href="#"><i class="fas fa-boxes"></i> Products</a>
            </li>
            <li class="<?php echo isset($active_menu) && $active_menu == 'orders' ? 'active' : ''; ?>">
                <a href="#"><i class="fas fa-shopping-cart"></i> Orders</a>
            </li>
            
            <li class="menu-header">Settings</li>
            <li class="<?php echo isset($active_menu) && $active_menu == 'settings' ? 'active' : ''; ?>">
                <a href="#"><i class="fas fa-cog"></i> Settings</a>
            </li>
            <li class="menu-header">Main Menu</li>
            <li class="<?php echo $active_menu == 'dashboard' ? 'active' : ''; ?>">
                <a href="main.php?page=views/dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
            </li>
            
            <li class="menu-header">Management</li>
            <li class="<?php echo $active_menu == 'produk' ? 'active' : ''; ?>">
                <a href="main.php?page=views/produk.php"><i class="fas fa-boxes"></i> Produk</a>
            </li>
            <!-- Tambahkan menu lain sesuai kebutuhan -->
        </ul>
    </div>
</aside>