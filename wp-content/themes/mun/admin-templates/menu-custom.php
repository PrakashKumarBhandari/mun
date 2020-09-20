<?php

 /**
 * Custom walker class.
 */
class WPDocs_Walker_Nav_Menu extends Walker_Nav_Menu {
    
    /**
        * Starts the list before the elements are added.
        *
        * Adds classes to the unordered list sub-menus.
        *
        * @param string $output Passed by reference. Used to append additional content.
        * @param int    $depth  Depth of menu item. Used for padding.
        * @param array  $args   An array of arguments. @see wp_nav_menu()
        */
    function start_lvl( &$output, $depth = 0, $args = array() ) {
        // Depth-dependent classes.
        $indent = ( $depth > 0  ? str_repeat( "\t", $depth ) : '' ); // code indent
        $display_depth = ( $depth + 1); // because it counts the first submenu as 0
        $classes = array(
            'dm-align-2',
            ( $display_depth % 2  ? 'menu-odd' : 'menu-even' ),
            ( $display_depth >=2 ? 'sub-sub-menu' : '' ),
            'menu-depth-' . $display_depth
        );
        $class_names = implode( ' ', $classes );
    
        // Build HTML for output.
        $output .= "\n" . $indent . '<ul class="' . $class_names . '">' . "\n";
    }
    
    /**
        * Start the element output.
        *
        * Adds main/sub-classes to the list items and links.
        *
        * @param string $output Passed by reference. Used to append additional content.
        * @param object $item   Menu item data object.
        * @param int    $depth  Depth of menu item. Used for padding.
        * @param array  $args   An array of arguments. @see wp_nav_menu()
        * @param int    $id     Current item ID.
        */
    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        global $wp_query;
        $indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' ); // code indent
    
        // Depth-dependent classes.
        $depth_classes = array(
            ( $depth == 0 ? 'main-menu-item' : 'sub-menu-item' ),
            ( $depth >=2 ? 'sub-sub-menu-item' : '' ),
            ( $depth % 2 ? 'menu-item-odd' : 'menu-item-even' ),
            'menu-item-depth-' . $depth
        );
        $depth_class_names = esc_attr( implode( ' ', $depth_classes ) );
    
        // Passed classes.
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ) );
    
        // Build HTML.
        $output .= $indent . '<li id="nav-menu-item-'. $item->ID . '" class="' . $depth_class_names . ' ' . $class_names . '">';
        //$output .= '<li id="nav-menu-item">Test</li>';
        // Link attributes.
        $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
        $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
        $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
        $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
        //$show_online_order = $item->attr_title =='catering'
        //$add_online_btn = ' data-glf-cuid="32dd0618-6f5d-4340-8399-a2e5d3b9c004" data-glf-ruid="67674f85-1941-43cd-9b51-54ca8e162328" ';
        $add_online_btn ='';
        if($item->url =='#' && strtolower($item->title) == 'order online'){ 
            $add_online_btn =' data-glf-cuid="ab796819-c744-4b58-9fed-5d3b9c632059" data-glf-ruid="e227a7e1-129a-42d0-92a6-c47f2102b9b4" ';
            }
        $attributes .= ' class="menu-link ' . ( $depth > 0 ? 'sub-menu-link' : 'main-menu-link' ) . '" '.$add_online_btn;
    
        // Build HTML output and pass through the proper filter.
        $item_output = sprintf( '%1$s<a%2$s>%3$s%4$s%5$s</a>%6$s',
            $args->before,
            $attributes,
            $args->link_before,
            apply_filters( 'the_title', $item->title, $item->ID ),
            $args->link_after,
            $args->after
        );
        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
}

?>