<?php
require_once("wp-load.php");
require_once(ABSPATH . "wp-admin/includes/image.php");
require_once(ABSPATH . "wp-admin/includes/file.php");
require_once(ABSPATH . "wp-admin/includes/media.php");

$file_path = "C:/xampp/htdocs/wp-latin/wp-content/uploads/latin-logo.jpg";
$file_type = wp_check_filetype(basename($file_path), null);

$attachment = array(
    "post_mime_type" => $file_type["type"],
    "post_title"     => sanitize_file_name(basename($file_path)),
    "post_content"   => "",
    "post_status"    => "inherit"
);

$attach_id = wp_insert_attachment($attachment, $file_path);
$attach_data = wp_generate_attachment_metadata($attach_id, $file_path);
wp_update_attachment_metadata($attach_id, $attach_data);

// Set as custom logo
set_theme_mod("custom_logo", $attach_id);

// Update Astra settings
$astra_settings = get_option("astra-settings", array());
$astra_settings["display-site-title-responsive"] = array("desktop" => 0, "tablet" => 0, "mobile" => 0);
$astra_settings["display-site-logo-responsive"] = array("desktop" => 1, "tablet" => 1, "mobile" => 1);
$astra_settings["logo-width"] = array("desktop" => 80, "tablet" => 60, "mobile" => 50); // Set a reasonable width

update_option("astra-settings", $astra_settings);

echo "Logo registered with ID: " . $attach_id . "\n";
?>
