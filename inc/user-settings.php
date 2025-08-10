<?php
/*
 * 用户设置相关功能
 */

// 用户资料页美化
function zibi_child_user_profile_style() {
    ?>
    <style>
    /* 用户头像美化 */
    .avatar {
        border-radius: 50%;
        transition: all 0.3s ease;
    }
    .avatar:hover {
        transform: scale(1.1);
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
    }

    /* 用户资料卡美化 */
    .user-profile-card {
        background-color: #fff;
        border-radius: var(--border-radius);
        box-shadow: var(--shadow);
        padding: 20px;
        margin-bottom: 20px;
    }

    /* 用户统计数据美化 */
    .user-stats {
        display: flex;
        justify-content: space-around;
        margin-top: 15px;
    }
    .user-stat-item {
        text-align: center;
    }
    .user-stat-count {
        font-size: 24px;
        font-weight: bold;
        color: var(--main-color);
    }
    .user-stat-label {
        font-size: 14px;
        color: var(--light-text);
    }
    </style>
    <?php
}
if (function_exists('add_action')) {
    add_action('wp_head', 'zibi_child_user_profile_style');
}

// 用户菜单自定义
function zibi_child_custom_user_menu($items, $args) {
    if ($args->theme_location == 'primary') {
        // 只在登录时显示用户菜单
        if (is_user_logged_in()) {
            if (function_exists('wp_get_current_user')) {
                $current_user = wp_get_current_user();
            } else if (class_exists('WP_User')) {
                $current_user = new WP_User();
            } else {
                $current_user = null;
            }
            if ($current_user !== null) {
                $author_url = function_exists('get_author_posts_url') ? get_author_posts_url($current_user->ID) : '#';
                $avatar_html = function_exists('get_avatar') ? get_avatar($current_user->ID, 24, '', '', array('class' => 'inline-block mr-2')) : '';
                $user_menu = '<li class="menu-item menu-item-user">
                                <a href="' . $author_url . '">
                                    ' . $avatar_html . '
                                    <span>' . $current_user->display_name . '</span>
                                </a>
                            </li>';
                $items .= $user_menu;
            }
        }
    }
    return $items;
}
add_filter('wp_nav_menu_items', 'zibi_child_custom_user_menu', 10, 2);

// 自定义用户注册表单
function zibi_child_custom_register_form() {
    ?>
    <style>
    .register-form {
        max-width: 500px;
        margin: 0 auto;
        padding: 20px;
        background-color: #fff;
        border-radius: var(--border-radius);
        box-shadow: var(--shadow);
    }
    .register-form label {
        display: block;
        margin-bottom: 8px;
        font-weight: bold;
    }
    .register-form input {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ddd;
        border-radius: var(--border-radius);
    }
    .register-form input[type="submit"] {
        background-color: var(--main-color);
        color: #fff;
        border: none;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    .register-form input[type="submit"]:hover {
        background-color: #cc4d00;
        transform: translateY(-2px);
        box-shadow: var(--shadow);
    }
    </style>
    <?php
}
add_action('register_form', 'zibi_child_custom_register_form');