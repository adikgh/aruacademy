	// lazy img
	$(function() {
        $('.lazy').lazy({
          effect: "fadeIn",
          effectTime: 300,
          threshold: 0
        })
    })

    

	// на внизу
	$('.na_vniz').on('click', function() {
	    $('body,html').animate({
	        scrollTop: $(window).height() - 20
	    }, 500)
	})




// alert(window.location.href);
// alert(window.location.hash);
// 

// $('.callback-bt').click(function(){
// 	location.href = 'tel:87007209292';
// })
// $('.callback-btw').click(function(){
// 	location.href = 'https://wa.me/77007209292?text=Я%20заинтересован%20по%20поводу%20санаторий%20...';
// })







const circle = document.querySelector('.progress_ring_c');
const radius = circle.r.baseVal.value;
const circumference = 2 * Math.PI * radius;

circle.style.strokeDasharray = `${circumference} ${circumference}`;
circle.style.strokeDashoffset = circumference;

const offset = circumference - 45 / 100 * circumference;
circle.style.strokeDashoffset = offset;

// function setProgress(percent) { 
// 	const offset = circumference - percent / 100 * circumference;
// 	circle.style.strokeDashoffset = offset;
// }
// setProgress(15);




	// Блок косу
	$('.btn_block_plus').on('click', function(){
		$('.spl_block_plus').removeClass('dsp_n');
		$('.spl_block_plus').attr('data-cours', $(this).attr('data-cours'));
		$('.spl_block_plus').attr('data-number', $(this).attr('data-number'));
	})	
	$('.zak_block_plus').on('click', function(){
		$('.spl_block_plus').addClass('dsp_n');
	})

	$('.btn_block_save').on('click', function(){
		var name = $(this).parent().siblings('.spl_con').children().children('.name')
		var cours_id = $('.spl_block_plus').attr('data-cours')
		var number = $('.spl_block_plus').attr('data-number')
		if (name.val().length != 0) {
			$.ajax({
				url: "/panel/cours/get.php?block_plus",
				type: "POST",
				dataType: "html",
				data: ({name: name.val(), cours_id: cours_id, number: number}),
				success: function(data){
					if (data == 'yes') {
						location.reload();
					} else {console.log(data)}
				},
				beforeSend: function(){},
				error: function(data){console.log(data)}
			})
		}
	})


	// Сабақ қосу
	$('.btn_sab_plus').on('click', function(){
		$('.spl_sab_plus').removeClass('dsp_n');
		$('.spl_sab_plus').attr('data-cours', $(this).attr('data-cours'));
		$('.spl_sab_plus').attr('data-block', $(this).attr('data-block'));
		$('.spl_sab_plus').attr('data-number', $(this).attr('data-number'));
	})	
	$('.zak_sab_plus').on('click', function(){
		$('.spl_sab_plus').addClass('dsp_n');
	})

	$('.btn_sab_save').on('click', function(){
		var name = $(this).parent().siblings('.spl_con').children().children('.name')
		var cours_id = $('.spl_sab_plus').attr('data-cours')
		var block_id = $('.spl_sab_plus').attr('data-block')
		var number = $('.spl_sab_plus').attr('data-number')
		if (name.val().length != 0) {
			$.ajax({
				url: "/panel/cours/get.php?item_plus",
				type: "POST",
				dataType: "html",
				data: ({name: name.val(), cours_id: cours_id, block_id: block_id, number: number}),
				success: function(data){
					if (data == 'yes') {
						location.reload();
					} else {console.log(data)}
				},
				beforeSend: function(){},
				error: function(data){console.log(data)}
			})
		}
	})






	// 
	$('.btn_student_save2').on('click', function(){
		var phone = $(this).parent().siblings('.spl_con').children().children('.phone')
		var cours_id = phone.attr('data-cours')
		if (phone.attr('data-sel') == 1) {
			$.ajax({
				url: "/cours/get.php?student_plus2",
				type: "POST",
				dataType: "html",
				data: ({phone: phone.attr('data-val'), cours_id: cours_id}),
				success: function(data){
					if (data == 'plus') {
						location.reload();
					} else if (data == 'yes') {
						alert('Бұл адамда уже доступ бар')
					} else {console.log(data)}
				},
				beforeSend: function(){},
				error: function(data){console.log(data)}
			})
		}
	})





	// Студент доступ
	$('.coursls_st_sn').on('click', function(){
		$('.spl_student_dost').removeClass('dsp_n');
		$('.spl_student_dost').attr('data-user', $(this).attr('data-user'));
	})	
	$('.zak_student_dost').on('click', function(){
		$('.spl_student_dost').addClass('dsp_n');
	})

	$('.btn_student_dost').on('click', function(){
		var dost = $(this).parent().siblings('.spl_con').children().children('.dost')
		var cours_id = $('.spl_student_dost').attr('data-cours')
		var user_id = $('.spl_student_dost').attr('data-user')

		$.ajax({
			url: "/cours/get.php?student_dost",
			type: "POST",
			dataType: "html",
			data: ({status_id: dost.val(), cours_id: cours_id, user_id: user_id}),
			success: function(data){
				if (data == 'yes') {
					location.reload();
				} else {console.log(data)}
			},
			beforeSend: function(){},
			error: function(data){console.log(data)}
		})
	})


	// Видео қосу
	$('.btn_video_plus').on('click', function(){
		$('.spl_video_plus').removeClass('dsp_n');
		$('.spl_video_plus').attr('data-item', $(this).attr('data-item'));
	})	
	$('.zak_video_plus').on('click', function(){
		$('.spl_video_plus').addClass('dsp_n');
	})

	$('.btn_video_save').on('click', function(){
		var video = $(this).parent().siblings('.spl_con').children().children('.video')
		var item_id = $('.spl_video_plus').attr('data-item')
		$.ajax({
			url: "/cours/get.php?video_plus",
			type: "POST",
			dataType: "html",
			data: ({video: video.attr('data-val'), item_id: item_id}),
			success: function(data){
				if (data == 'plus') {
					location.reload();
				} else {console.log(data)}
			},
			beforeSend: function(){},
			error: function(data){console.log(data)}
		})
	})




	
	// $('.code_ret').on('click', function() {
	// 	var phone = $('.phone').attr('data-val');
	// 	$.ajax({
	// 		url: "/user/get.php?rest",
	// 		type: "POST",
	// 		dataType: "html",
	// 		data: ({phone: phone}),
	// 		success: function(data){
	// 			if (data == 'yes') {
	// 				$('.lg_top_head p').html($('.lg_top_head p').attr('data-code-reg'))
	// 				$('.num_1').focus()
	// 				time_rest($('.code_ret'))
	// 			} else {console.log(data)}
	// 		},
	// 		beforeSend: function(){},
	// 		error: function(data){console.log(data)}
	// 	})
	// })


	// $('.btn_fback').on('click', function() {
	// 	if ($(this).parent().attr('data-type') == 'aut2') {
	// 		$('.btn_fdal').parent().removeClass('form_btn_flex')
	// 		$('.btn_fback').addClass('dsp_n')
	// 		$('.form_cn_code').parent().addClass('dsp_n')
	// 		$('.phone').parent().removeClass('dsp_n')
	// 		$('.btn_fdal').children('span').html($('.btn_fdal').attr('data-aut'))
	// 		$('.btn_fdal').parent().attr('data-type', 'aut')
	// 		$('.code_ret').parent().addClass('dsp_n')
	// 		$('.code').val('');
	// 	} else if ($(this).parent().attr('data-type') == 'reg_code') {
	// 		$('.name').parent().addClass('dsp_n')
	// 		$('.name').val('')
	// 		$('.phone').parent().removeClass('dsp_n')
	// 		$('.btn_fdal').parent().removeClass('form_btn_flex')
	// 		$('.btn_fdal').children('span').html($('.btn_fdal').attr('data-aut'))
	// 		$('.btn_fdal').parent().attr('data-type', 'aut')
	// 		$('.modal_head h4').html($('.modal_head h4').attr('data-aut'))
	// 		$('.btn_fback').addClass('dsp_n')
	// 		$('.form_cn_ch').addClass('dsp_n')
	// 	} else if ($(this).parent().attr('data-type') == 'reg') {
	// 		$('.code').val('');
	// 		$('.code').parent().addClass('dsp_n')
	// 		$('.name').parent().removeClass('dsp_n')			
	// 		$('.code_ret').parent().addClass('dsp_n')
	// 		$('.btn_fdal').children('span').html($('.btn_fdal').attr('data-code'))
	// 		$('.btn_fdal').parent().attr('data-type', 'reg_code')
	// 	}
	// })


	// function time_rest(i) {
	// 	var time = 60;
	// 	var rs = setInterval(function() {
	// 			time -= 1 
	// 		i.html(time)
	// 		if (time == 0) {
	// 			i.html(i.attr('data-code'))
	// 			clearInterval(rs)
	// 		}
	// 	}, 1000)
	// }