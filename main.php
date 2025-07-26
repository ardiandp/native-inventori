<?php
/**
 * Main template loader dengan routing via URL parameter
 */

// Fungsi untuk membersihkan path
function sanitize_path($path) {
    // Hapus karakter berbahaya
    $path = str_replace(['../', '..\\', '%2e%2e', '%2e'], '', $path);
    
    // Hanya izinkan alphanumeric, garis miring, titik, dan underscore
    $path = preg_replace('/[^a-zA-Z0-9\/\.\_\-]/', '', $path);
    
    return $path;
}

// Ambil parameter page dari URL
$requested_page = isset($_GET['page']) ? sanitize_path($_GET['page']) : 'views/dashboard.php';

// Daftar halaman yang diizinkan
$allowed_pages = [
    'views/dashboard.php',
    'views/produk.php'
    // Tambahkan halaman lain yang diizinkan di sini
];

// Cek apakah halaman yang diminta valid
if (!in_array($requested_page, $allowed_pages)) {
    $requested_page = 'views/dashboard.php';
}

// Ekstrak judul halaman dari nama file
$page_title = ucfirst(str_replace(['views/', '.php'], '', $requested_page));
$active_menu = str_replace(['views/', '.php'], '', $requested_page);

// Fungsi untuk load template
function load_template($page_title, $active_menu, $content_view) {
    // Start output buffering
    ob_start();
    
    // Include header
    require_once 'layout/header.php';
    
    // Include sidebar
    require_once 'layout/sidebar.php';
    
    // Start main content
    echo '<div class="main-content">';
    
    // Include the content view
    if (file_exists($content_view)) {
        require_once $content_view;
    } else {
        echo '<div class="alert alert-danger">Halaman tidak ditemukan!</div>';
    }
    
    // End main content
    echo '</div>';
    
    // Include footer
    require_once 'layout/footer.php';
    
    // End output buffering and flush
    ob_end_flush();
}

// Load template
load_template($page_title, $active_menu, $requested_page);