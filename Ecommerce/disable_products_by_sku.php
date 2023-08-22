<?php
// This function will disable products by sku use this function in your theme functions.php file

// The function accepts an array of target SKUs as its parameter
function disable_products_by_sku($target_sku_array)
{
    // Loop through each target SKU
    foreach ($target_sku_array as $target_sku) {
        $args = array(
            'post_type'      => 'product',
            'posts_per_page' => -1,
            'meta_query'     => array(
                array(
                    'key'     => '_sku',
                    'value'   => $target_sku,
                    'compare' => '==',
                ),
            ),
        );
        // Get all products with the target SKU
        $products = get_posts($args);

        foreach ($products as $product) {
            // Update the product to disable it
            wp_update_post(array(
                'ID'          => $product->ID,
                'post_status' => 'draft',
            ));
        }
    }
}
// Example usage: Disable products sku in array
$sku_array = array('Woo-tshirt-logo', '2', '3', '5');
// Call the function
disable_products_by_sku($sku_array);

//***************************************************************************************

//function accepts an array of target ids as its parameter
function disable_products_by_id($target_id_array)
{
    // Loop through each target ID
    foreach ($target_id_array as $target_id) {
        // Update the product to disable it
        wp_update_post(array(
            'ID'          => $target_id,
            'post_status' => 'draft',
        ));
    }
}

// Example usage: Disable products with given IDs
$id_array = array(872, 4, 6, 8);
// Call the function
disable_products_by_id($id_array);

//***************************************************************************************

// Function to disable products by multiple attributes
function disable_products_by_attributes($attributes_array)
{
    // Loop through each target attributes in array
    foreach ($attributes_array as $attributes) {
        // Create meta query array
        $meta_qurry = array();

        foreach ($attributes as $key => $value) {
            $meta_qurry[] = array(
                'key' => $key,
                'value' => $value,
                'compare' => '=='
            );
        }
        // Get all products with the target attributes
        $args = array(
            'post_type' => 'product',
            'posts_per_page' => -1,
            'meta_query' => $meta_qurry
        );
        $products = get_posts($args);

        // Update the product to disable it
        foreach ($products as $product) {
            wp_update_post(array(
                'ID' => $product->ID,
                'post_status' => 'draft'
            ));
        }
    }
}
// Example usage: Disable products by attributes
$attributes_array = array(
    array(
        '_sku' => 'Woo-tshirt-logo',
    ),
    array(
        '_color' => 'red',
        ''
    ),
);
//TEST: Enable products by attributes