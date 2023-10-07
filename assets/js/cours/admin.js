// start jquery
$(document).ready(function() {

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


   
   // user del
   $('html').on('click', '.user_del', function(){
      var id = $(this).attr('data-id')
      var btn = $(this)
      $.ajax({
         url: "/user/cours/item/users/get.php?user_del",
         type: "POST",
         dataType: "html",
         data: ({ id:id }),
         success: function(data){
            if (data == 'yes') {
               mess('Өшірілді')
               btn.parent().parent().parent().remove()
            } else console.log(data)
         },
         beforeSend: function(){},
         error: function(data){console.log(data)}
      })
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