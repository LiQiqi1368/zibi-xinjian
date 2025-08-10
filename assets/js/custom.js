// 页面滚动效果
$(document).ready(function() {
    // 平滑滚动
    $('a[href^="#"]').on('click', function(e) {
        e.preventDefault();
        var target = $(this.getAttribute('href'));
        if (target.length) {
            window.scrollTo({
                top: target.offset().top - 80,
                behavior: 'smooth'
            });
        }
    });

    // 导航栏滚动效果
    $(window).scroll(function() {
        if ($(this).scrollTop() > 100) {
            $('.navbar').addClass('bg-white shadow-md').removeClass('bg-transparent');
        } else {
            $('.navbar').removeClass('bg-white shadow-md').addClass('bg-transparent');
        }
    });

    // 图片悬停效果
    $('.post-thumbnail').hover(
        function() {
            $(this).css('transform', 'scale(1.05)');
            $(this).css('transition', 'transform 0.3s ease');
        },
        function() {
            $(this).css('transform', 'scale(1)');
        }
    );

    // 回到顶部按钮
    $(window).scroll(function() {
        if ($(this).scrollTop() > 300) {
            $('.back-to-top').fadeIn();
        } else {
            $('.back-to-top').fadeOut();
        }
    });

    $('.back-to-top').click(function() {
        $('html, body').animate({scrollTop : 0}, 800);
        return false;
    });
});