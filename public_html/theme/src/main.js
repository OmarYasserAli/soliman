new WOW().init();
$(window).on("scroll", function () {
  if ($(window).scrollTop() > 300) {
    $(".soliman-navbar").addClass("stick");
  } else {
    $(".soliman-navbar").removeClass("stick");
  }
});

$('.nav-btn').on('click', function(e){
  e.preventDefault();
  $('.soliman-nav-menu').fadeToggle(200)
  $('.soliman-navc').toggleClass('menu-active');
  if($('header').hasClass('einside')){
    $('header').addClass('inside')
    $('header').removeClass('einside')
  }else{

      if($('header').hasClass('inside')){
        $('header').addClass('einside')
        $('header').removeClass('inside')

      }
  }

})

$(".soliman-products-slick").slick({
  arrows: false,
  dots: true
});

$(".hsleft").click(function () {
  $(".soliman-products-slick").slick("slickPrev");
});

$(".hsright").click(function () {
  $(".soliman-products-slick").slick("slickNext");
});

$("nav a.has-menu").on('click',function (e) {
  e.preventDefault();
});

$(".soliman-investment-item").on('click',function (e) {
  if($(this).hasClass('has-sub')){
    e.preventDefault();
    var id = $(this).attr('data-id');
    $('#'+id).fadeToggle(300)
  }
});

$('#newsletter-btn').on('click', function(e){
    e.preventDefault();
    var val = $('#newsletter-input').val();
    if(val == ''){
        return false;
    }
    $.ajax({
        url: '/newsletter',
        type: 'POST',
        data: {
            email: val,
            _token: $('[name=_token]').val()
        },
        beforeSend: function() {
            $('footer').addClass('__load')
        },
        error: function(jqXHR, textStatus, errorThrown){
            $('footer').removeClass('__load')
        },
        success: function(data){
            $('footer').removeClass('__load');
            console.log(data);
            $('.soliman-footer-newsletter-alert').html('<p calss="'+data.status+'">'+data.msg+'</p>');
            setTimeout(()=>{
                $('.soliman-footer-newsletter-alert').html('')
                $('.soliman-newsletter').find('input').val('')
            }, 5000)
        }
    })
});

$('.favorform i').on('click', function(e){
    $('.favorform').fadeOut(300);
});

$('#favor-show').on('click', function(e){
    $('.favorform').fadeIn(300);
});

$('.favorform button').on('click', function(e){
    e.preventDefault();
    $.ajax({
        url: '/register-project',
        type: 'POST',
        data: $('#favorform').serializeArray(),
        beforeSend: function() {
            $('.favorform p').removeAttr('class').text('');
            $('.favorform').addClass('__load')
        },
        error: function(jqXHR, textStatus, errorThrown){
            $('.favorform').removeClass('__load')
        },
        success: function(data){
            $('.favorform').removeClass('__load');
            console.log(data);
            $('.favorform p').addClass(data.status).text(data.msg);
            if(data.status == 'success'){
                $('#favorform').trigger('reset')
                setTimeout(()=>{
                    $('.favorform p').removeAttr('class').text('');
                    $('.favorform i').trigger('click')
                }, 3000)
            }
        }
    })
});

$('.soliman-nav-menu a.has-menu').on('click', function(e){
    e.preventDefault();
    $(this).next('ul').fadeToggle(300)
})
