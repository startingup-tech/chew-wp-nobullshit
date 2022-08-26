<?php

namespace ChewWpNobullshit\Recipe;

use ChewWpNoBullshit\AbstractChewRecipe;

/**
 * Based on the work of the plugin "No Category Base (WPML)" by "Marios Alexandrou"
 * Plugin URI : http://infolific.com/technology/software-worth-using/no-category-base-for-wordpress/
 * Author URI : http://infolific.com/technology/
 *
 * Copyright 2015 Marios Alexandrou
 * Copyright 2011 Mines (email: hi@mines.io)
 * Copyright 2008 Saurabh Gupta (email: saurabh0@gmail.com)
 */
class NoCategoryBaseRecipe extends AbstractChewRecipe
{
    public function apply()
    {
        /* Actions */
        add_action('created_category', [$this, 'no_category_base_refresh_rules']);
        add_action('delete_category', [$this, 'no_category_base_refresh_rules']);
        add_action('edited_category', [$this, 'no_category_base_refresh_rules']);
        add_action('init', [$this, 'no_category_base_permastruct']);

        /* filters */
        add_filter('category_rewrite_rules', [$this, 'no_category_base_rewrite_rules']);
        add_filter('query_vars', function ($public_query_vars) {
            $public_query_vars[] = 'category_redirect';
            return $public_query_vars;
        });

        add_filter('request', function ($query_vars) {
            if (isset($query_vars['category_redirect'])) {
                $catlink = trailingslashit(get_option('home')) . user_trailingslashit($query_vars['category_redirect'], 'category');
                status_header(301);
                header("Location: $catlink");
                exit();
            }

            return $query_vars;
        });
    }

    public function no_category_base_refresh_rules()
    {
        global $wp_rewrite;
        $wp_rewrite->flush_rules();
    }

    /**
     * Removes category base.
     * @return void
     */
    public function no_category_base_permastruct()
    {
        global $wp_rewrite;
        $wp_rewrite->extra_permastructs['category']['struct'] = '%category%';
    }

    public function no_category_base_rewrite_rules($category_rewrite)
    {
        global $wp_rewrite;
        $category_rewrite = array();

        /* WPML is present: temporary disable terms_clauses filter to get all categories for rewrite */
        if (class_exists('Sitepress')) {
            global $sitepress;

            remove_filter('terms_clauses', array($sitepress, 'terms_clauses'));
            $categories = get_categories(array('hide_empty' => false));
            //Fix provided by Albin here https://wordpress.org/support/topic/bug-with-wpml-2/#post-8362218
            //add_filter( 'terms_clauses', array( $sitepress, 'terms_clauses' ) );
            add_filter('terms_clauses', array($sitepress, 'terms_clauses'), 10, 4);
        } else {
            $categories = get_categories(array('hide_empty' => false));
        }

        foreach ($categories as $category) {
            $category_nicename = $category->slug;

            if ($category->parent == $category->cat_ID) {
                $category->parent = 0;
            } elseif ($category->parent != 0) {
                $category_nicename = get_category_parents($category->parent, false, '/', true) . $category_nicename;
            }

            $category_rewrite['(' . $category_nicename . ')/(?:feed/)?(feed|rdf|rss|rss2|atom)/?$'] = 'index.php?category_name=$matches[1]&feed=$matches[2]';
            $category_rewrite["({$category_nicename})/{$wp_rewrite->pagination_base}/?([0-9]{1,})/?$"] = 'index.php?category_name=$matches[1]&paged=$matches[2]';
            $category_rewrite['(' . $category_nicename . ')/?$'] = 'index.php?category_name=$matches[1]';
        }

        // Redirect support from Old Category Base
        $old_category_base = get_option('category_base') ? get_option('category_base') : 'category';
        $old_category_base = trim($old_category_base, '/');
        $category_rewrite[$old_category_base . '/(.*)$'] = 'index.php?category_redirect=$matches[1]';

        return $category_rewrite;
    }
}