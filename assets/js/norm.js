// start jquery
$(document).ready(function() {

	// 
	$('.lazy_logo').lazy({effect:"fadeIn",effectTime:200,threshold:0})
	$('.lazy_img').lazy({effect:"fadeIn",effectTime:300,threshold:0})
	$('.lazy_bag').lazy({effect:"fadeIn",effectTime:500,threshold:0})
	$('.lazy_flag').lazy({effect:"fadeIn",effectTime:100,threshold:0})
	$('.lazy_ava').lazy({effect:"fadeIn",effectTime:300,threshold:0})


	// 
	$('.menu_bars_clc').on('click', function() {
		$(this).parent().toggleClass('menu_act');
	})
	$('.usmenu_bars_clc').on('click', function() {
		$(this).parent().toggleClass('menu_act');
		$('.ub1_r').toggleClass('ub1_r_act');
	})


	// скрол
	let scroll = $(window).scrollTop()
	if (scroll > 80) $('.header').addClass('header_fix')
	else $('.header').removeClass('header_fix')
	if (scroll > 600) $('.posmz').addClass('posmz_act')
   else $('.posmz').removeClass('posmz_act')
	if (scroll > 80) $('.pop_btn').addClass('pop_btn_fix')
  	else $('.pop_btn').removeClass('pop_btn_fix')
	$(window).scroll(function() {
		scroll = $(window).scrollTop()
		if (scroll > 80) $('.header').addClass('header_fix')
		else $('.header').removeClass('header_fix')
		if (scroll > 600) $('.posmz').addClass('posmz_act')
		else $('.posmz').removeClass('posmz_act')
		if (scroll > 80) $('.pop_btn').addClass('pop_btn_fix')
  		else $('.pop_btn').removeClass('pop_btn_fix')
	})


	// на верх
	$('.clc_top').on('click',function(){$('body,html').animate({scrollTop:0},500)})




	// mask form
	$('.fr_code').mask('0000');
	$('.fr_phone').mask('8 (000) 000-00-00');
	$('.fr_age').mask('00');
	$('.fr_price').mask('#.##0 тг', {reverse: true});
	

	//
	$('input[type*="text"], input[type*="password"]').on('input', function() {
		$(this).attr('data-val', $(this).val())
		if ($(this).attr('data-lenght') <= $(this).val().length) {
			$(this).attr('data-sel', 1);
		} else {$(this).attr('data-sel',0)}
	});
	$('input[type*="tel"]').on('input', function() {
		var val = $(this).val().replace(/_/g, '').replace(/ /g, '').replace(/-/g, '').replace(/\(/g, '').replace(/\)/g, '').replace(/\+/g, '').replace(/тг/g, '').replace(/\./g, '')
		$(this).attr('data-val', val)
		if ($(this).attr('data-lenght') <= val.length) {
			$(this).attr('data-sel', 1);
		} else {$(this).attr('data-sel',0)}
	});
	$('input[type*="url"]').on('input', function(){
		val = $(this).val().replace('https://', '').replace('www.', '').replace('youtube.com/watch?v=', '').replace('youtu.be/', '').replace(/\&.*/, '');
		$(this).attr('data-val', val);
	})

	//
	$('.form_icon_pass').on('click', function() {
		if ($(this).siblings('.password').attr('data-eye') == 0) {
			$(this).siblings('.password').attr('type', 'text')
			$(this).siblings('.password').attr('data-eye', '1')
			$(this).addClass('fa-eye')
			$(this).removeClass('fa-eye-slash')
		} else {
			$(this).siblings('.password').attr('type', 'password')
			$(this).siblings('.password').attr('data-eye', '0')
			$(this).removeClass('fa-eye')
			$(this).addClass('fa-eye-slash')
		}
	})


	// 
	$('.sel_clc').click(function() {
		if ($(this).hasClass('form_sel_act') == false) {
			$('.sel_clc').removeClass('form_sel_act')
			$(this).addClass('form_sel_act')
		} else $(this).removeClass('form_sel_act')
	});
	$('.sel_clc_i .form_im_seli').click(function() {
		$(this).parent().siblings('.sel_clc').attr('data-val', $(this).attr('data-val'))
		$(this).parent().siblings('.sel_clc').html($(this).html())
		$(this).parent().siblings('.sel_clc').removeClass('form_sel_act')
	});

	// 
	$('.form_im_toggle_btn').click(function() { 
		if ($(this).hasClass('form_im_toggle_act') == true) $(this).siblings('input').attr('data-val', 0)
		else $(this).siblings('input').attr('data-val', 1)
		$(this).toggleClass('form_im_toggle_act')
	});




	// form - input 
	// lenght
	// $('.form_im input[type*="tel"]').on('input', function(){
	// 	$(this).parent().removeClass('form_pust');
	// 	in_rez = $(this).val().replace(/ /g, '').replace(/\+/g, '').replace(/\)/g, '').replace(/\(/g, '').replace(/-/g, '').replace(/_/g, '')
	// 	if ($(this).attr('data-pr') == '1' && in_rez.length < $(this).attr('data-lenght')) {
	// 		$(this).parent().removeClass('form_pr_y')
	// 		$(this).parent().addClass('form_pr_n')
	// 	} else if (in_rez.length < $(this).attr('data-lenght')) {
	// 		$(this).parent().removeClass('form_pr_y')
	// 	} else {
	// 		$(this).parent().removeClass('form_pr_n')
	// 		$(this).parent().removeClass('form_pr_nm')
	// 		$(this).parent().addClass('form_pr_y')
	// 		$(this).attr('data-pr', '1')
	// 	}
	// })
	// $('.form_im input[type*="text"], input[type*="password"]').on('input', function(){
	// 	$(this).parent().removeClass('form_pust');
	// 	if ($(this).attr('data-pr') == '1' && $(this).val().length <= $(this).attr('data-lenght')) {
	// 		$(this).parent().removeClass('form_pr_y')
	// 		$(this).parent().addClass('form_pr_n')
	// 	} else if ($(this).val().length <= $(this).attr('data-lenght')) {
	// 		$(this).parent().removeClass('form_pr_y')
	// 	} else {
	// 		$(this).parent().removeClass('form_pr_n')
	// 		$(this).parent().removeClass('form_pr_nm')
	// 		$(this).parent().addClass('form_pr_y')
	// 		$(this).attr('data-pr', '1')
	// 	}
	// })

	// // 
	// $('.form_cn input').focus(function() {
	// 	$(this).parent().addClass('form_act');
	// });
	// $('.form_cn input').blur(function(){
	// 	if ($(this).val().length <= 0) {
	// 		$(this).parent().removeClass('form_act');
	// 	}
	// })
	// $('.form_cn input').on('input', function(){
	// 	$(this).parent().removeClass('form_pust');
	// 	$('.form_sms').parent().addClass('dsp_n');
	// })





	//
	$('.bli_setib1').on('click', function() {
		$('.bl_item').removeClass('bl_item_ac')
		$(this).parents('.bl_item').addClass('bl_item_ac')
	})













	


	//  
	$('html').on('click', '.clc_back', function() { 
		if ($(this).attr('href') && $(this).attr('src') != ' ') location.href = $(this).attr('href')
		else back()
	})






}) // end jquery