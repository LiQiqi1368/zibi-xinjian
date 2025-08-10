<?php
/*
 * 自定义设置面板
 */

// 添加自定义设置面板
function zibi_child_customize_register($wp_customize) {
    // 添加颜色设置部分
    $wp_customize->add_section('zibi_child_color_section', array(
        'title' => __('颜色设置', 'zibi-child'),
        'priority' => 30,
    ));

    // 主色调设置
    $wp_customize->add_setting('zibi_child_main_color', array(
        'default' => '#ff6000',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    if (class_exists('WP_Customize_Color_Control')) {
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'zibi_child_main_color', array(
            'label' => __('主色调', 'zibi-child'),
            'section' => 'zibi_child_color_section',
            'settings' => 'zibi_child_main_color',
        )));
    }

    // 辅助色设置
    $wp_customize->add_setting('zibi_child_secondary_color', array(
        'default' => '#3385ff',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    if (class_exists('WP_Customize_Color_Control')) {
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'zibi_child_secondary_color', array(
            'label' => __('辅助色', 'zibi-child'),
            'section' => 'zibi_child_color_section',
            'settings' => 'zibi_child_secondary_color',
        )));
    }

    // 强调色设置
    $wp_customize->add_setting('zibi_child_accent_color', array(
        'default' => '#13adff',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    if (class_exists('WP_Customize_Color_Control')) {
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'zibi_child_accent_color', array(
            'label' => __('强调色', 'zibi-child'),
            'section' => 'zibi_child_color_section',
            'settings' => 'zibi_child_accent_color',
        )));
    }

    // 添加布局设置部分
    $wp_customize->add_section('zibi_child_layout_section', array(
        'title' => __('布局设置', 'zibi-child'),
        'priority' => 35,
    ));

    // 添加页面设置部分
    $wp_customize->add_section('zibi_child_page_section', array(
        'title' => __('页面设置', 'zibi-child'),
        'priority' => 40,
    ));

    // 启用页面美化设置
    $wp_customize->add_setting('zibi_child_enable_page_beautify', array(
        'default' => '1',
        'sanitize_callback' => 'absint',
    ));

    $wp_customize->add_control('zibi_child_enable_page_beautify', array(
        'label' => __('启用页面美化', 'zibi-child'),
        'section' => 'zibi_child_page_section',
        'settings' => 'zibi_child_enable_page_beautify',
        'type' => 'checkbox',
        'description' => __('勾选此项以启用所有页面美化功能', 'zibi-child'),
    ));

    // 页面宽度设置
    $wp_customize->add_setting('zibi_child_page_width', array(
        'default' => '1200',
        'sanitize_callback' => 'absint',
    ));

    $wp_customize->add_control('zibi_child_page_width', array(
        'label' => __('页面最大宽度 (px)', 'zibi-child'),
        'section' => 'zibi_child_page_section',
        'settings' => 'zibi_child_page_width',
        'type' => 'number',
        'input_attrs' => array(
            'min' => 900,
            'max' => 1600,
            'step' => 50,
        ),
    ));

    // 页面背景色设置
    $wp_customize->add_setting('zibi_child_page_background_color', array(
        'default' => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    if (class_exists('WP_Customize_Color_Control')) {
        $wp_customize->add_control( new \WP_Customize_Color_Control( $wp_customize, 'zibi_child_page_background_color', array(
            'label' => __('页面背景色', 'zibi-child'),
            'section' => 'zibi_child_page_section',
            'settings' => 'zibi_child_page_background_color',
        )));
    }

    // 页面标题显示设置
    $wp_customize->add_setting('zibi_child_show_page_title', array(
        'default' => '1',
        'sanitize_callback' => 'absint',
    ));

    $wp_customize->add_control('zibi_child_show_page_title', array(
        'label' => __('显示页面标题', 'zibi-child'),
        'section' => 'zibi_child_page_section',
        'settings' => 'zibi_child_show_page_title',
        'type' => 'checkbox',
    ));

    // 页面标题对齐方式
    $wp_customize->add_setting('zibi_child_page_title_align', array(
        'default' => 'center',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('zibi_child_page_title_align', array(
        'label' => __('页面标题对齐方式', 'zibi-child'),
        'section' => 'zibi_child_page_section',
        'settings' => 'zibi_child_page_title_align',
        'type' => 'select',
        'choices' => array(
            'left' => __('左对齐', 'zibi-child'),
            'center' => __('居中', 'zibi-child'),
            'right' => __('右对齐', 'zibi-child'),
        ),
    ));

    // 边框圆角设置
    $wp_customize->add_setting('zibi_child_border_radius', array(
        'default' => '8',
        'sanitize_callback' => 'absint',
    ));

    $wp_customize->add_control('zibi_child_border_radius', array(
        'label' => __('边框圆角 (px)', 'zibi-child'),
        'section' => 'zibi_child_layout_section',
        'settings' => 'zibi_child_border_radius',
        'type' => 'number',
        'input_attrs' => array(
            'min' => 0,
            'max' => 20,
            'step' => 1,
        ),
    ));

    // 阴影强度设置
    $wp_customize->add_setting('zibi_child_shadow_intensity', array(
        'default' => '0.1',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('zibi_child_shadow_intensity', array(
        'label' => __('阴影强度', 'zibi-child'),
        'section' => 'zibi_child_layout_section',
        'settings' => 'zibi_child_shadow_intensity',
        'type' => 'range',
        'input_attrs' => array(
            'min' => 0,
            'max' => 1,
            'step' => 0.05,
        ),
    ));
}
add_action('customize_register', 'zibi_child_customize_register');

// 输出自定义CSS
function zibi_child_customize_css() {
    ?>
    <style type="text/css">
        :root {
            --main-color: <?php echo function_exists('get_theme_mod') ? get_theme_mod('zibi_child_main_color', '#ff6000') : '#ff6000'; ?>;
            --secondary-color: <?php echo function_exists('get_theme_mod') ? get_theme_mod('zibi_child_secondary_color', '#3385ff') : '#3385ff'; ?>;
            --accent-color: <?php echo function_exists('get_theme_mod') ? get_theme_mod('zibi_child_accent_color', '#13adff') : '#13adff'; ?>;
            --border-radius: <?php echo function_exists('get_theme_mod') ? get_theme_mod('zibi_child_border_radius', '8') : '8'; ?>px;
            --shadow: 0 4px 12px rgba(0, 0, 0, <?php echo function_exists('get_theme_mod') ? get_theme_mod('zibi_child_shadow_intensity', '0.1') : '0.1'; ?>);
            --page-width: <?php echo function_exists('get_theme_mod') ? get_theme_mod('zibi_child_page_width', '1200') : '1200'; ?>px;
            --page-background-color: <?php echo function_exists('get_theme_mod') ? get_theme_mod('zibi_child_page_background_color', '#ffffff') : '#ffffff'; ?>;
            --text-color: #333333;
            --light-text: #666666;
        }

        <?php if (function_exists('get_theme_mod') && get_theme_mod('zibi_child_enable_page_beautify', '1') == '1') : ?>
        .page-container {
            max-width: var(--page-width);
            margin: 0 auto;
            background-color: var(--page-background-color);
        }

        <?php if (function_exists('get_theme_mod') && get_theme_mod('zibi_child_show_page_title', '1') == '0') : ?>
        .page .entry-header {
            display: none;
        }
        <?php endif; ?>

        <?php if (function_exists('get_theme_mod')) : ?>
        .page .entry-title {
            text-align: <?php echo get_theme_mod('zibi_child_page_title_align', 'center'); ?>;
        }
        <?php endif; ?>
        <?php endif; ?>
    </style>
    <?php
}
add_action('wp_head', 'zibi_child_customize_css');