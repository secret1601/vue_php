<?php
/**
 * Menu Tab For Theme Option.
 *
 * @package Brando
 */
?>
<?php
$this->sections[] = array(
    'icon' => 'el-icon-lines',
    'title' => esc_html__('Menu', 'brando'),
    'desc' => esc_html__('Assign menu for header section.', 'brando'),
    'fields' => array(
        array(
            'id'       => 'brando_enable_menu',
            'type'     => 'switch',
            'title'    => esc_html__('Enable Menu', 'brando' ),
            'default'  => true,
        ),
        array(
            'id'       => 'brando_header_menu',
            'type'     => 'select',
            'data'     => 'menus',
            'title'    => esc_html__( 'Select Menu', 'brando' ),
            'subtitle'    => esc_html__( 'You can manage menu using Appearance > Menus', 'brando' ),
            'required'  => array('brando_enable_menu', 'equals', array('1') ),
        ),
    )
);