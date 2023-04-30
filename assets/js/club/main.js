
	[].map.call(document.querySelectorAll('.btn'), el=> {
      el.addEventListener('click', e => {
         e = e.touches ? e.touches[0] : e;
         const r = el.getBoundingClientRect(), d = Math.sqrt(Math.pow(r.width,2)+Math.pow(r.height,2)) * 2;
         el.style.cssText = `--s: 0; --o: 1;`;  el.offsetTop; 
         el.style.cssText = `--t: 1; --o: 0; --d: ${d}; --x:${e.clientX - r.left}; --y:${e.clientY - r.top};`
      })
   })


   // 
	$('.bl11_i').each(function(){ $(this).height($(this).children('.bl11_it').height()) })
	$('.bl11_i').on('click', function(e) {
		e.preventDefault();
		if ($(this).hasClass('bl11_i_act') == true) {
			$(this).removeClass('bl11_i_act')
			$(this).height($(this).children('.bl11_it').height())
		} else {
			$(this).addClass('bl11_i_act')
			$(this).height($(this).children('.bl11_ic').height() + $(this).children('.bl11_it').height() + 30)
		}
	});