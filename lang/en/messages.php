<?php

return [
    'author' => [
        'created_success' => 'Author created successfully.',
        'created_error' => 'Failed to create author.',

        'update_success' => 'Author updated successfully.',
        'update_error' => 'Failed to update author.',

        'deleted_success' => 'Author deleted successfully.',
        'deleted_error' => 'Failed to delete author.',

        'restored_success' => 'Author restored successfully.',
        'restored_error' => 'Failed to restore author.',

        'selected_restored_success' => 'Selected authors restored successfully.',
        'selected_restored_error' => 'Failed to restore selected authors.',
        'selected_deleted_success' => 'Selected authors deleted successfully.',
        'selected_deleted_error' => 'Failed to delete selected authors.',

        'all_deleted_success' => 'All authors deleted successfully.',
        'all_deleted_error' => 'Failed to delete all authors.',
        'all_restored_success' => 'All authors restored successfully.',
        'all_restored_error' => 'Failed to restore all authors.',
    ],
    'admin' => [
        'created_success' => 'Admin created successfully.',
        'created_error' => 'Failed to create admin.',

        'deleted_success' => 'Admin deleted successfully.',
        'deleted_error' => 'Failed to delete admin.',
        'selected_deleted_success' => 'Selected admins deleted successfully.',
        'selected_deleted_error' => 'Failed to delete selected admins.',
        'all_deleted_success' => 'All admins deleted successfully.',
        'all_deleted_error' => 'Failed to delete all admins.',
        'delete_all_role_error' => 'Cannot delete admin because they have the permission of "All Permissons".',

        'restored_success' => 'Admin restored successfully.',
        'restored_error' => 'Failed to restore admin.',
        'selected_restored_success' => 'Selected admins restored successfully.',
        'selected_restored_error' => 'Failed to restore selected admins.',
        'all_restored_success' => 'All admins restored successfully.',
        'all_restored_error' => 'Failed to restore all admins.',
    ],
    'category' => [
        'created_success' => 'Category created successfully.',
        'created_error' => 'Failed to create category.',

        'updated_success' => 'Category updated successfully.',
        'updated_error' => 'Failed to update category.',

        'deleted_success' => 'Category deleted successfully.',
        'deleted_error' => 'Failed to delete category.',

        'not_found' => 'Category not found.',

        'associated_books' => 'Cannot delete category because it is associated with one or more books.',

        'fetch_error' => 'Failed to fetch category data.',
    ],


    'cart' => [
        'not_found' => 'Cart not found.',
        'item_added_success' => 'Cart item added successfully.',
        'item_removed_success' => 'Item removed successfully.',
        'item_not_found' => 'Cart item not found.',
    ],

    'order' => [
        'not_found' => 'Order not found.',
        'fetch_failed' => 'Failed to fetch order.',
        'status_updated' => 'Order status updated successfully.',
        'status_update_failed' => 'Failed to update order status.',
        'deleted_success' => 'Order deleted successfully.',
        'deleted_failed' => 'Failed to delete order.',
        'email_sent' => 'Email sent successfully!',
        'email_failed' => 'Failed to send email: :message',
        'order_cancelled_title' => 'Order cancelled',
        'order_cancelled_message' => 'Your order has been cancelled. Please contact us immediately',
    ],

    'user' => [
        'created_success' => 'User created successfully.',
        'created_error' => 'An error occurred while creating the user. Please try again.',

        'updated_success' => 'User updated successfully.',
        'updated_error' => 'Failed to update the user. Please try again.',

        'deleted_success' => 'User and all related data deleted successfully.',
        'deleted_error' => 'Failed to delete the user.',

        'not_found' => 'User not found.',
    ],
];
