// start jquery
$(document).ready(function() {



   // add user
	$('.add_user_btn').click(function(){
		$('.add_user').addClass('pop_bl_act');
		$('#html').addClass('ovr_h');
	})
	$('.add_user_back').click(function(){
		$('.add_user').removeClass('pop_bl_act');
		$('#html').removeClass('ovr_h');
	})

	// 
	$('.form_im_btn_i').click(function(){
		if ($('.cn_mail').hasClass('dsp_n') == true) {
			$('.cn_mail').removeClass('dsp_n')
			$('.cn_phone').addClass('dsp_n')
		} else {
			$('.cn_mail').addClass('dsp_n')
			$('.cn_phone').removeClass('dsp_n')
		}
		$('.form_im_btn_i').toggleClass('form_im_btn_act');
	})

	// 
	$('.pack_each').each(function(){
		$(this).parent().siblings('.pack').attr('data-val', $(this).attr('data-val'))
		$(this).parent().siblings('.pack').html($(this).html())
	})

	



	











	// set user
	$('html').on('click', '.uc_uibo', function() {
		if ($(window).width() > 500) {
			if ($(this).parent().hasClass("uc_uibs_act")	!= true) {
				$('.uc_uibo').parent().removeClass("uc_uibs_act");
				$(this).parent().addClass("uc_uibs_act");
			} else $('.uc_uibo').parent().removeClass("uc_uibs_act");
		} else {
			$('.set_user').addClass('pop_bl_act')
		   $('#html').addClass('ovr_h');
			$('.set_user').attr('data-id', $(this).parents('.sel_id').data('id'))
			$('.set_user').attr('data-pass', $(this).parents('.sel_id').data('pass'))
		}
	})
	$('html').on('click', '.set_user_back', function(){
		$('.set_user').removeClass('pop_bl_act');
		$('#html').removeClass('ovr_h');
	})


	// view pass
	$('html').on('click', '.copy_pass', function() {
      copytext('Пароль: ' + $(this).parents('.sel_id').data('pass'))
      $('.set_user').removeClass('pop_bl_act');
		$('#html').removeClass('ovr_h');
	})




   
	// 
	$('html').on('click', '.pass_ress', function() {
		btn = $(this)
		$.ajax({
			url: "/user/admin/get.php?pass_ress",
			type: "POST",
			dataType: "html",
			data: ({ id: btn.attr('data-id') }),
			success: function(data){
				if (data == 'yes') {
					copytext('Cіздің логин: ' + btn.attr('data-login') + ' Пароль: 123456')
				} else {console.log(data)}
			},
			beforeSend: function(){},
			error: function(data){console.log(data)}
		})
	})























	// search
	$('.user_search_in').on('input', function () { 
		$.ajax({
			url: "/user/admin/users/search.php?user_search",
			type: "POST",
			dataType: "html",
			data: ({ search: $('.user_search_in').val() }),
			success: function(data){
				$('.uc_uc').html(data)
				$('.fr_phone').mask('8 (000) 000-00-00');
				$('.lazy_img').lazy({effect:"fadeIn",effectTime:300,threshold:0})
				// console.log(data)
			},
			beforeSend: function(){ },
			error: function(data){ console.log(data) }
		})
	})
	// cours user_search_in
	$('.cours_user_search_in').on('input', function () {
		inp = $('.cours_user_search_in')
		$.ajax({
			url: "/user/cours/item/users/search.php?user_search",
			type: "POST",
			dataType: "html",
			data: ({ 
				search: inp.val(),
				cours_id: inp.attr('data-cours-id')
			}),
			success: function(data){
				$('.uc_uc').html(data)
				// console.log(data)
			},
			beforeSend: function(){ },
			error: function(data){ console.log(data) }
		})
	})
	// cours user_search_in
	$('.sub_user_search_in').on('input', function () {
		inp = $('.sub_user_search_in')
		$.ajax({
			url: "/user/sub/users/search.php?user_search",
			type: "POST",
			dataType: "html",
			data: ({ search: inp.val() }),
			success: function(data){
				$('.uc_uc').html(data)
				// console.log(data)
			},
			beforeSend: function(){ },
			error: function(data){ console.log(data) }
		})
	})










   /* cours users */

   // user del
   $('html').on('click', '.user_del', function(){
      btn = $(this)
      id = btn.parents('.sel_id').data('id')
      $.ajax({
         url: "/user/cours/item/users/get.php?user_del",
         type: "POST",
         dataType: "html",
         data: ({ id:id }),
         success: function(data){
            if (data == 'yes') {
               if ($(window).width() < 501) location.reload()
               else btn.parents('.uc_ui').remove()
               mess('Өшірілді')
            }
            console.log(data)
         },
         beforeSend: function(){ },
         error: function(data){ console.log(data) }
      })
   })


   // 
   $('.add_user_send').on('click', function(){
      var phone = $('.phone')
      var mail = $('.mail')
      var cours_id = $(this).attr('data-cours-id')
      var pack_id = $('.pack').attr('data-val')

      if (phone.attr('data-sel') == 1) {
         $.ajax({
            url: "/user/cours/item/users/get.php?add_user",
            type: "POST",
            dataType: "html",
            data: ({
               phone : phone.attr('data-val'),
               cours_id : cours_id,
               pack_id : pack_id,
               cours_sms_send :  $('.cours_sms_send').data('val'),
            }),
            success: function(data){
               if (data == 'add') location.reload();
               else if (data == 'yes') mess('Бұл адамда уже доступ бар')
               else console.log(data)
            },
            beforeSend: function(){},
            error: function(data){console.log(data)}
         })
      } else if (mail.attr('data-sel') == 1) {
         $.ajax({
            url: "/user/cours/item/users/get.php?add_umail",
            type: "POST",
            dataType: "html",
            data: ({
               mail : mail.attr('data-val'),
               cours_id : cours_id,
               pack_id : pack_id,
            }),
            success: function(data){
               if (data == 'add') location.reload();
               else if (data == 'yes') mess('Бұл адамда уже доступ бар')
               else console.log(data)
            },
            beforeSend: function(){},
            error: function(data){console.log(data)}
         })
      } else mess('Оқушының номерін жазыңыз')
   })


   






   // sms send all
   // $('.sms_send_all').on('click', function(){
   // 	var cours_id = $(this).attr('data-cours-id')
   // 	$.ajax({
   // 		url: "/user/admin/get.php?sms_send_all",
   // 		type: "POST",
   // 		dataType: "html",
   // 		data: ({cours_id: cours_id}),
   // 		success: function(data){
   // 			if (data == 'yes') {
   // 				mess('Барлыгына толық жиберілді')
   // 			} else {console.log(data)}
   // 		},
   // 		beforeSend: function(){
   // 			mess('Жіберілуде')
   // 		},
   // 		error: function(data){console.log(data)}
   // 	})
   // })



   // sms send
   $('.sms_send').on('click', function(){
      var id = $(this).attr('data-id')
      $.ajax({
         url: "/user/admin/get.php?sms_send",
         type: "POST",
         dataType: "html",
         data: ({id:id}),
         success: function(data){
            if (data == 'yes') {
               mess('CMC жиберілді')
            } else {console.log(data)}
         },
         beforeSend: function(){
            mess('Жіберілуде')
         },
         error: function(data){console.log(data)}
      })
   })

	






}) // end jquery