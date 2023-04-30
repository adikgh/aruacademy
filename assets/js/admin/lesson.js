// start jquery
$(document).ready(function() {

	// add_lesson_b
	$('.add_lesson_b').click(function(){
		$('.lesson_add').addClass('pop_bl_act');
		$('#html').addClass('ovr_h');
		if ($(this).attr('data-block-id')) $('.btn_lesson_add').attr('data-block-id', $(this).attr('data-block-id'))
	})
	$('.lesson_add_back').click(function(){
		$('.lesson_add').removeClass('pop_bl_act');
		$('#html').removeClass('ovr_h');
		$('.btn_lesson_add').attr('data-block-id', '')
	})
	$('.lesson1_clc').click(function() { $('.lesson1_block').toggleClass('lesson1_block_act') });

	$('.btn_lesson_add').on('click', function(){
		if ($('.lesson_name').attr('data-sel') != 1) mess('Тақырыпты жазыңыз')
		else {
			$.ajax({
				url: "/admin/course/get.php?lesson_add",
				type: "POST",
				dataType: "html",
				data: ({
					name: $('.lesson_name').attr('data-val'),
					cours_id: $('.btn_lesson_add').data('cours-id'),
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























}) // end jquery