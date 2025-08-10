<?php
/*
 * 评论设置相关功能
 */

// 评论区美化 - CSS样式
function zibi_child_comment_css_style() {
    ?>
    <style>
    /* 评论列表美化 */
    .comment-list {
        list-style: none;
        padding: 0;
    }
    .comment-body {
        margin-bottom: 15px;
        padding: 15px;
        background-color: #fff;
        border-radius: var(--border-radius);
        box-shadow: var(--shadow);
    }

    /* 评论作者信息美化 */
    .comment-author {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
    }
    .comment-author-name {
        color: var(--main-color);
        font-weight: bold;
    }
    .comment-time {
        font-size: 12px;
        color: var(--light-text);
    }

    /* 评论内容美化 */
    .comment-content {
        line-height: 1.6;
        color: var(--text-color);
    }

    /* 评论回复按钮美化 */
    .comment-reply-link {
        display: inline-block;
        padding: 5px 10px;
        background-color: var(--secondary-color);
        color: #fff;
        border-radius: var(--border-radius);
        text-decoration: none;
        transition: all 0.3s ease;
    }
    .comment-reply-link:hover {
        background-color: #2868cc;
        transform: translateY(-2px);
        box-shadow: var(--shadow);
    }

    /* 评论表单美化 */
    .comment-form {
        max-width: 600px;
        margin: 20px auto;
        padding: 20px;
        background-color: #fff;
        border-radius: var(--border-radius);
        box-shadow: var(--shadow);
    }
    .comment-form label {
        display: block;
        margin-bottom: 8px;
        font-weight: bold;
    }
    .comment-form input,
    .comment-form textarea {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ddd;
        border-radius: var(--border-radius);
    }
    .comment-form textarea {
        height: 150px;
        resize: vertical;
    }
    .comment-form input[type="submit"] {
        background-color: var(--main-color);
        color: #fff;
        border: none;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    .comment-form input[type="submit"]:hover {
        background-color: #cc4d00;
        transform: translateY(-2px);
        box-shadow: var(--shadow);
    }
    </style>
    <?php
}
add_action('wp_head', 'zibi_child_comment_css_style');

// 自定义评论列表回调函数
function zibi_child_comment_callback($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;
    ?>
    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
        <div id="comment-<?php comment_ID(); ?>"
             class="comment-body border rounded-lg p-4 mb-4 shadow-sm bg-white">
            <div class="comment-author vcard flex items-center">
                <?php echo get_avatar($comment, 48, '', '', array('class' => 'rounded-full mr-3')); ?>
                <div class="comment-meta commentmetadata">
                    <span class="comment-author-name font-bold text-lg text-gray-800"><?php echo get_comment_author_link(); ?></span>
                    <span class="comment-time text-sm text-gray-500 ml-2"><?php echo get_comment_date(); ?> <?php echo get_comment_time(); ?></span>
                </div>
            </div>
            <div class="comment-content mt-2 text-gray-700">
                <?php if (function_exists('wp_kses_post') && function_exists('get_comment_text')) { echo wp_kses_post(get_comment_text()); } ?>
            </div>
            <div class="comment-reply mt-3">
                <?php if (function_exists('comment_reply_link') && is_singular() && comments_open() && get_option('thread_comments')) { comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth'], 'reply_text' => '回复'))); } ?>
            </div>
        </div>
    </li>
    <?php
}

// 修改评论列表回调函数
function zibi_child_change_comment_callback($args) {
    $args['callback'] = 'zibi_child_comment_callback';
    return $args;
}
add_filter('comment_list_args', 'zibi_child_change_comment_callback');

// 评论表情功能
function zibi_child_enable_emoji() {
    add_filter('comment_text', 'convert_smilies');
}
add_action('init', 'zibi_child_enable_emoji');