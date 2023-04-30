// start jquery
$(document).ready(function() {


	// 
	$('.rad3').on('click', function () {
		
      // 
      if ($(this).parent().attr('data-sel') != 1) {
			$('.sw_tb').attr('data-ball', Number($('.sw_tb').attr('data-ball')) + Number($(this).attr('data-ball')))
			$('.sw_tb').attr('data-ball-end', $(this).attr('data-ball'))
			$('.sw_tb').attr('data-n', Number($('.sw_tb').attr('data-n')) + 1)
		} else {
			$('.sw_tb').attr('data-ball', Number($('.sw_tb').attr('data-ball')) + Number($(this).attr('data-ball')) - Number($('.sw_tb').attr('data-ball-end')))
			$('.sw_tb').attr('data-ball-end', $(this).attr('data-ball'))
		}

      // 
		$(this).parent().children('.rad3').removeClass('form_radio_act form_radio_true')
		$(this).addClass('form_radio_act form_radio_true')
		$(this).parent().attr('data-sel', 1)
		$('.sw_tb').removeClass('swiper-button-disabled')


      // 
		v = $(this).attr('data-ball')
      ball = $('.sw_tb').attr('data-ball')
		n = $(this).parent().attr('data-test-number')
		test_answer_id = $(this).parent().attr('data-test-answer-id')
		test_item_id = $(this).parent().attr('data-test-item-id')
		$.ajax({
			url: "/education/course/tk/get.php?test_answer_tk1",
			type: "POST",
			dataType: "html",
			data: ({
				v: v, n: n, ball: ball,
				test_answer_id: test_answer_id,
				test_item_id: test_item_id,
			}),
			success: function(data){
            console.log(data);
         },
			beforeSend: function(){ },
			error: function(data){ }
		})
	})


	$('.sw_tb').on('click', function () {
		if ($(this).attr('data-number') == $(this).attr('data-n')) {
			$('.otv_rad3').removeClass('dsp_n')
			if (10 >= $(this).attr('data-ball')) $('.otv_rad3').children('.v1').removeClass('dsp_n')
			else if (11 <= $(this).attr('data-ball') && 22 >= $(this).attr('data-ball')) $('.otv_rad3').children('.v2').removeClass('dsp_n')
			else if (23 <= $(this).attr('data-ball')) $('.otv_rad3').children('.v3').removeClass('dsp_n')
		}
	})


	var kt_t1 = new Swiper(".kt_t1", {
		slidesPerView: 1,
		effect: "creative",
		watchSlidesProgress: !0,
		allowTouchMove: false,
		speed: 300,
		observer: !0,
		observeParents: !0,
		a11y: !0,
		navigation: {
			nextEl: ".kt_t1_next",
			prevEl: ".kt_t1_prev",
		},
		breakpoints: {
			1025: {
				creativeEffect: {
					perspective: !0,
					limitProgress: 2,
					shadowPerProgress: !0,
					prev: { translate: ["-10%", 0, -200], rotate: [0, 0, -2] },
					next: { translate: ["110%", 0, 0] }
				},
			},
		},
		on:{
			slideChange:function(){
				if (kt_t1.realIndex > 0) {
					$('.sw_tb .btn span').html('Келесі сұрақ')
					$('.sw_tb').addClass('swiper-button-disabled')
				} else {$('.sw_tb .btn span').html('Бастау')}

				if (kt_t1.realIndex == $('.sw_tb').attr('data-number')) {
					$('.sw_tb .btn span').html('Тестті аяқтау')
					$('.sw_tb').addClass('sw_tb_end')
				} else if (kt_t1.realIndex > $('.sw_tb').attr('data-number')) {
					$('.sw_tb').removeClass('swiper-button-disabled')
					$('.sw_tb').addClass('dsp_n')
				}
			},
		},
	});













	// 
	$('.tk_t2_start').click(function (e) { 
		e.preventDefault();

		$.ajax({
			url: "/education/course/tk/get.php?tk_test_start",
			type: "POST",
			dataType: "html",
			data: ({
				name: $('.name').attr('data-val'),
				child_name: $('.child_name').attr('data-val'),
				child_age: $('.child_age').attr('data-val')
			}),
			success: function(data){
				location.reload();
            console.log(data);
         },
			beforeSend: function(){ },
			error: function(data){ }
		})
	});

	// // 
	// $('.rad4_all').on('click', function () { 
	// 	$(this).parent().children('.rad4_all').removeClass('form_radio_act form_radio_true')
	// 	$(this).addClass('form_radio_act form_radio_true')
	// 	$(this).parent().attr('data-sel', 1)
	// 	$('.sw_tb').removeClass('swiper-button-disabled')
	// })


	$('.rad4').on('click', function () {
		$(this).parent().children('.rad4').removeClass('form_radio_act form_radio_true')
		$(this).addClass('form_radio_act form_radio_true')
		$(this).parent().attr('data-sel', 1)
		$('.sw_tb').removeClass('swiper-button-disabled')

		if ($(this).attr('data-val') == 1) {
			v1 = Number($('.sw_tb').attr('data-ball-v1'))
			$('.sw_tb').attr('data-ball-v1', v1 + 1)
		} else if ($(this).attr('data-val') == 2) {
			v2 = Number($('.sw_tb').attr('data-ball-v2'))
			$('.sw_tb').attr('data-ball-v2', v2 + 1)
		} else {
			v3 = Number($('.sw_tb').attr('data-ball-v3'))
			$('.sw_tb').attr('data-ball-v3', v3 + 1)
		}

		// 
		v = $(this).attr('data-val')
      ball = $('.sw_tb').attr('data-ball-v1')
		n = $(this).parent().attr('data-test-number')
		test_answer_id = $(this).parent().attr('data-test-answer-id')
		test_item_id = $(this).parent().attr('data-test-item-id')
		$.ajax({
			url: "/education/course/tk/get.php?test_answer_tk3",
			type: "POST",
			dataType: "html",
			data: ({
				v: v, n: n, ball: ball,
				test_answer_id: test_answer_id,
				test_item_id: test_item_id,
			}),
			success: function(data){
            console.log(data);
         },
			beforeSend: function(){ },
			error: function(data){ }
		})
	})

	var kt_t2 = new Swiper(".kt_t2", {
		slidesPerView: 1,
		effect: "creative",
		watchSlidesProgress: !0,
		allowTouchMove: false,
		speed: 300,
		observer: !0,
		observeParents: !0,
		a11y: !0,
		navigation: {
			nextEl: ".kt_t2_next",
			prevEl: ".kt_t2_prev",
			disabledClass: ".swiper-button-disabled",
		},
		breakpoints: {
			1025: {
				creativeEffect: {
					perspective: !0,
					limitProgress: 2,
					shadowPerProgress: !0,
					prev: { translate: ["-10%", 0, -200], rotate: [0, 0, -2] },
					next: { translate: ["110%", 0, 0] }
				},
			},
		},
		on:{
			slideChange:function(){
				// console.log(kt_t2.realIndex);
				if (kt_t2.realIndex > 0) {
					$('.sw_tb').removeClass('sw_tb_start')
					$('.sw_tb').addClass('swiper-button-disabled')
					$('.sw_tb .btn span').html('Келесі сұрақ')
				} else { $('.sw_tb .btn span').html('Бастау') }

				if (kt_t2.realIndex + 1 == $('.sw_tb').attr('data-number')) {
					$('.sw_tb .btn span').html('Тестті аяқтау')
				} else if (kt_t2.realIndex == $('.sw_tb').attr('data-number')) {
					$('.sw_tb').removeClass('swiper-button-disabled')
					$('.sw_tb .btn span').html('Келесі тест')

					btn = $('.sw_tb')
					$('.swt_answer_i1 .swt_answer_it div').html(btn.attr('data-ball-v1') + '/' + btn.attr('data-number'))
					$('.swt_answer_i2 .swt_answer_it div').html(btn.attr('data-ball-v2') + '/' + btn.attr('data-number'))
					$('.swt_answer_i3 .swt_answer_it div').html(btn.attr('data-ball-v3') + '/' + btn.attr('data-number'))

					$('.swt_answer_i1 .swt_answer_ic div').css('width', (100 / (Number(btn.attr('data-number')) / Number(btn.attr('data-ball-v1')))) + '%')
					$('.swt_answer_i2 .swt_answer_ic div').css('width', (100 / (Number(btn.attr('data-number')) / Number(btn.attr('data-ball-v2')))) + '%')
					$('.swt_answer_i3 .swt_answer_ic div').css('width', (100 / (Number(btn.attr('data-number')) / Number(btn.attr('data-ball-v3')))) + '%')
				
					if (Number(btn.attr('data-ball-v1')) <= Number($('.tk3_lo').attr('data-n'))) $('.tk3_loi1').removeClass('dsp_n');
					else $('.tk3_loi1').removeClass('dsp_n');
				}
			},
		},
	});

	$('.sw_tb').click(function () { 
		if (kt_t2.realIndex == $('.sw_tb').attr('data-number')) {
			n = $('.sw_tb').attr('data-test-number')
			$.ajax({
				url: "/education/course/tk/get.php?tk3_test_end",
				type: "POST",
				dataType: "html",
				data: ({ n: n }),
				success: function(data){
					if (data == 'yes') console.log(data);
					else $(location).attr('href', 'test.php?id=' + $('.sw_tb').attr('data-id') + '&test_id=' + data);
				},
				beforeSend: function(){ },
				error: function(data){ }
			})
		}
	})



	// 
	var kt_t4 = new Swiper(".kt_t4", {
		slidesPerView: 1,
		effect: "creative",
		watchSlidesProgress: !0,
		allowTouchMove: false,
		speed: 300,
		observer: !0,
		observeParents: !0,
		a11y: !0,
		navigation: {
			nextEl: ".kt_t4_next",
			prevEl: ".kt_t4_prev",
			disabledClass: ".swiper-button-disabled",
		},
		breakpoints: {
			1025: {
				creativeEffect: {
					perspective: !0,
					limitProgress: 2,
					shadowPerProgress: !0,
					prev: { translate: ["-10%", 0, -200], rotate: [0, 0, -2] },
					next: { translate: ["110%", 0, 0] }
				},
			},
		},
		on:{
			slideChange:function(){
				if (kt_t4.realIndex > 0) {
					$('.sw_tb').removeClass('sw_tb_start')
					$('.sw_tb').addClass('swiper-button-disabled')
					$('.sw_tb .btn span').html('Келесі сұрақ')
				} else { $('.sw_tb .btn span').html('Бастау') }

				if (kt_t4.realIndex + 1 == $('.sw_tb').attr('data-number')) {
					$('.sw_tb .btn span').html('Тестті аяқтау')
				} else if (kt_t4.realIndex == $('.sw_tb').attr('data-number')) {
					$('.sw_tb').removeClass('swiper-button-disabled')
					$('.sw_tb .btn span').html('Келесі тест')

					btn = $('.sw_tb')
					$('.swt_answer_i1 .swt_answer_it div').html(btn.attr('data-ball-v1') + '/' + btn.attr('data-number'))
					$('.swt_answer_i2 .swt_answer_it div').html(btn.attr('data-ball-v2') + '/' + btn.attr('data-number'))
					$('.swt_answer_i3 .swt_answer_it div').html(btn.attr('data-ball-v3') + '/' + btn.attr('data-number'))

					$('.swt_answer_i1 .swt_answer_ic div').css('width', (100 / (Number(btn.attr('data-number')) / Number(btn.attr('data-ball-v1')))) + '%')
					$('.swt_answer_i2 .swt_answer_ic div').css('width', (100 / (Number(btn.attr('data-number')) / Number(btn.attr('data-ball-v2')))) + '%')
					$('.swt_answer_i3 .swt_answer_ic div').css('width', (100 / (Number(btn.attr('data-number')) / Number(btn.attr('data-ball-v3')))) + '%')
				}
			},
		},
	});
	$('.sw_tb').click(function () {
		if (kt_t4.realIndex == $('.sw_tb').attr('data-number')) {
			n = $('.sw_tb').attr('data-test-number')
			$.ajax({
				url: "/education/course/tk/get.php?tk4_test_end",
				type: "POST",
				dataType: "html",
				data: ({ n: n }),
				success: function(data){
					if (data == 'yes') console.log(data);
					else $(location).attr('href', 'test.php?id=' + $('.sw_tb').attr('data-id') + '&test_id=' + data);
				},
				beforeSend: function(){ },
				error: function(data){ }
			})
		}
	})


}) // end jquery