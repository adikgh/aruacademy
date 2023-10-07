// start jquery
$(document).ready(function() {

   // cours add block
	$('.cours_add_pop').click(function(){
		$('.cours_add_block').addClass('pop_bl_act');
		$('#html').addClass('ovr_h');
	})
	$('.cours_add_back').click(function(){
		$('.cours_add_block').removeClass('pop_bl_act');
		$('#html').removeClass('ovr_h');
	})

	// 
	$('.cours_img_add').click(function(){ $(this).siblings('.cours_img').click() })
	$(".cours_img").change(function(){
		tfile = $(this)
		if (window.FormData === undefined) mess('Бұл формат келмейді')
		else {
			var formData = new FormData();
			formData.append('file', $(this)[0].files[0]);
			$.ajax({
				type: "POST",
				url: "/education/course/admin/get.php?add_item_photo",
				cache: false, contentType: false,
				processData: false, dataType: 'json',
				data: formData,
				success: function(msg){
					if (msg.error == '') {
						tfile_n = 'url(/assets/img/cours/' + msg.file + ')'
						tfile.attr('data-val', msg.file)
						tfile.siblings('.cours_img_add').addClass('form_im_img2')
						tfile.siblings('.cours_img_add').css('background-image', tfile_n)
					} else mess(msg.error)
				},
				beforeSend: function(){ },
				error: function(msg){ console.log(msg) }
			});
		}
	});

	// 
	$('.prs_clc').on('click', function() {
		btn = $(this).parents('.prs_block')
		if ($(this).hasClass('form_im_toggle_act') == true) {
			btn.addClass('prs_block_act')
			btn.height(btn.children('.prs_blockc').height() + 54);
		} else {
			btn.height(34);
			btn.removeClass('prs_block_act')
		}
	});

	// 
	$('.btn_item_add').click(function () { 
		if ($('.cours_name').attr('data-sel') != 1) mess('Форманы толтырыңыз')
		else {
			$.ajax({
				url: "/education/course/admin/get.php?item_add",
				type: "POST",
				dataType: "html",
				data: ({
					name: $('.cours_name').attr('data-val'), access: $('.cours_access').data('val'),
					autor: $('.cours_autor').data('val'), img: $('.cours_img').attr('data-val'),
					price: $('.cours_price').data('val'), price_sole: $('.cours_price_sole').data('val'),
					item: $('.cours_item').data('val'), assig: $('.cours_assig').data('val'),
				}),
				success: function(data){
					if (data == 'plus') location.reload();
					else console.log(data)
				},
				beforeSend: function(){ },
				error: function(data){ console.log(data) }
			})
		}
	})
	




	
	// cours add block
	$('.cours_edit_pop').click(function(){
		$('.cours_edit_block').addClass('pop_bl_act');
		$('#html').addClass('ovr_h');
	})
	$('.cours_edit_back').click(function(){
		$('.cours_edit_block').removeClass('pop_bl_act');
		$('#html').removeClass('ovr_h');
	})
	$('.btn_cours_edit').click(function () { 
		$.ajax({
			url: "/education/course/admin/get.php?item_edit",
			type: "POST",
			dataType: "html",
			data: ({
				id: $('.btn_cours_edit').data('cours-id'),
				name: $('.cours_name').data('val'), access: $('.cours_access').data('val'),
				autor: $('.cours_autor').data('val'), img: $('.cours_img').data('val'),
				price: $('.cours_price').data('val'), price_sole: $('.cours_price_sole').data('val'),
				item: $('.cours_item').data('val'), assig: $('.cours_assig').data('val'),
			}),
			success: function(data){
				if (data == 'plus') location.reload();
				else console.log(data)
			},
			beforeSend: function(){ },
			error: function(data){ console.log(data) }
		})
	})























	// 
	$('.cours_arh').click(function () {
		$.ajax({
			url: "/education/course/admin/get.php?cours_arh",
			type: "POST",
			dataType: "html",
			data: ({ id: $('.cours_arh').data('id'), }),
			success: function(data){
				if (data == 'yes') location.reload();
				else console.log(data)
			},
			beforeSend: function(){ },
			error: function(data){ console.log(data) }
		})
	})
	// 
	$('.cours_del').click(function () {
		$.ajax({
			url: "/education/course/admin/get.php?cours_del",
			type: "POST",
			dataType: "html",
			data: ({ id: $('.cours_del').data('id'), }),
			success: function(data){
				if (data == 'yes') $(location).attr('href', '/user/cours/');
				else console.log(data)
			},
			beforeSend: function(){ },
			error: function(data){ console.log(data) }
		})
	})



















	// add_block_b
	$('.add_block_b').click(function(){
		$('.block_add').addClass('pop_bl_act');
		$('#html').addClass('ovr_h');
	})
	$('.block_add_back').click(function(){
		$('.block_add').removeClass('pop_bl_act');
		$('#html').removeClass('ovr_h');
	})
	$('.btn_block_add').on('click', function(){
		if ($('.block_name').attr('data-sel') != 1) mess('Тақырыпты жазыңыз')
		else {
			$.ajax({
				url: "/education/course/admin/get.php?block_add",
				type: "POST",
				dataType: "html",
				data: ({
					name: $('.block_name').attr('data-val'),
					cours_id: $('.btn_block_add').data('cours-id'),
					item: $('.block_item').data('val'), assig: $('.block_assig').data('val'),
				}),
				success: function(data){
					if (data == 'yes') location.reload();
					else console.log(data)
				},
				beforeSend: function(){ },
				error: function(data){ console.log(data) }
			})
		} 
	})


	// // add_lesson_b
	// $('.add_lesson_b').click(function(){
	// 	$('.lesson_add').addClass('pop_bl_act');
	// 	$('#html').addClass('ovr_h');
	// 	if ($(this).attr('data-block-id')) $('.btn_lesson_add').attr('data-block-id', $(this).attr('data-block-id'))
	// })
	// $('.lesson_add_back').click(function(){
	// 	$('.lesson_add').removeClass('pop_bl_act');
	// 	$('#html').removeClass('ovr_h');
	// 	$('.btn_lesson_add').attr('data-block-id', '')
	// })
	// $('.lesson1_clc').click(function() { $('.lesson1_block').toggleClass('lesson1_block_act') });

	// $('.btn_lesson_add').on('click', function(){
	// 	if ($('.lesson_name').attr('data-sel') != 1) mess('Тақырыпты жазыңыз')
	// 	else {
	// 		$.ajax({
	// 			url: "/admin/course/get.php?lesson_add",
	// 			type: "POST",
	// 			dataType: "html",
	// 			data: ({
	// 				name: $('.lesson_name').attr('data-val'),
	// 				cours_id: $('.btn_lesson_add').data('cours-id'),
	// 				block_id: $('.btn_lesson_add').data('block-id'),
	// 				open: $('.lesson_open').attr('data-val'),
	// 				youtube: $('.lesson_youtube').attr('data-val'),
	// 				txt: $('.lesson_txt').val(),
	// 			}),
	// 			success: function(data){
	// 				if (data == 'yes') location.reload();
	// 				else console.log(data)
	// 			},
	// 			beforeSend: function(){},
	// 			error: function(data){console.log(data)}
	// 		})
	// 	}
	// })














	// menu sk
	$('.coursls_il2m').on('click', function () {
		if ($(this).siblings('.menu_c').hasClass('menu_act') == true) {
			$('.coursls_il2 .menu_c').removeClass('menu_act')
		} else {
			$('.coursls_il2 .menu_c').removeClass('menu_act')
			$(this).siblings('.menu_c').addClass('menu_act')
		}
	})

	// copy_block_b
	$('.copy_block_b').click(function(){
		$('.block_copy').addClass('pop_bl_act')
		$('#html').addClass('ovr_h')
		$('.block_copy .btn_block_copy').attr('data-block', $(this).parents('.coursls_b').attr('data-id'))
	})
	$('.block_copy_back').click(function(){
		$('.block_copy').removeClass('pop_bl_act');
		$('#html').removeClass('ovr_h');
	})
	$('.btn_block_copy').on('click', function(){
		$.ajax({
			url: "/education/course/admin/get.php?block_copy",
			type: "POST",
			dataType: "html",
			data: ({
				block: $('.btn_block_copy').attr('data-block'),
				copy_block: $('.block_cp_all').attr('data-val'),
			}),
			beforeSend: function(){ },
			error: function(data){ console.log(data) },
			success: function(data){
				if (data == 'yes') location.reload();
				else console.log(data)
			},
		})
	})



	// copy_block_b
	$('.cours_copy_pop').click(function(){
		$('.cours_copy').addClass('pop_bl_act')
		$('#html').addClass('ovr_h')
	})
	$('.cours_copy_back').click(function(){
		$('.cours_copy').removeClass('pop_bl_act');
		$('#html').removeClass('ovr_h');
	})
	$('.btn_cours_copy').on('click', function(){
		$.ajax({
			url: "/education/course/admin/get.php?cours_copy",
			type: "POST",
			dataType: "html",
			data: ({
				course: $('.btn_cours_copy').attr('data-course'),
				copy_course: $('.course_cp_all').attr('data-val'),
			}),
			beforeSend: function(){ },
			error: function(data){ console.log(data) },
			success: function(data){
				if (data == 'yes') location.reload();
				else console.log(data)
			},
		})
	})





	// add_lesson_b
	$('.add_lesson_b').click(function(){
		$('.lesson_add').addClass('pop_bl_act');
		$('#html').addClass('ovr_h');
		if ($(this).attr('data-id')) $('.btn_lesson_add').attr('data-block-id', $(this).attr('data-id'))
	})
	$('.lesson_add_back').click(function(){
		$('.lesson_add').removeClass('pop_bl_act');
		$('#html').removeClass('ovr_h');
		$('.btn_lesson_add').attr('data-block-id', '')
	})
	$('.lesson1_clc').click(function() { $('.lesson1_block').toggleClass('lesson1_block_act') });

	$('.btn_lesson_add').on('click', function(){
		if ($('.lesson_name').attr('data-sel') != 1) mess('Атауын жазыңыз')
		else {
			$.ajax({
				url: "/education/course/admin/get.php?lesson_add",
				type: "POST",
				dataType: "html",
				data: ({
					name: $('.lesson_name').attr('data-val'),
					course_id: $('.btn_lesson_add').data('cours-id'),
					block_id: $('.btn_lesson_add').data('block-id'),
					open: $('.lesson_open').attr('data-val'),
					youtube: $('.lesson_youtube').attr('data-val'),
					txt: $('.lesson_txt').val(),
				}),
				success: function(data){
					if (data == 'yes') location.reload();
					else console.log(data)
				},
				beforeSend: function(){},
				error: function(data){console.log(data)}
			})
		}
	})
	

















	// 
	// $('.btn_item_add').click(function () { 
	// 	this_btn = $(this)
	// 	n_name = $('.name')
	// 	price = $('.price')
	// 	price_sole = $('.price_sole')
	// 	category = $('.category')
	// 	autor = $('.autor')
	// 	homework = $('.homework')
	// 	n_img = $('.file')

	// 	if (n_name.attr('data-sel') != 1) mess('Форманы толтырыңыз')
	// 	else {
	// 		$.ajax({
	// 			url: "/education/course/admin/get.php?item_add",
	// 			type: "POST",
	// 			dataType: "html",
	// 			data: ({
	// 				n_name: n_name.attr('data-val'),
	// 				price: price.attr('data-val'),
	// 				price_sole: price_sole.attr('data-val'),
	// 				category: category.attr('data-val'),
	// 				autor: autor.attr('data-val'),
	// 				homework: homework.attr('data-val'),
	// 				n_img: n_img.attr('data-val'),
	// 			}),
	// 			success: function(data){
	// 				if (data == 'plus') $(location).attr('href', '/u/c/');
	// 				else console.log(data)
	// 			},
	// 			beforeSend: function(){},
	// 			error: function(data){console.log(data)}
	// 		})
	// 	}
	// })






}) // end jquery