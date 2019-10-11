<?php
$is_authenticated = isset($is_authenticated) ? $is_authenticated : FALSE;
$active_modul = isset($active_modul) ? $active_modul : "";
$current_user_profil_name = isset($current_user_profil_name) ? $current_user_profil_name : "-";
$current_user_roles = isset($current_user_roles) ? $current_user_roles : "pengguna";
$menu_item = isset($menu_item) ? build_appui_menu($menu_item, $active_modul) : "";
?>

<!-- Drawer navigation -->
<nav class="drawer-main">
    <ul class="nav nav-drawer">

        <?php echo $menu_item; ?>

    </ul>
</nav>
<!-- End drawer navigation -->



<?php
/**
 * Examples appui menu
<!-- Drawer navigation -->
<nav class="drawer-main">
    <ul class="nav nav-drawer">

        <li class="nav-item nav-drawer-header">Apps</li>

        <li class="nav-item active">
            <a href="index.html"><i class="ion-ios-speedometer-outline"></i> Dashboard</a>
        </li>

        <li class="nav-item">
            <a href="frontend_home.html"><i class="ion-ios-monitor-outline"></i> Frontend</a>
        </li>

        <li class="nav-item nav-drawer-header">Components</li>

        <li class="nav-item nav-item-has-subnav">
            <a href="javascript:void(0)"><i class="ion-ios-calculator-outline"></i> UI Elements</a>
            <ul class="nav nav-subnav">

                <li class="nav-item">
                    <a href="base_ui_buttons.html">Buttons</a>
                </li>

                <li>
                    <a href="base_ui_cards.html">Cards</a>
                </li>

                <li>
                    <a href="base_ui_cards_api.html">Cards API</a>
                </li>

                <li>
                    <a href="base_ui_layout.html">Layout</a>
                </li>

                <li>
                    <a href="base_ui_grid.html">Grid</a>
                </li>

                <li>
                    <a href="base_ui_icons.html">Icons</a>
                </li>

                <li>
                    <a href="base_ui_modals_tooltips.html">Modals / Tooltips</a>
                </li>

                <li>
                    <a href="base_ui_alerts_notify.html">Alerts / Notify</a>
                </li>

                <li>
                    <a href="base_ui_pagination.html">Pagination</a>
                </li>

                <li>
                    <a href="base_ui_progress.html">Progress</a>
                </li>

                <li>
                    <a href="base_ui_tabs.html">Tabs</a>
                </li>

                <li>
                    <a href="base_ui_typography.html">Typography</a>
                </li>

                <li>
                    <a href="base_ui_widgets.html">Widgets</a>
                </li>

            </ul>
        </li>

        <li class="nav-item nav-item-has-subnav">
            <a href="javascript:void(0)"><i class="ion-ios-compose-outline"></i> Forms</a>
            <ul class="nav nav-subnav">

                <li>
                    <a href="base_forms_elements.html">Elements</a>
                </li>

                <li>
                    <a href="base_forms_samples.html">Samples</a>
                </li>

                <li>
                    <a href="base_forms_pickers_select.html">Pickers &amp; Select</a>
                </li>

                <li>
                    <a href="base_forms_validation.html">Validation</a>
                </li>

                <li>
                    <a href="base_forms_wizard.html">Wizard</a>
                </li>

            </ul>
        </li>

        <li class="nav-item nav-item-has-subnav">
            <a href="javascript:void(0)"><i class="ion-ios-list-outline"></i> Tables</a>
            <ul class="nav nav-subnav">

                <li>
                    <a href="base_tables_styles.html">Styles</a>
                </li>

                <li>
                    <a href="base_tables_responsive.html">Responsive</a>
                </li>

                <li>
                    <a href="base_tables_tools.html">Tools</a>
                </li>

                <li>
                    <a href="base_tables_pricing.html">Pricing</a>
                </li>

                <li>
                    <a href="base_tables_datatables.html">Wizard</a>
                </li>

            </ul>
        </li>

        <li class="nav-item nav-item-has-subnav">
            <a href="javascript:void(0)"><i class="ion-ios-browsers-outline"></i> Pages</a>
            <ul class="nav nav-subnav">

                <li>
                    <a href="base_pages_blank.html">Blank</a>
                </li>

                <li>
                    <a href="base_pages_inbox.html">Inbox</a>
                </li>

                <li>
                    <a href="base_pages_invoice.html">Invoice</a>
                </li>

                <li>
                    <a href="base_pages_profile.html">Profile</a>
                </li>

                <li>
                    <a href="base_pages_search.html">Search</a>
                </li>

            </ul>
        </li>

        <li class="nav-item nav-item-has-subnav">
            <a href="javascript:void(0)"><i class="ion-social-javascript-outline"></i> JS plugins</a>
            <ul class="nav nav-subnav">

                <li>
                    <a href="base_js_maps.html">Maps</a>
                </li>

                <li>
                    <a href="base_js_sliders.html">Sliders</a>
                </li>

                <li>
                    <a href="base_js_charts_flot.html">Charts - Flot</a>
                </li>

                <li>
                    <a href="base_js_charts_chartjs.html">Charts - Chart.js</a>
                </li>

                <li>
                    <a href="base_js_charts_sparkline.html">Charts - Sparkline</a>
                </li>

                <li>
                    <a href="base_js_draggable.html">Draggable</a>
                </li>

                <li>
                    <a href="base_js_syntax_highlight.html">Syntax highlight</a>
                </li>

            </ul>
        </li>

    </ul>
</nav>
<!-- End drawer navigation -->
*/
?>