// start jquery
$(document).ready(function() {

	// 
	$('.ub1_lx').on('click', function() {
		$(this).parent().toggleClass('menu_act');
	})



	// 
	if ($(window).width() < 501) {
		if ($('.uitemc_umi').length == 1){
			// $('.uitemc_umi').css('width', '100%')
		} else if ($('.uitemc_umi').length == 2) {
			// $('.uitemc_umi').css('width', '50%')
		} else if ($('.uitemc_umi').length > 3) {
			$('.uitemc_umi:nth-child(1n+3)').addClass('dsp_n')
			$('.uitemc_umid').removeClass('dsp_n')
			$('.uitemc_umidcs').html($('.uitemc_umi.dsp_n'))
			$('.uitemc_umidcs .uitemc_umi').removeClass('dsp_n')
		}
	}


	$('.uitemc_umidl').on('click', function () { 
		$('.uitemc_umid').toggleClass('uitemc_umid_act')
	})


	// скрол
	let scroll = $(window).scrollTop()
	if (scroll > 30) $('.uitemc_u').addClass('uitemc_u_act')
  	else $('.uitemc_u').removeClass('uitemc_u_act')
	$(window).scroll(function() {
		scroll = $(window).scrollTop()
		if (scroll > 30) $('.uitemc_u').addClass('uitemc_u_act')
  		else $('.uitemc_u').removeClass('uitemc_u_act')
	})




	// menu clc
	$('.ub1_ly').click(function() { if ($(window).width() > 1024 && $(window).width() <= 1440) $('.ub1').toggleClass('ub1_ms') })












	// ubdate user
	$('.user_edit_pop').click(function(){
		$('.user_edit_block').addClass('pop_bl_act');
		$('#html').addClass('ovr_h');
	})
	$('.user_edit_back').click(function(){
		$('.user_edit_block').removeClass('pop_bl_act');
		$('#html').removeClass('ovr_h');
	})

	// 
	$('.user_img_add').click(function(){ $(this).siblings('.user_img').click() })
	$(".user_img").change(function(){
		tfile = $(this)
		if (window.FormData === undefined) mess('Бұл формат келмейді')
		else {
			var formData = new FormData();
			formData.append('file', $(this)[0].files[0]);
			$.ajax({
				type: "POST",
				url: "/education/get.php?add_user_img",
				cache: false, contentType: false,
				processData: false, dataType: 'json',
				data: formData,
				success: function(msg){
					if (msg.error == '') {
						tfile_n = 'url(/assets/uploads/users/' + msg.file + ')'
						tfile.attr('data-val', msg.file)
						tfile.siblings('.user_img_add').addClass('form_im_img2')
						tfile.siblings('.user_img_add').css('background-image', tfile_n)
					} else mess(msg.error)
				},
				beforeSend: function(){ },
				error: function(msg){ console.log(msg) }
			});
		}
	});

	$('.btn_user_edit').click(function () {
		// if ($('.user_code').val().length != 4) mess('Код бос болмауы керек!')
		if ($('.user_name').val().length <= 2) mess('Атыңызды толтырыңыз')
		else {
			$.ajax({
				url: "/education/get.php?user_edit",
				type: "POST",
				dataType: "html",
				data: ({
					name: $('.user_name').attr('data-val'), surname: $('.user_surname').attr('data-val'),
					age: $('.user_age').attr('data-val'), img: $('.user_img').attr('data-val'),
					code: $('.user_code').attr('data-val')
				}),
				success: function(data){
					if (data == 'yes') {
						mess('Cәтті сақталды!')
						$('.user_edit_block').removeClass('pop_bl_act');
						setTimeout(function() { location.reload(); }, 500);
					}
					console.log(data);
				},
				beforeSend: function(){ },
				error: function(data){ console.log(data) }
			})
		}
	})



	$('.user_name_edit_back').click(function(){
		$('.user_name_edit_block').removeClass('pop_bl_act');
		$('#html').removeClass('ovr_h');
	})
	$('.btn_user_name_edit').click(function () {
		if ($('.ubd2_user_name').val().length <= 2) mess('Атыңызды толтырыңыз')
		else {
			$.ajax({
				url: "/education/get.php?user_name_edit",
				type: "POST",
				dataType: "html",
				data: ({ name: $('.ubd2_user_name').attr('data-val') }),
				error: function(data){ console.log(data) },
				beforeSend: function(){ },
				success: function(data){
					if (data == 'yes') {
						mess('Cәтті сақталды!')
						$('.user_name_edit_block').removeClass('pop_bl_act');
						setTimeout(function() { location.reload(); }, 500);
					}
					console.log(data);
				},
			})
		}
	})
























	$('.btn_ubd_acc').click(function () { 
		// form
		this_btn = $(this)
		n_name = $('.name')
		surname = $('.surname')
		sex = $('.sex')
		age = $('.age')
		mail = $('.mail')
		phone = $('.phone')
		password = $('.password')

		if (n_name.attr('data-sel') != 1 || surname.attr('data-sel') != 1 || age.attr('data-sel') != 1 || mail.attr('data-sel') != 1 || phone.attr('data-sel') != 1 || password.attr('data-sel') != 1) mess('Форманы толтырыңыз')
		else {
			$.ajax({
				url: "/education/get.php?ubd_acc",
				type: "POST",
				dataType: "html",
				data: ({
					n_name: n_name.attr('data-val'),
					surname: surname.attr('data-val'),
					sex: sex.attr('data-val'),
					age: age.attr('data-val'),
					mail: mail.attr('data-val'),
					phone: phone.attr('data-val'),
					password: password.attr('data-val')
				}),
				success: function(data){
					if (data == 'yes') {
						mess('Cәтті сақталды!')
					} else {console.log(data)}
					console.log(data);
				},
				beforeSend: function(){},
				error: function(data){console.log(data)}
			})
		}
	})
	
	
	


	$('.phone').on('input', function() {
		if ($('.btn_fdal').parent().attr('data-type') == 'reg_info') {
			$('.btn_fdal').children('span').html($('.btn_fdal').attr('data-aut'))
			$('.btn_fdal').parent().attr('data-type', 'aut')
			$('.lg_top_head > *').each(function() {$(this).html($(this).attr('data-lg'))})
		}
	})





	// 
	$('.btn_lc_log').on('click', function() {

		phone = $(this).parent().siblings().children('.phone');
		form_sms = $(this).parent().siblings().children('.form_sms');
		num = '';
		$('.form_cn_code2 input').each(function() {
			num += $(this).attr('data-val')
		});
		
		if (phone.attr('data-sel') != 1 || num.length != 4) {
			phone.parent().addClass('form_pust')
			form_sms.html(form_sms.attr('data-code-pust'))
			form_sms.parent().removeClass('dsp_n')
		} else {
			$.ajax({
				url: "/education/get.php?ls_aut",
				type: "POST",
				dataType: "html",
				data: ({phone: phone.attr('data-val'), code: num}),
				success: function(data){
					if (data == 'yes') {
						location.reload();
					} else if (data == 'none') {
						form_sms.parent().removeClass('dsp_n')
						form_sms.html(form_sms.attr('data-code'))
					} else {console.log(data)}
				},
				beforeSend: function(){},
				error: function(data){console.log(data)}
			})
		}

	});







	// bookmark
	$('.bq3_ci_book').on('click', function() {
		var btn = $(this)
		if (btn.hasClass('bq3_ci_book_act') == false) { 
         btn.addClass('bq3_ci_book_act')
			$.ajax({
				url: "/education/get.php?bookmark_plus",
				type: "POST",
				dataType: "html",
				data: ({ cours_id: btn.attr('data-id') }),
				success: function(data){ 
               if (data=='yes') {
                  mess('Сақтаулыға сақталынды')
                  btn.children('.btn').children('i').addClass('fas')
               }
            },
				beforeSend: function(){ },
				error: function(data){ mess('Ошибка..') }
			})
		} else {
         btn.removeClass('bq3_ci_book_act')
         btn.children('.btn').children('i').removeClass('fas')
         $.ajax({
            url: "/education/get.php?bookmark_del",
				type: "POST",
				dataType: "html",
				data: ({ cours_id: btn.attr('data-id') }),
				success: function(data){ 
               mess('Сақтаулыдан алып тасталынды')
               if (data=='yes') {if (btn.hasClass('bq3_ci_book_act2')==true) btn.parent().remove()}
               if (data=='none') { 
                  $('.bookmark_nn').removeClass('dsp_n')
                  if (btn.hasClass('bq3_ci_book_act2')==true) btn.parent().parent().remove()
               }
               console.log(data);
            },
				beforeSend: function(){ },
				error: function(data){ mess('Ошибка..') }
			})

		}
	})




	$('.form_im_btn_clc .form_im_btn_i').click(function(){
		if ($(this).hasClass('form_im_btn_act') == false) {
			$(this).siblings('.form_im_btn_i').removeClass('form_im_btn_act')
			$(this).addClass('form_im_btn_act')
			$(this).parent().attr('data-val', $(this).attr('data-val'))
		}
	})





	// 
	$('.rad1').on('click', function () { 
		if ($(this).parent().attr('data-sel') == 0) {
			$(this).addClass('form_radio_act')
			$(this).parent().attr('data-sel', 1)

			if ($(this).hasClass('answer') == true) {
				$(this).addClass('form_radio_true');
				var answer = 1;
				mess('Сіздің жауабыңыз дұрыс');
			} else {
				$(this).addClass('form_radio_false');
				$(this).siblings('.answer').addClass('form_radio_true');
				var answer = 0;
				mess('Сіздің жауабыңыз қате, талқылауды қараңыз');
			}

			$.ajax({
				url: "/education/get.php?test_answer",
				type: "POST",
				dataType: "html",
				data: ({ 
					answer: answer, 
					v: $(this).attr('data-val'), 
					test_id: $(this).parent().attr('data-test-id'), 
					lesson_id: $(this).parent().attr('data-lesson-id') 
				}),
				success: function(data){ },
				beforeSend: function(){ },
				error: function(data){ }
			})

		}
	})


	$('.lsb_it1 .lsb_i').on('click', function () {
		if ($(this).hasClass('lsb_act') != true) {
			var nm = Number($(this).attr('data-number')) + 1;
			var cls = '.lsb_i[data-number="' + nm + '"]';
			$(cls).removeClass('dsp_n');
			$(this).addClass('lsb_act');
	
			$.ajax({
				url: "/education/get.php?sub_info_upd",
				type: "POST",
				dataType: "html",
				data: ({ 
					lesson_id: $(this).parent().attr('data-lesson-id'),
					nm: nm,
				}),
				success: function(data){ 
					console.log(data);
				},
				beforeSend: function(){ },
				error: function(data){ console.log(data); }
			})
		}
	})


	// 
	$('.btn_hw').on('click', function () {
		btn = $(this); inp_hm = $('.inp_hm');
		if (inp_hm.val() != '') {
			$.ajax({
				url: "/education/get.php?home_work",
				type: "POST",
				dataType: "html",
				data: ({ 
					cours_id: btn.attr('data-cours-id'), 
					pack_id: btn.attr('data-pack-id'), 
					lesson_id: btn.attr('data-lesson-id'), 
					inp_hm: inp_hm.val()
				}),
				success: function(data){ 
					if (data == 'yes') { location.reload(); }
					console.log(data);
				},
				beforeSend: function(){ },
				error: function(data){ }
			})
		} else mess('Жазуды ұмыттыңыз')
	})



	$('.btn_rev').on('click', function () {

		btn = $(this)
		inp_rev = $('.inp_rev')

		if (inp_rev.val() != '') {
			$.ajax({
				url: "/education/get.php?rev_add",
				type: "POST",
				dataType: "html",
				data: ({ 
					cours_id: btn.attr('data-cours-id'), 
					inp_rev: inp_rev.val()
				}),
				success: function(data){ 
					if (data == 'yes') { location.reload(); }
					console.log(data);
				},
				beforeSend: function(){ },
				error: function(data){ }
			})
		} else { mess('Жазуды ұмыттыңыз') }
	})


	// 
	$('.btn_add_ques').on('click', function () {

		btn = $(this)
		txt = $('.inp_form')

		if (txt.val() != '') {
			$.ajax({
				url: "/education/get.php?add_ques",
				type: "POST",
				dataType: "html",
				data: ({ 
					cours_id: btn.attr('data-cours-id'), 
					pack_id: btn.attr('data-pack-id'), 
					lesson_id: btn.attr('data-lesson-id'), 
					txt: txt.val()
				}),
				success: function(data){ 
					if (data == 'yes') { location.reload(); }
					console.log(data);
				},
				beforeSend: function(){ },
				error: function(data){ }
			})
		} else { mess('Жазуды ұмыттыңыз') }
	})


	// 
	$('.btn_add_review').on('click', function () {

		btn = $(this)
		txt = $('.inp_form')

		if (txt.val() == '') mess('Жазуды ұмыттыңыз')
		else {
			$.ajax({
				url: "/education/cours/masterclass/get.php?add_review",
				type: "POST",
				dataType: "html",
				data: ({ 
					mc_id: btn.attr('data-mc-id'),
					type: btn.attr('data-type'),
					txt: txt.val()
				}),
				success: function(data){ 
					if (data == 'yes') location.reload();
					console.log(data);
				},
				beforeSend: function(){ },
				error: function(data){ }
			})
		} 
	})

	// 
	$('.lsb_crv_ictd').on('click', function () {
		btn = $(this)
		$.ajax({
			url: "/education/cours/masterclass/get.php?del_review",
			type: "POST",
			dataType: "html",
			data: ({ id: btn.attr('data-id') }),
			success: function(data){
				if (data == 'yes') {
					if (btn.attr('data-type') == 1) btn.parents('.lsb_crv_u').remove();
					if (btn.attr('data-type') == 2) {
						if (btn.parents('.lsb_crv_u2').children('.lsb_crv_i').length > 1) btn.parents('.lsb_crv_i').remove();
						else btn.parents('.lsb_crv_u2').remove();
					}
				}
				console.log(data);
			},
			beforeSend: function(){ },
			error: function(data){ }
		})
	})

	// add education
	$('.review_answer_open').click(function(){
		$('.review_answer').addClass('pop_bl_act');
		$('#html').addClass('ovr_h');
		$('.review_answer .btn_review_answer').attr('data-id', $(this).attr('data-id'))
	})
	$('.review_answer_back').click(function(){
		$('.review_answer').removeClass('pop_bl_act');
		$('#html').removeClass('ovr_h');
	})
	$('.btn_review_answer').on('click', function() {
		btn = $(this); txt = $('.inp_form2');
		if (txt.val() == '') mess('Жазуды ұмыттыңыз')
		else {
			$.ajax({
				url: "/education/cours/masterclass/get.php?add_review_answer",
				type: "POST",
				dataType: "html",
				data: ({ 
					id: btn.attr('data-id'),
					txt: txt.val()
				}),
				success: function(data){ 
					if (data == 'yes') location.reload();
					console.log(data);
				},
				beforeSend: function(){ },
				error: function(data){ }
			})
		} 
	})












	// 
	$('.rad2').on('click', function () { 
		if ($(this).parent().attr('data-sel') == 0) {
			$(this).addClass('form_radio_act form_radio_true')
			$(this).parent().children('.rad2').removeClass('form_radio_false')
			$(this).parent().attr('data-sel', 1)

			san = Number($(this).parent().parent().siblings('.btn').attr('data-ball'))
			san = san + Number($(this).attr('data-ball'))
			$(this).parent().parent().siblings('.btn').attr('data-ball', san)
		}
	})

	$('.rad2_btn').on('click', function () { 
		san2 = 0
		$(this).siblings('.lsb_icm').children('.form_im').each(function () { 
			if ($(this).attr('data-sel') == 0) { 
				mess('Тест толық орындаңыз')
				$(this).children('.rad2').addClass('form_radio_false')
			} else san2++
		})
		if (san2 == $(this).attr('data-number')){
			$(this).siblings('.otv_rad2').removeClass('dsp_n')
			if ($(this).attr('data-min') <= $(this).attr('data-ball')) $(this).siblings('.otv_rad2').children('.v1').removeClass('dsp_n')
			if ($(this).attr('data-max') >= $(this).attr('data-ball')) $(this).siblings('.otv_rad2').children('.v2').removeClass('dsp_n')
		}
	})


















	




	// 
	// if ($(window).width() < 501) {}

	// $('.uhwa_psi2').on('click', function(e) {
	// 	e.preventDefault();
	// 	if ($(this).parents('.uhwa_cp').hasClass('uhwa_cp_act') == true) {
	// 		$(this).parents('.uhwa_cp').removeClass('uhwa_cp_act')
	// 		$(this).parents('.uhwa_cp').height(76)
	// 	} else {
	// 		$('.uhwa_cp').removeClass('uhwa_psi2_act')
	// 		$('.uhwa_cp').height(76)
	// 		$(this).parents('.uhwa_cp').addClass('uhwa_cp_act')
	// 		s = $(this).parents('.uhwa_cp').children('.uhwa_cb').children('.uhwa_i').length
	// 		$(this).parents('.uhwa_cp').height(s * 100 + 100)
	// 	}
	// })


	// $('.uhwa_i_sel').on('click', function () {
	// 	btn = $(this)
	// 	if ($(window).width() < 501) {
	// 		location.href = '/education/homework/admin/cours/list.php?id=' + btn.attr('data-cours-id') + '&lesson_id=' + btn.attr('data-lesson-id');
	// 	} else {
	// 		$.ajax({
	// 			url: "/education/homework/admin/cours/select.php?select_work",
	// 			type: "POST",
	// 			dataType: "html",
	// 			data: ({ lesson_id: btn.attr('data-lesson-id') }),
	// 			success: function(data){
	// 				$('.uhwa_c_sel').html(data)
	// 				// console.log(data)
	// 			},
	// 			beforeSend: function(){ },
	// 			error: function(data){ console.log(data) }
	// 		})
	// 	}
	// })






	// home work
	$('.btn_addu_work').on('click', function () {
		btn = $(this); txt = $('.inp_form');
		if (txt.val() == '') mess('Жазуды ұмыттыңыз')
		else {
			$.ajax({
				url: "/education/homework/get.php?add_work",
				type: "POST",
				dataType: "html",
				data: ({ 
					id: btn.attr('data-work-id'),
					txt: txt.val()
				}),
				success: function(data){ 
					if (data == 'yes') location.reload();
					console.log(data);
				},
				beforeSend: function(){ },
				error: function(data){ }
			})
		} 
	})



	// chat
	$('.btn_chat_send').on('click', function () {

		btn = $(this)
		txt = $('.inp_form')

		if (txt.val() == '') mess('Жазуды ұмыттыңыз')
		else {
			$.ajax({
				url: "/education/chat/get.php?add_chat_item",
				type: "POST",
				dataType: "html",
				data: ({ 
					id: btn.attr('data-chat-id'),
					txt: txt.val()
				}),
				success: function(data){ 
					if (data == 'yes') location.reload();
					console.log(data);
				},
				beforeSend: function(){ },
				error: function(data){ }
			})
		} 
	})












}) // end jquery