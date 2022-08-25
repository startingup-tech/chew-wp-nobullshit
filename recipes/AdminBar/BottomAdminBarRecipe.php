<?php

namespace ChewWpNoBullshit\Recipe\AdminBar;

use ChewWpNoBullshit\AbstractChewRecipe;


/**
 * A recipe to put the wordpress bar to the bottom of the screen
 */
class BottomAdminBarRecipe extends AbstractChewRecipe
{
    /**
     * @return void
     */
    public function apply()
    {
        add_action('init', function(){
            if (! current_user_can('administrator')) {
                return;
            }

            add_action('wp_head', function() {
                remove_action('wp_head', 'wp_admin_bar_header');
                remove_action('wp_head', '_admin_bar_bump_cb');
            }, -1);

            add_filter('allowedBodyClasses', function($classes) {
                return array_merge($classes, [
                    'admin-bar',
                ]);
            });

            add_action('wp_head', function() {
                ?>
                <style type="text/css">
                    html {
                        display: block;
                        padding-bottom: 32px !important;
                    }

                    body.admin-bar {
                        padding-bottom: 33px !important;
                    }

                    #wpadminbar {
                        top: auto !important;
                        bottom: 0;
                    }

                    #wpadminbar .quicklinks > ul > li {
                        position:relative;
                    }

                    #wpadminbar .ab-top-menu > .menupop > .ab-sub-wrapper {
                        bottom:33px;
                    }

                    .footer {
                        padding-bottom: 33px;
                    }
                </style>
                <?php
            });
        });
    }
}

