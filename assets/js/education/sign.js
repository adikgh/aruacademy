// start jquery
$(document).ready(function() {

	// 
	$('.form_im_ii_phone').on('click', function() {
      $('.btn_sign_in').attr('data-type', 'phone')
      $('.form_im_ii_mail').removeClass('form_im_ii_act')
      $(this).addClass('form_im_ii_act')
      $('.form_im_ml').addClass('dsp_n')
      $('.form_im_ph').removeClass('dsp_n')
	})
	$('.form_im_ii_mail').on('click', function() {
      $('.btn_sign_in').attr('data-type', 'mail')
      $('.form_im_ii_phone').removeClass('form_im_ii_act')
      $(this).addClass('form_im_ii_act')
      $('.form_im_ph').addClass('dsp_n')
      $('.form_im_ml').removeClass('dsp_n')
	})
	$('.si_blc_bn .btn').on('click', function() {
      if ($('.btn_sign_in').attr('data-reset') != 1) {
         $('.usign_img > div:last-child').removeClass('dsp_n')
         $('.usign_img > div:first-child').addClass('dsp_n')
         $('.form_im_ps').addClass('dsp_n')
         $('.usign_h').html($('.usign_h').attr('data-reset'))
         $(this).html($(this).attr('data-reset'))
         $('.btn_sign_in').attr('data-reset', 1)
      } else {
         $('.usign_img > div:first-child').removeClass('dsp_n')
         $('.usign_img > div:last-child').addClass('dsp_n')
         $('.form_im_ps').removeClass('dsp_n')
         $('.usign_h').html($('.usign_h').attr('data-main'))
         $(this).html($(this).attr('data-main'))
         $('.btn_sign_in').attr('data-reset', 0)
      }
	})




	// sign in
	$('.btn_sign_in').on('click', function() {
		phone = $('.phone')
      smail = $('.smail')
		password = $('.password')

      if ($(this).attr('data-reset') == 0) {
         if ($(this).attr('data-type') == 'phone') {
            if (phone.attr('data-sel') != 1 || password.attr('data-sel') != 1) {
               if (phone.attr('data-sel') != 1) mess('Cіз телефен номеріңізді жазбапсыз')
               else if (password.attr('data-sel') != 1) mess('Cіз кілт сөзді жазбапсыз')
            } else {
               $.ajax({
                  url: "/education/get.php?phone",
                  type: "POST",
                  dataType: "html",
                  data: ({ 
                     phone: phone.attr('data-val'),
                     password: password.attr('data-val')
                  }),
                  success: function(data){
                     if (data == 'yes') location.reload();
                     else if (data == 'code') mess('Сізді базадан таптым, бірақ тіркелмегенсіз! <br> <a href="sign_up.php">Тіркелу</a>')
                     else if (data == 'password') {
                        mess('Cіз кілт сөзді қате теріп жатсыз')
                        $('.si_blc_bn').removeClass('dsp_n')
                     }
                     else if (data == 'phone') mess('Cіз базада тіркелмегенсіз, админмен байланысып көріңіз!')
                     else console.log(data)
                  },
                  beforeSend: function(){},
                  error: function(data){ console.log(data) }
               })
            }
         } else {   
            if (smail.attr('data-sel') != 1 || password.attr('data-sel') != 1) {
               if (smail.attr('data-sel') != 1) mess('Cіз почтаңызды жазбапсыз')
               else if (password.attr('data-sel') != 1) mess('Cіз кілт сөзді жазбапсыз')
            } else {
               $.ajax({
                  url: "/education/get.php?smail",
                  type: "POST",
                  dataType: "html",
                  data: ({ 
                     smail: smail.attr('data-val'),
                     password: password.attr('data-val')
                  }),
                  success: function(data){
                     if (data == 'yes') location.reload();
                     else if (data == 'code') mess('Сізді базадан таптым, бірақ тіркелмегенсіз! <br> <a href="sign_up_mail.php">Тіркелу</a>')
                     else if (data == 'password') {
                        mess('Cіз кілт сөзді қате теріп жатсыз')
                        $('.si_blc_bn').removeClass('dsp_n')
                     }
                     else if (data == 'mail') mess('Cіз базада тіркелмегенсіз, админмен байланысып көріңіз!')
                     else console.log(data)
                  },
                  beforeSend: function(){},
                  error: function(data){ console.log(data) }
               })
            }
         }
      } else {   
         
      }
	});


	// btn_sign_reset
	$('.btn_sign_reset').on('click', function() {
		btn = $(this)
		phone = $('.phone')
		code = $('.code')
		password = $('.password')

		// 
		if (btn.attr('data-type') == 'phone') {
			if (phone.attr('data-sel') != 1) mess('Cіз телефен номеріңізді жазбапсыз')
			else {
				$.ajax({
					url: "/education/get.php?reset_phone",
					type: "POST",
					dataType: "html",
					data: ({ phone: phone.attr('data-val') }),
					success: function(data){
						if (data == 'phone') mess('Cіз базада тіркелмегенсіз, админмен байланысып көріңіз!')
						else if (data == 'code') {
							phone.attr('disabled', 'true')
							code.parent().removeClass('dsp_n')
							btn.attr('data-type', 'code')
						} else console.log(data)
					},
					beforeSend: function(){},
					error: function(data){console.log(data)}
				})
			}
		} else if (btn.attr('data-type') == 'code') {
			if (code.attr('data-sel') != 1) mess('Cіз сандарды жазбапсыз')
			else {
				$.ajax({
					url: "/education/get.php?reset_code",
					type: "POST",
					dataType: "html",
					data: ({
						phone: phone.attr('data-val'),
						code: code.attr('data-val')
					}),
					success: function(data){
						if (data == 'yes') {
							code.attr('disabled', 'true')
							password.parent().removeClass('dsp_n')
							btn.attr('data-type', 'final')
						} else if (data == 'none') mess('Cіз жазған код қате, қайта жазып көріңіз')
						else console.log(data)
					},
					beforeSend: function(){},
					error: function(data){console.log(data)}
				})
			}
		} else if (btn.attr('data-type') == 'final') {
			if (password.attr('data-sel') != 1) mess('Форманы толық толтырыңыз')
			else {
				$.ajax({
					url: "/education/get.php?reset_final",
					type: "POST",
					dataType: "html",
					data: ({ password: password.attr('data-val') }),
					success: function(data){
						if (data == 'yes') location.reload();
						else console.log(data)
					},
					beforeSend: function(){},
					error: function(data){console.log(data)}
				})
			}
		}
	});





	// btn_pass_reset
	$('.btn_pass_reset').on('click', function() {
		
		// form
		this_btn = $(this)
		btn = $('.btn_sign_in')
		login = $('.login')
		password = $('.password')
		code = $('.code')
		
		// block
		cn_p = $('.usign_p')
		cn_h = $('.usign_h')
		cn_reset = $('.cn_reset')
		cn_reset_time = $('.cn_reset_time')

		$.ajax({
			url: "/education/get.php?pass_reset",
			type: "POST",
			dataType: "html",
			data: ({login: login.attr('data-val')}),
			success: function(data){
				if (data == 'yes') {
					password.parent().addClass('dsp_n')
					code.parent().removeClass('dsp_n')
					cn_reset.addClass('dsp_n')
					cn_p.html(cn_p.attr('data-reset-pass'))
					btn.attr('data-type', 'reset-pass')
				} else {console.log(data)}
				console.log(data);
			},
			beforeSend: function(){},
			error: function(data){console.log(data)}
		})
	});




}) // end jquery