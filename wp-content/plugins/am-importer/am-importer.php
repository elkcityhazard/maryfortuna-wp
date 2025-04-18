<?php
/* Plugin Name: AM Importer */

if (!defined('ABSPATH')) {
    exit;
}
return;

function import_images_from_folder($folder_path, $category_name) {
    // Create a category based on the folder name if it doesn't already exist
    if (!term_exists($category_name, 'category')) {
        wp_create_category($category_name);
    }

    // Get all images in the specified folder
    $images = glob($folder_path . '/*.{jpg,JPG,jpeg,JPEG,png,gif}', GLOB_BRACE);
    
    // Loop through each image
    foreach ($images as $image) {
        // Get the filename without the extension
        $filename = basename($image);
        $title = pathinfo($filename, PATHINFO_FILENAME);

        // Copy the image to the WordPress uploads directory
        $uploads = wp_upload_dir();  // Get uploads directory info
        $target_path = $uploads['path'] . '/' . $filename;

        // Copy and check for errors
        if (!copy($image, $target_path)) {
            error_log("Failed to copy $image to $target_path");
            continue; // Skip this iteration if the copy fails
        }

        // Create a Post
        $post_data = array(
            'post_title'    => $title,
            'post_content'  => '<p>' . esc_html(pathinfo($filename, PATHINFO_FILENAME)) . '</p>',
            'post_excerpt'  => $title,
            'post_status'   => 'publish',
            'post_category' => array(get_cat_ID($category_name)),
            'post_author'   => 1, // Set the post author to the user with ID = 1
        );

        // Insert the post into the database
        $post_id = wp_insert_post($post_data);

        // Upload the image and set it as the featured image
        $attachment_id = upload_image($target_path, $post_id, $title);
        set_post_thumbnail($post_id, $attachment_id);
    }
}

function upload_image($image_path, $post_id, $title) {
    // Check the file type and upload the image
    $filetype = wp_check_filetype(basename($image_path), null);
    
    // Prepare the attachment
    $attachment = array(
        'guid'           => $image_path, // URL to the file
        'post_mime_type' => $filetype['type'],
        'post_title'     => sanitize_file_name($title),
        'post_content'   => '',
        'post_status'    => 'inherit'
    );

    // Insert the attachment and update metadata
    $attach_id = wp_insert_attachment($attachment, $image_path, $post_id);
    
    // Include image.php to use the WP functions
    require_once(ABSPATH . 'wp-admin/includes/image.php');
    
    // Generate and save the attachment metadata
    $attach_data = wp_generate_attachment_metadata($attach_id, $image_path);
    wp_update_attachment_metadata($attach_id, $attach_data);
    
    // Set the alt text
    update_post_meta($attach_id, '_wp_attachment_image_alt', $title);
    
    // Set the caption
    wp_update_post(array(
        'ID' => $attach_id,
        'post_excerpt' => $title,
    ));

    return $attach_id;
}

// Example usage
add_action('admin_init', function() {
    $folder_path = plugin_dir_path(__FILE__) . "Tree Of Life"; // Change to your folder pa
    $category_name = basename($folder_path); // Create a category based on the folder name
    import_images_from_folder($folder_path, $category_name);
});

