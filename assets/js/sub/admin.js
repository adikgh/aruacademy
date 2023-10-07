// start jquery
$(document).ready(function() {


	// 
	$('.add_user_sub_send').on('click', function(){
		var phone = $('.phone')
		var mail = $('.mail')

		if (phone.attr('data-sel') == 1) {
			$.ajax({
				url: "/user/sub/users/get.php?add_user",
				type: "POST",
				dataType: "html",
				data: ({phone: phone.attr('data-val')}),
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
				url: "/user/sub/users/get.php?add_umail",
				type: "POST",
				dataType: "html",
				data: ({mail: mail.attr('data-val')}),
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


	// sms send
	$('.html').on('.sub_sms_send', 'click', function(){
		var id = $(this).attr('data-id')
		$.ajax({
			url: "/user/sub/users/get.php?sms_send",
			type: "POST",
			dataType: "html",
			data: ({ id:id }),
			success: function(data){
				if (data == 'yes') mess('CMC жиберілді')
				else console.log(data)
			},
			beforeSend: function(){ },
			error: function(data){ console.log(data) }
		})
	})

	// user del
	$('html').on('click', '.sub_user_del', function(){
		var id = $(this).attr('data-id')
		var btn = $(this)
		$.ajax({
			url: "/user/sub/users/get.php?user_del",
			type: "POST",
			dataType: "html",
			data: ({ id:id }),
			success: function(data){
				if (data == 'yes') {
					mess('Өшірілді')
					btn.parent().parent().parent().remove()
				} else console.log(data)
			},
			beforeSend: function(){ },
			error: function(data){ console.log(data) }
		})
	})


	// user del
	$('html').on('click', '.sub_buy_off', function(){
		var id = $(this).attr('data-id')
		var btn = $(this)
		if (btn.hasClass('form_im_toggle_act') == false) {
			off = 0
			btn.addClass('form_im_toggle_act')
			mess('Доступ ашылда')
		} else {
			off = 1
			btn.removeClass('form_im_toggle_act')
			mess('Доступ алынып кетті')
		}
		$.ajax({
			url: "/user/sub/users/get.php?buy_off",
			type: "POST",
			dataType: "html",
			data: ({ id:id, off:off }),
			success: function(data){
				console.log(data)
			},
			beforeSend: function(){ },
			error: function(data){ console.log(data) }
		})
	})












	// sms send all
   $('.sms_send_all').on('click', function(){
   	$.ajax({
   		url: "/user/sub/users/get.php?sms_send_all",
   		type: "POST",
   		dataType: "html",
   		data: ({}),
   		success: function(data){
   			if (data == 'yes') mess('Барлыгына толық жиберілді')
   			else console.log(data)
   		},
   		beforeSend: function(){ },
			// mess('Жіберілуде')
   		error: function(data){ console.log(data) }
   	})
   })







	






}) // end jquery