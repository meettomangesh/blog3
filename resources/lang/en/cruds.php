<?php

return [
    'userManagement' => [
        'title'          => 'User management',
        'title_singular' => 'User management',
    ],
    'permission'     => [
        'title'          => 'Permissions',
        'title_singular' => 'Permission',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => '',
            'title'             => 'Title',
            'title_helper'      => '',
            'created_at'        => 'Created at',
            'created_at_helper' => '',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => '',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => '',
        ],
    ],
    'role'           => [
        'title'          => 'Roles',
        'title_singular' => 'Role',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => '',
            'title'              => 'Title',
            'title_helper'       => '',
            'permissions'        => 'Permissions',
            'permissions_helper' => '',
            'created_at'         => 'Created at',
            'created_at_helper'  => '',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => '',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => '',
        ],
    ],
    'region'           => [
        'title'          => 'Regions',
        'title_singular' => 'Region',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => '',
            'region_name'              => 'Name',
            'region_name_helper'       => '',
            'pin_codes'        => 'Pin Codes',
            'pin_codes_helper' => '',
            'created_at'         => 'Created at',
            'created_at_helper'  => '',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => '',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => '',

        ],
    ],
    'user'           => [
        'title'          => 'Users',
        'title_singular' => 'User',
        'fields'         => [
            'id'                       => 'ID',
            'id_helper'                => '',
            'name'                     => 'Name',
            'name_helper'              => '',
            'email'                    => 'Email',
            'email_helper'             => '',
            'email_verified_at'        => 'Email verified at',
            'email_verified_at_helper' => '',
            'password'                 => 'Password',
            'password_helper'          => '',
            'roles'                    => 'Roles',
            'roles_helper'             => '',
            'remember_token'           => 'Remember Token',
            'remember_token_helper'    => '',
            'created_at'               => 'Created at',
            'created_at_helper'        => '',
            'updated_at'               => 'Updated at',
            'updated_at_helper'        => '',
            'deleted_at'               => 'Deleted at',
            'deleted_at_helper'        => '',
        ],
    ],
    'deliveryboy'           => [
        'title'          => 'Delivery Boys',
        'title_singular' => 'Delivery Boy',
        'fields'         => [
            'id'                       => 'ID',
            'id_helper'                => '',
            'name'                     => 'Name',
            'name_helper'              => '',
            'email'                    => 'Email',
            'email_helper'             => '',
            'mobile_number'            => 'Mobile Number',
            'mobile_number_helper'     => '',
            'email_verified_at'        => 'Email verified at',
            'email_verified_at_helper' => '',
            'password'                 => 'Password',
            'password_helper'          => '',
            'roles'                    => 'Roles',
            'roles_helper'             => '',
            'regions'                  => 'Regions',
            'regions_helper'             => '',
            'remember_token'           => 'Remember Token',
            'remember_token_helper'    => '',
            'created_at'               => 'Created at',
            'created_at_helper'        => '',
            'updated_at'               => 'Updated at',
            'updated_at_helper'        => '',
            'deleted_at'               => 'Deleted at',
            'deleted_at_helper'        => '',
        ],
    ],

    'country'        => [
        'title'          => 'Countries',
        'title_singular' => 'Country',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => '',
            'name'              => 'Name',
            'name_helper'       => '',
            'short_code'        => 'Short Code',
            'short_code_helper' => '',
            'created_at'        => 'Created at',
            'created_at_helper' => '',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => '',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => '',
        ],
    ],
    'city'           => [
        'title'          => 'Cities',
        'title_singular' => 'City',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => '',
            'name'              => 'Name',
            'name_helper'       => '',
            'country'           => 'Country',
            'state'             => 'State',
            'country_helper'    => '',
            'state_helper'    => '',
            'created_at'        => 'Created at',
            'created_at_helper' => '',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => '',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => '',
        ],
    ],
    'state'           => [
        'title'          => 'States',
        'title_singular' => 'State',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => '',
            'name'              => 'Name',
            'name_helper'       => '',
            'country'           => 'Country',
            'country_helper'    => '',
            'state'             => 'State',
            'created_at'        => 'Created at',
            'created_at_helper' => '',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => '',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => '',
        ],
    ],
    'pin_code'           => [
        'title'          => 'Pin Codes',
        'title_singular' => 'Pin Code',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => '',
            'pin_code'              => 'Pin Code',
            'name_helper'       => '',
            'country'           => 'Country',
            'state'             => 'State',
            'city'              => 'City',
            'country_helper'    => '',
            'state_helper'      => '',
            'city_helper'       => '',
            'pin_code'          => 'Pin Code',
            'pin_code_helper'   => '',
            'created_at'        => 'Created at',
            'created_at_helper' => '',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => '',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => '',
        ],
    ],
    'territories'           => [
        'title'          => 'Territories',
        'title_singular' => 'Territory',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => '',
            'name'              => 'Name',
            'name_helper'       => '',
            'country'           => 'Country',
            'country_helper'    => '',
            'created_at'        => 'Created at',
            'created_at_helper' => '',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => '',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => '',
        ],
    ],

    'trip'           => [
        'title'          => 'Trips',
        'title_singular' => 'Trip',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => '',
            'city_from'         => 'City From',
            'city_from_helper'  => '',
            'date_from'         => 'Date From',
            'date_from_helper'  => '',
            'city_to'           => 'City To',
            'city_to_helper'    => '',
            'date_to'           => 'Date To',
            'date_to_helper'    => '',
            'adults'            => 'Adults',
            'adults_helper'     => '',
            'children'          => 'Children',
            'children_helper'   => '',
            'created_at'        => 'Created at',
            'created_at_helper' => '',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => '',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => '',
        ],
    ],
    'product'        => [
        'title'          => 'Products',
        'title_singular' => 'Product',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => '',
            'product_image'              => 'Product Image',
            'product_image_helper'       => '',
            'product_name'              => 'Product Name',
            'product_name_helper'       => '',
            'sku'        => 'SKU',
            'sku_helper' => '',
            'short_description'                => 'Short Description',
            'short_description_helper'         => '',
            'opening_quantity'                => 'Opening Quantity',
            'opening_quantity_helper'         => '',
            'category'                => 'Category',
            'category_helper'         => '',
            'expiry_date'                => 'Expiry Date',
            'expiry_date_helper'         => 'The product will not be visible beyond this date.',
            'voucher_value'                => 'Product Price',
            'voucher_value_helper'         => 'The denomination value of the product. Eg. Rs. 100, Rs. 300 etc.',
            'selling_price'                => 'Selling Price',
            'selling_price_helper'         => '',
            'special_price'                => 'Special Price',
            'special_price_helper'         => '',
            'special_price_start_date'                => 'Special Price Start Date',
            'special_price_start_date_helper'         => '',
            'special_price_end_date'                => 'Special Price End Date',
            'special_price_end_date_helper'         => '',
            'min_quantity'                => 'Minimum Quantity',
            'min_quantity_helper'         => 'Minimum quantity that can be purchased at a time.',
            'max_quantity'                => 'Maximum Quantity',
            'max_quantity_helper'         => 'Maximum quantity that can be purchased at a time.',
            'stock_availability' => 'Stock Availability',
            'stock_availability_helper' => '',
            'in_stock' => 'In Stock',
            'out_of_stock' => 'Out of Stock',
            'status'                => 'Status',
            'status_helper'         => '',
            'product_images' => 'Product Images',
            'product_images_helper' => 'Allowed File Size: 2 MB Max  File Type:  .jpg, .jpeg, .png',
            // 'product_images_helper' => '',
            'select_images' => 'Select Images',
            'select_images_helper' => '',
            'preview' => 'Preview',
            'file_name' => 'File Name',
            'image_description' => 'Image Description',
            'display_order' => 'Display Order',
            'remove' => 'Remove',
            'active'                => 'Active',
            'inactive'                => 'InActive',
            'created_at'        => 'Created at',
            'created_at_helper' => '',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => '',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => '',
            'actions'        => 'Actions',
            'actions_helper' => '',
        ],
    ],
    'category'        => [
        'title'          => 'Categories',
        'title_singular' => 'Category',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => '',
            'cat_name'          => 'Name',
            'cat_name_helper'       => '',
            'cat_description'        => 'Category Description',
            'cat_description_helper' => '',
            'status'                => 'Status',
            'status_helper'         => '',
            'active'                => 'Active',
            'inactive'                => 'InActive',
            'created_at'        => 'Created at',
            'created_at_helper' => '',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => '',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => '',
        ],
    ],
    'unit'        => [
        'title'          => 'Units',
        'title_singular' => 'Unit',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => '',
            'category'          => 'Category',
            'category_helper'       => '',
            'unit'          => 'Unit',
            'unit_helper'       => '',
            'description'        => 'Description',
            'description_helper' => '',
            'status'                => 'Status',
            'status_helper'         => '',
            'active'                => 'Active',
            'inactive'                => 'InActive',
            'created_at'        => 'Created at',
            'created_at_helper' => '',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => '',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => '',
        ],
    ],
    'customers'        => [
        'title'          => 'Customers',
        'title_singular' => 'Customer',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => '',
            'name'          => 'Name',
            'cat_name_helper'       => '',
            'mobile_number'        => 'Mobile Number',
            'email_address'        => 'Email Address',
            'cat_description_helper' => '',
            'status'                => 'Status',
            'status_helper'         => '',
            'active'                => 'Active',
            'inactive'                => 'InActive',
            'created_at'        => 'Created at',
            'created_at_helper' => '',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => '',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => '',
        ],
    ],
];
