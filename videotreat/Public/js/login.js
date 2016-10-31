$(function() {
    //手机号光标丢失验证
    $('input[name=tel]').blur(function () {
        var v = $(this).val();
        var n = $(this).parent().next();
        var t = $(this);
        var reg = /^\d{11}$/;
        if (v == '') {
            n.css('display', 'block').find('span').html('手机号码不能为空');
            telok = false;
        } else if (!reg.test(v)) {
            n.css('display', 'block').find('span').html('手机号码位数或格式不对');
            telok = false;
        }
        else {
            n.css('display', 'none');
            telok = true;
        }
    });
    //密码光标丢失验证
    $('input[name=dpass]').blur(function () {
        var v = $(this).val();
        var n = $(this).parent().next();
        var t = $(this);
        if (v == '') {
            n.css('display', 'block').find('span').html('密码不能为空');
            dpassok = false;
        } else {
            n.css('display', 'none');
            dpassok = true;
        }
    })
    ////提交验证
    //$('.sub').click(function () {
    //    $('input[name=tel]').trigger('blur');
    //    $('input[name=dpass]').trigger('blur');
    //    if (telok && dpassok) {
    //        document.frm.action = '../../Login/checkLogin';
    //    } else {
    //        return false;
    //    }
    //})
    //按钮样式切换
    $('.login button').mouseover(function () {
        $(this).css("background", "#ad1427")
            .mouseout(function () {
                $(this).css("background", "#c91d33")
            });
    })
})