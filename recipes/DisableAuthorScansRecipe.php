<?php


namespace ChewWpNoBullshit\Recipe;

use ChewWpNoBullshit\AbstractChewRecipe;

/**
 * Class DisableAuthorScansRecipe
 * @package ChewWpNoBullshit\Recipe
 */
class DisableAuthorScansRecipe extends AbstractChewRecipe
{
    public function apply()
    {
        add_action('template_redirect', function() {
            if (is_author()) {
                $this->send404();
            }
        });

        add_filter('rest_endpoints', function($endpoints) {
            if (isset($endpoints['/wp/v2/users'])) {
                unset($endpoints['/wp/v2/users']);
            }

            if (isset($endpoints['/wp/v2/users/(?P<id>[\d]+)'])) {
                unset($endpoints['/wp/v2/users/(?P<id>[\d]+)']);
            }

            return $endpoints;
        });

        add_action('init', function(){
            if (is_admin()) {
                return;
            }

            if (!empty($_SERVER['QUERY_STRING']) && preg_match('/author=([0-9]*)/i', $_SERVER['QUERY_STRING'])) {
                $this->send404();
                return;
            }

            add_filter('redirect_canonical', function($redirect, $request){
                if (preg_match('/\?author=([0-9]*)(\/*)/i', $request)) {
                    $this->send404();
                    return;
                }

                return $redirect;
            }, 10, 2);
        });
    }

    private function send404() {
        global $wp_query;
        $wp_query = new \WP_Query();
        $wp_query->set_404();
        status_header(404);
    }
}
