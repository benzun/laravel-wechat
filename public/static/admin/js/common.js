$('.getWechaQrCode').click(function () {
    var data = $(this).data();
    swal({
        title: null,
        text: "点击鼠标右键，选择另存为,进行保存二维码",
        imageSize:'360x360',
        imageUrl: 'http://open.weixin.qq.com/qr/code/?username=' + data.wechat_id,
    });
    $('.sweet-alert').find('h2').hide();
});