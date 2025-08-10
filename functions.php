<?php
/*
 * 子比子主题 functions.php
 * 只包含网站美化相关的功能
 */

// 引入用户设置、评论设置和自定义设置面板文件
if (function_exists('get_stylesheet_directory')) {
    require_once get_stylesheet_directory() . '/inc/user-settings.php';
    require_once get_stylesheet_directory() . '/inc/comment-settings.php';
    require_once get_stylesheet_directory() . '/inc/customizer.php';
}

// 主题初始化
function zibi_child_init() {
    // 注册导航菜单
    register_nav_menus(array(
        'primary' => function_exists('__') ? __('Primary Menu', 'zibi-child') : 'Primary Menu',
    ));
}
add_action('init', 'zibi_child_init');

// 自定义缩略图尺寸
function zibi_child_add_image_sizes() {
    add_image_size('custom-thumbnail', 300, 200, true);
}
add_action('after_setup_theme', 'zibi_child_add_image_sizes');

// 美化文章卡片
function zibi_child_enqueue_scripts() {
    // 加载自定义脚本
    wp_enqueue_script('zibi-child-custom', get_stylesheet_directory_uri() . '/assets/js/custom.js', array('jquery'), '1.0', true);
}
add_action('wp_enqueue_scripts', 'zibi_child_enqueue_scripts');

// 自定义页脚信息
function zibi_child_footer_info() {
    echo '<div class="footer-info">';
    echo '<p>© ' . date('Y') . ' ' . (function_exists('get_bloginfo') ? get_bloginfo('name') : '') . '. 保留所有权利。</p>';
    echo '</div>';
}
if (function_exists('add_action')) {
    add_action('zibll_footer', 'zibi_child_footer_info');
}

// 美化评论区
function zibi_child_comment_style($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;
    ?>
    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
        <div id="comment-<?php comment_ID(); ?>"
             class="comment-body border rounded-lg p-4 mb-4 shadow-sm bg-white">
            <div class="comment-author vcard">
                <?php echo get_avatar($comment, 48, '', '', array('class' => 'rounded-full')); ?>
                <div class="comment-meta commentmetadata ml-3">
                    <span class="comment-author-name font-bold"><?php echo get_comment_author_link(); ?></span>
                    <span class="comment-time text-sm text-gray-500 ml-2"><?php echo get_comment_date(); ?></span>
                </div>
            </div>
            <div class="comment-content mt-2 text-gray-700">
                <?php if (function_exists('wp_kses_post') && function_exists('get_comment_text')) { echo wp_kses_post(get_comment_text()); } ?>
            </div>
            <div class="comment-reply mt-2">
                <?php if (function_exists('comment_reply_link') && is_singular() && comments_open() && get_option('thread_comments')) { comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))); } ?>
            </div>
        </div>
    </li>
    <?php
}