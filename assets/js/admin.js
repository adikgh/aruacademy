// start jquery
$(document).ready(function() {



	// cours add block
	$('.company_edit_pop').click(function(){
		$('.company_edit_block').addClass('pop_bl_act');
		$('#html').addClass('ovr_h');
	})
	$('.company_edit_back').click(function(){
		$('.company_edit_block').removeClass('pop_bl_act');
		$('#html').removeClass('ovr_h');
	})
	$('.btn_company_edit').click(function () {
		if ($('.company_name').val().length <= 2) mess('Атыңызды толтырыңыз')
		else {
			$.ajax({
				url: "/user/admin/get.php?company_edit",
				type: "POST",
				dataType: "html",
				data: ({
					name: $('.company_name').attr('data-val'),
					phone: $('.company_phone').attr('data-val'), phone_alt: $('.company_phone').val(),
					whatsapp: $('.company_whatsapp').attr('data-val'), whatsapp_alt: $('.company_whatsapp').val(),
					instagram: $('.company_instagram').attr('data-val'), telegram: $('.company_telegram').attr('data-val'), youtube: $('.company_youtube').attr('data-val'), 
					metrika: $('.company_metrika').attr('data-val'), pixel: $('.company_pixel').attr('data-val'),
				}),
				success: function(data){
					if (data == 'yes') {
						mess('Cәтті сақталды!')
						$('.company_edit_block').removeClass('pop_bl_act');
						setTimeout(function() { location.reload(); }, 500);
					} else console.log(data);
				},
				beforeSend: function(){ },
				error: function(data){ console.log(data) }
			})
		}
	})





	




	$('.add_lesson_b').click(function(){
		$('.lesson_add').addClass('pop_bl_act');
		$('#html').addClass('ovr_h');
	})
	$('.lesson_add_back').click(function(){
		$('.lesson_add').removeClass('pop_bl_act');
		$('#html').removeClass('ovr_h');
	})
	$('.btn_lesson_add').on('click', function(){
		var tname = $('.name')
		var cours_id = $(this).attr('data-cours-id')

		if (tname.attr('data-sel') == 1) {
			$.ajax({
				url: "/user/admin/get.php?lesson_add",
				type: "POST",
				dataType: "html",
				data: ({name: tname.attr('data-val'), cours_id: cours_id}),
				success: function(data){
					if (data == 'yes') location.reload();
					else console.log(data)
				},
				beforeSend: function(){},
				error: function(data){console.log(data)}
			})
		} else mess('Тақырыпты жазыңыз')

	})






















	// Үй жұмыстар
	$('.btn_work_yes').on('click', function(){
		btn = $(this)
		hm_id = $(this).parent().attr('data-id')
		txt = $(this).parent().siblings('.form_im').children('.inp_txt')
		$.ajax({
			url: "/user/admin/get.php?work_yes",
			type: "POST",
			dataType: "html",
			data: ({ id: hm_id, txt: txt.val() }),
			success: function(data){
				if (data == 'yes') {
					btn.parent().children('.btn').addClass('dsp_n');
					btn.after('<div class="uhwa_iby"><i class="fal fa-check"></i><span>Қабылданған</span></div>')
					txt_s = '<div class="uhwa_ib3">' + txt.val() + '</div>'
					btn.parent().after(txt_s)
					txt.parent().hide()
				} else {console.log(data)}
			},
			beforeSend: function(){},
			error: function(data){console.log(data)}
		})
	})
	$('.btn_work_none').on('click', function(){
		btn = $(this)
		hm_id = $(this).parent().attr('data-id')
		txt = $(this).parent().siblings('.form_im').children('.inp_txt')
		$.ajax({
			url: "/user/admin/get.php?work_none",
			type: "POST",
			dataType: "html",
			data: ({ id: hm_id, txt: txt.val() }),
			success: function(data){
				if (data == 'yes') {
					btn.parent().children('.btn').addClass('dsp_n');
					btn.after('<div class="uhwa_ibx"><i class="fal fa-times"></i><span>Қабылданбады</span></div>')
					txt_s = '<div class="uhwa_ib3">' + txt.val() + '</div>'
					btn.parent().after(txt_s)
					txt.parent().hide()
				} else {console.log(data)}
			},
			beforeSend: function(){},
			error: function(data){console.log(data)}
		})
	})

	








	// 
	$('.toggle_homework').click(function() { 
		if ($(this).hasClass('form_im_toggle_act') == true) $(this).children('input').attr('data-val', 'null')
		else $(this).children('input').attr('data-val', '1')
		$(this).toggleClass('form_im_toggle_act')
	});

	// 
	$('.item_ava_clc').click(function(){ $(this).siblings('.item_file').click() })
	$(".item_file").change(function(){
		tfile = $(this)
		if (window.FormData === undefined) mess('Бұл формат келмейді')
		else {
			var formData = new FormData();
			formData.append('file', $(this)[0].files[0]);
			$.ajax({
				type: "POST",
				url: "/user/admin/get.php?add_item_photo",
				cache: false,
				contentType: false,
				processData: false,
				dataType: 'json',
				data: formData,
				success: function(msg){
					if (msg.error == '') {
						tfile_n = 'url(/assets/img/cours/'+msg.file+')'
						tfile.attr('data-val', msg.file)
						tfile.siblings('.upl_logo_img').removeClass('upl_logo_img2')
						tfile.siblings('.upl_logo_img').css('background-image', tfile_n)
						tfile.siblings('.upl_logo_c').html('Фото жаңарту')
					} else mess(msg.error)
				},
				beforeSend: function(){},
				error: function(msg){console.log(msg)}
			});
		}
	});

	$('.btn_item_add').click(function () { 
		this_btn = $(this)
		n_name = $('.name')
		price = $('.price')
		price_sole = $('.price_sole')
		category = $('.category')
		autor = $('.autor')
		homework = $('.homework')
		n_img = $('.file')

		if (n_name.attr('data-sel') != 1) mess('Форманы толтырыңыз')
		else {
			$.ajax({
				url: "/user/admin/get.php?item_add",
				type: "POST",
				dataType: "html",
				data: ({
					n_name: n_name.attr('data-val'),
					price: price.attr('data-val'),
					price_sole: price_sole.attr('data-val'),
					category: category.attr('data-val'),
					autor: autor.attr('data-val'),
					homework: homework.attr('data-val'),
					n_img: n_img.attr('data-val'),
				}),
				success: function(data){
					if (data == 'plus') $(location).attr('href', '/u/c/');
					else console.log(data)
				},
				beforeSend: function(){},
				error: function(data){console.log(data)}
			})
		}
	})

	// 
	$('.btn_pack_add').click(function () { 
		tbtn = $(this)
		n_name = $('.name')
		price = $('.price')
		price_sole = $('.price_sole')
		homework = $('.homework')
		curl = '/u/i/?id='+tbtn.attr('data-cours-id')

		if (n_name.attr('data-sel') != 1) mess('Форманы толтырыңыз')
		else {
			$.ajax({
				url: "/user/admin/get.php?pack_add",
				type: "POST",
				dataType: "html",
				data: ({
					name: n_name.attr('data-val'),
					price: price.attr('data-val'),
					price_sole: price_sole.attr('data-val'),
					cours_id: tbtn.attr('data-cours-id'),
					homework: homework.attr('data-val'),
				}),
				success: function(data){
					if (data == 'plus') $(location).attr('href', curl);
					else console.log(data)
				},
				beforeSend: function(){},
				error: function(data){console.log(data)}
			})
		}
	})



	$('.uhwa_bcacci').click(function () { 
		if ($(this).hasClass('uhwa_bcacci_act') == true) {
			$(this).removeClass('uhwa_bcacci_act')
			$(this).parent().attr('data-val', '')
		} else {
			$(this).parent().children('.uhwa_bcacci').removeClass('uhwa_bcacci_act')
			$(this).addClass('uhwa_bcacci_act')
			$(this).parent().attr('data-val', $(this).attr('data-val'))
		}
	})



	$('.filter_btn').click(function () { 
		$('.uhwa_bca').addClass('uhwa_bca_act')
	})
	$('.uhwa_bca_back').click(function () { 
		$('.uhwa_bca').removeClass('uhwa_bca_act')
	})
	$('.filter_awork').click(function () {
		tbtn = $(this)
		id = tbtn.attr('data-cours-id')
		pack_id = $('.pack').attr('data-val')
		answer = $('.status').attr('data-val')
		
		if (pack_id != '') url = '/user/item/ahomework.php?id=' + id + '&pack_id=' + pack_id
		if (answer != '') url = '/user/item/ahomework.php?id=' + id + '&answer=' + answer
		if (answer != '' && pack_id != '') url = '/user/item/ahomework.php?id=' + id + '&pack_id=' + pack_id + '&answer=' + answer
		
		$(location).attr('href', url);
	})























	// home work
	$('.btn_add_work').on('click', function () {

		btn = $(this)
		txt = $('.inp_form')

		if (txt.val() == '') mess('Жазуды ұмыттыңыз')
		else {
			$.ajax({
				url: "/user/homework/admin/get.php?add_work",
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
	$('.btn_chata_send').on('click', function () {

		btn = $(this)
		txt = $('.inp_form')

		if (txt.val() == '') mess('Жазуды ұмыттыңыз')
		else {
			$.ajax({
				url: "/user/chat/admin/get.php?add_chat_item",
				type: "POST",
				dataType: "html",
				data: ({ 
					id: btn.attr('data-chat-id'),
					u_id: btn.attr('data-user-id'),
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











	// add user
	$('.chat_all_pop_open').click(function(){
		$('.chat_all_pop').addClass('pop_bl_act');
		$('#html').addClass('ovr_h');
	})
	$('.chat_all_pop_back').click(function(){
		$('.chat_all_pop').removeClass('pop_bl_act');
		$('#html').removeClass('ovr_h');
	})
	$('.btn_chat_all_pop').on('click', function() {
		btn = $(this); txt = $('.inp_form2');
		if (txt.val() == '') mess('Жазуды ұмыттыңыз')
		else {
			$.ajax({
				url: "/user/chat/admin/get.php?add_chat_all",
				type: "POST",
				dataType: "html",
				data: ({ 
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


	







	$('.clc_btnq').on('click', function() { 
		$.ajax({
			url: "/user/homework/admin/get.php?send_statistic",
			type: "POST",
			dataType: "html",
			data: ({ 
				id: $('.clc_btnq').attr('data-id'),
			}),
			success: function(data){ 
				if (data == 'yes') mess('Телеграмга жіберілді')
				console.log(data);
			},
			beforeSend: function(){ },
			error: function(data){ }
		})
	})






















}) // end jquery