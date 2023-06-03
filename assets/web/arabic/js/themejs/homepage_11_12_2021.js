



(function(element) {

	var $element = $(element),

		$tab = $('.ltabs-tab', $element),

		$tab_label = $('.ltabs-tab-label', $tab),

		$tabs = $('.ltabs-tabs', $element),

		ajax_url = $tabs.parents('.ltabs-tabs-container').attr('data-ajaxurl'),

		effect = $tabs.parents('.ltabs-tabs-container').attr('data-effect'),

		delay = $tabs.parents('.ltabs-tabs-container').attr('data-delay'),

		duration = $tabs.parents('.ltabs-tabs-container').attr('data-duration'),

		type_source = $tabs.parents('.ltabs-tabs-container').attr('data-type_source'),

		

		$col_lg = $tabs.parents('.ltabs-tabs-container').attr('data-lg'),

		$col_md = $tabs.parents('.ltabs-tabs-container').attr('data-md'),

		$col_sm = $tabs.parents('.ltabs-tabs-container').attr('data-sm'),

		$col_xs = $tabs.parents('.ltabs-tabs-container').attr('data-xs'),

		$margin = $tabs.parents('.ltabs-tabs-container').attr('data-margin'),

		

		$items_content = $('.ltabs-items', $element),

		$items_inner = $('.ltabs-items-inner', $items_content),

		$items_first_active = $('.ltabs-items-selected', $element),

		$select_box = $('.ltabs-selectbox', $element),

		$tab_label_select = $('.ltabs-tab-selected', $element),

		setting = '2',

		type_show = 'slider';

		enableSelectBoxes();

		

		/* First Ajax Listing tabs*/

		var el = $('.tab-sel',$element).attr('data-active-content'),

			el_active = $(el,$element);

		listing_tab_ajax(el_active);

		

	function enableSelectBoxes() {

		$tab_wrap = $('.ltabs-tabs-wrap', $element),

			$tab_label_select.html($('.ltabs-tab', $element).filter('.tab-sel').children('.ltabs-tab-label').html());

		if ($(window).innerWidth() <= 991) {

			$tab_wrap.addClass('ltabs-selectbox');

		} else {

			$tab_wrap.removeClass('ltabs-selectbox');

		}

	}

	

	$('span.ltabs-tab-selected, span.ltabs-tab-arrow', $element).click(function() {

		if ($('.ltabs-tabs', $element).hasClass('ltabs-open')) {

			$('.ltabs-tabs', $element).removeClass('ltabs-open');

		} else {

			$('.ltabs-tabs', $element).addClass('ltabs-open');

		}

	});

	

	$(window).resize(function() {

		if ($(window).innerWidth() <= 991) {

			$('.ltabs-tabs-wrap', $element).addClass('ltabs-selectbox');

		} else {

			$('.ltabs-tabs-wrap', $element).removeClass('ltabs-selectbox');

		}

	});

	

	function showAnimateItems(el) {

		var $_items = $('.new-ltabs-item', el), nub = 0;

		$('.ltabs-loadmore-btn', el).fadeOut('fast');

		$_items.each(function (i) {

			nub++;

			switch(effect) {

				case 'none' : $(this).css({'opacity':'1','filter':'alpha(opacity = 100)'}); break;

				default: animatesItems($(this),nub*delay,i,el);

			}

			if (i == $_items.length - 1) {

				$('.ltabs-loadmore-btn', el).fadeIn(3000);

			}

			$(this).removeClass('new-ltabs-item');

		});

	}



	function animatesItems($this,fdelay,i,el) {

		var $_items = $('.ltabs-item', el);

		$this.stop(true, true).attr("style",

			"-webkit-animation:" + effect +" "+ duration +"ms;"

			+ "-moz-animation:" + effect +" "+ duration +"ms;"

			+ "-o-animation:" + effect +" "+ duration +"ms;"

			+ "-moz-animation-delay:" + fdelay + "ms;"

			+ "-webkit-animation-delay:" + fdelay + "ms;"

			+ "-o-animation-delay:" + fdelay + "ms;"

			+ "animation-delay:" + fdelay + "ms;").delay(fdelay).animate({

				opacity: 1,

				filter: 'alpha(opacity = 100)'

			}, {

				delay: 1000

			});

		if (i == ($_items.length - 1)) {

			$(".ltabs-items-inner").addClass("play");

		}

	}

	

	

	function updateStatus($el) {

		$('.ltabs-loadmore-btn', $el).removeClass('loading');

		var countitem = $('.ltabs-item', $el).length;

		$('.ltabs-image-loading', $el).css({display: 'none'});

		$('.ltabs-loadmore-btn', $el).parent().attr('data-rl_start', countitem);

		var rl_total = $('.ltabs-loadmore-btn', $el).parent().attr('data-rl_total');

		var rl_load = $('.ltabs-loadmore-btn', $el).parent().attr('data-rl_load');

		var rl_allready = $('.ltabs-loadmore-btn', $el).parent().attr('data-rl_allready');



		if (countitem >= rl_total) {

			$('.ltabs-loadmore-btn', $el).addClass('loaded');

			$('.ltabs-image-loading', $el).css({display: 'none'});

			$('.ltabs-loadmore-btn', $el).attr('data-label', rl_allready);

			$('.ltabs-loadmore-btn', $el).removeClass('loading');

		}

	}

	

	function listing_tab_ajax(category_id ) {	

		var parent_active = $(category_id),

		total_product = parent_active.data('total'),

		tab_active = $('.ltabs-items-inner', parent_active),

		nb_column0 = $col_lg,

		nb_column1 = $col_md,

		nb_column2 = $col_sm,

		nb_column3 = $col_xs;

		nb_margin = parseInt($margin);

		tab_active.owlCarousel2({

			nav: true,

			dots: false,

			

			loop: false,

			autoplay: false,

			lazyLoad: true,
            rtl: true,
			autoplayHoverPause: true,

			autoplayTimeout: 5000,

			autoplaySpeed: 5000,

			navRewind: true,

			navText: ['', ''],

			margin: nb_margin ,

			responsive: {

				0: {

					items: nb_column3,

					nav: total_product <= nb_column3 ? false : ((true) ? true : false),

				},

				767: {

					items: nb_column2,

					nav: total_product <= nb_column2 ? false : ((true) ? true : false),

				},

				991: {

					items: nb_column1,

					nav: total_product <= nb_column1 ? false : ((true) ? true : false),

				},

				1199: {

					items: nb_column0,

				

					nav: total_product <= nb_column0 ? false : ((true) ? true : false),

				},

			}

		});

		

		/*Quick View*/

		$('.iframe-link').magnificPopup({

			type:'iframe',

			fixedContentPos: true,

			fixedBgPos: true,

			overflowY: 'auto',

			closeBtnInside: true,

			closeOnContentClick: true,

			preloader: true,

			midClick: true,

			removalDelay: 300,

			mainClass: 'my-mfp-zoom-in',

			//gallery: {  enabled: true }

		});

		

		

		$( '.product_1846281811484147376 .thumbs-product .item-img', $(category_id) ).click(function() {

			$( '.product_1846281811484147376 .thumbs-product .item-img', $(category_id) ).removeClass('thumb-active');

			$(this).addClass('thumb-active');

			var thumb_src = $(this).attr("data-src");

			$( ".product_1846281811484147376 .product-image-container img", $(category_id)).attr("src",thumb_src);

		}); 

	}

	

	$tab.on('click.ltabs-tab', function () {

		

		var $this = $(this);

		if ($this.hasClass('tab-sel')) return false;

		if ($this.parents('.ltabs-tabs').hasClass('ltabs-open')) {

			$this.parents('.ltabs-tabs').removeClass('ltabs-open');

		}

		$tab.removeClass('tab-sel');

		$this.addClass('tab-sel');

		var items_active = $this.attr('data-active-content');

		var _items_active = $(items_active,$element);

		$items_content.removeClass('ltabs-items-selected');

		_items_active.addClass('ltabs-items-selected');

		$tab_label_select.html($tab.filter('.tab-sel').children('.ltabs-tab-label').html());

		var $loading = $('.ltabs-loading', _items_active);

		var loaded = _items_active.hasClass('ltabs-items-loaded');

		

		

		type_show =$tabs.parents('.ltabs-tabs-container').attr('data-type_show');

		if (!loaded && !_items_active.hasClass('ltabs-process')) {

			_items_active.addClass('ltabs-process');

			var category_id 		= $this.attr('data-category-id'),

			path_url 	= 'ajax/listingtab_',

			ajax_url = $tabs.parents('.ltabs-tabs-container').attr('data-ajaxurl')+path_url+category_id+ '.html';

			

			$loading.show();

			$.ajax({

				type: 'POST',

				url: ajax_url,

				//dataType: 'json',// when on gave connection errors

				data: {

					is_ajax_listing_tabs: 1,

					ajax_reslisting_start: 1,

					categoryid: category_id,

					setting: setting,

					lbmoduleid: 1,

				},

				success: function (data) {

					

					if (data != '') {

						

						$('.ltabs-loading', _items_active).replaceWith(data);

						_items_active.addClass('ltabs-items-loaded').removeClass('ltabs-process');

						$loading.remove();

						if (type_show != 'slider') {

							showAnimateItems(_items_active);

						}

						updateStatus(_items_active);

						listing_tab_ajax(_items_active);

					}

					if(typeof(_SoQuickView) != 'undefined'){

						_SoQuickView();

					}

						

				},

				error: function(xhr, ajaxOptions, thrownError) {

					alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);

				}

				

			});



		} else {

			if (type_show == 'loadmore') {

				$('.ltabs-item', $items_content).removeAttr('style').addClass('new-ltabs-item');

				showAnimateItems(_items_active);

			}else{

				var $tag_id = $element;

				var owl = $('.owl2-carousel' , _items_active);

				var $navpage = $(".wap-listing-tabs", $tag_id);

				$navpage.siblings(".owl2-controls").addClass('hidden');

				

				owl = owl.data('owlCarousel2');

				

				if (typeof owl !== 'undefined') {

					owl.onResize();

				}

			}

		}

	});



})('#so_listing_tabs_1');

(function(element) {

	var $element = $(element),

		$tab = $('.ltabs-tab', $element),

		$tab_label = $('.ltabs-tab-label', $tab),

		$tabs = $('.ltabs-tabs', $element),

		ajax_url = $tabs.parents('.ltabs-tabs-container').attr('data-ajaxurl'),

		effect = $tabs.parents('.ltabs-tabs-container').attr('data-effect'),

		delay = $tabs.parents('.ltabs-tabs-container').attr('data-delay'),

		duration = $tabs.parents('.ltabs-tabs-container').attr('data-duration'),

		type_source = $tabs.parents('.ltabs-tabs-container').attr('data-type_source'),

		

		$col_lg = $tabs.parents('.ltabs-tabs-container').attr('data-lg'),

		$col_md = $tabs.parents('.ltabs-tabs-container').attr('data-md'),

		$col_sm = $tabs.parents('.ltabs-tabs-container').attr('data-sm'),

		$col_xs = $tabs.parents('.ltabs-tabs-container').attr('data-xs'),

		$margin = $tabs.parents('.ltabs-tabs-container').attr('data-margin'),

		

		$items_content = $('.ltabs-items', $element),

		$items_inner = $('.ltabs-items-inner', $items_content),

		$items_first_active = $('.ltabs-items-selected', $element),

		$select_box = $('.ltabs-selectbox', $element),

		$tab_label_select = $('.ltabs-tab-selected', $element),

		setting = '2',

		type_show = 'slider';

		enableSelectBoxes();

		

		/* First Ajax Listing tabs*/

		var el = $('.tab-sel',$element).attr('data-active-content'),

			el_active = $(el,$element);

		listing_tab_ajax(el_active);

		

	function enableSelectBoxes() {

		$tab_wrap = $('.ltabs-tabs-wrap', $element),

			$tab_label_select.html($('.ltabs-tab', $element).filter('.tab-sel').children('.ltabs-tab-label').html());

		if ($(window).innerWidth() <= 991) {

			$tab_wrap.addClass('ltabs-selectbox');

		} else {

			$tab_wrap.removeClass('ltabs-selectbox');

		}

	}

	

	$('span.ltabs-tab-selected, span.ltabs-tab-arrow', $element).click(function() {

		if ($('.ltabs-tabs', $element).hasClass('ltabs-open')) {

			$('.ltabs-tabs', $element).removeClass('ltabs-open');

		} else {

			$('.ltabs-tabs', $element).addClass('ltabs-open');

		}

	});

	

	$(window).resize(function() {

		if ($(window).innerWidth() <= 991) {

			$('.ltabs-tabs-wrap', $element).addClass('ltabs-selectbox');

		} else {

			$('.ltabs-tabs-wrap', $element).removeClass('ltabs-selectbox');

		}

	});

	

	function showAnimateItems(el) {

		var $_items = $('.new-ltabs-item', el), nub = 0;

		$('.ltabs-loadmore-btn', el).fadeOut('fast');

		$_items.each(function (i) {

			nub++;

			switch(effect) {

				case 'none' : $(this).css({'opacity':'1','filter':'alpha(opacity = 100)'}); break;

				default: animatesItems($(this),nub*delay,i,el);

			}

			if (i == $_items.length - 1) {

				$('.ltabs-loadmore-btn', el).fadeIn(3000);

			}

			$(this).removeClass('new-ltabs-item');

		});

	}



	function animatesItems($this,fdelay,i,el) {

		var $_items = $('.ltabs-item', el);

		$this.stop(true, true).attr("style",

			"-webkit-animation:" + effect +" "+ duration +"ms;"

			+ "-moz-animation:" + effect +" "+ duration +"ms;"

			+ "-o-animation:" + effect +" "+ duration +"ms;"

			+ "-moz-animation-delay:" + fdelay + "ms;"

			+ "-webkit-animation-delay:" + fdelay + "ms;"

			+ "-o-animation-delay:" + fdelay + "ms;"

			+ "animation-delay:" + fdelay + "ms;").delay(fdelay).animate({

				opacity: 1,

				filter: 'alpha(opacity = 100)'

			}, {

				delay: 1000

			});

		if (i == ($_items.length - 1)) {

			$(".ltabs-items-inner").addClass("play");

		}

	}

	

	

	function updateStatus($el) {

		$('.ltabs-loadmore-btn', $el).removeClass('loading');

		var countitem = $('.ltabs-item', $el).length;

		$('.ltabs-image-loading', $el).css({display: 'none'});

		$('.ltabs-loadmore-btn', $el).parent().attr('data-rl_start', countitem);

		var rl_total = $('.ltabs-loadmore-btn', $el).parent().attr('data-rl_total');

		var rl_load = $('.ltabs-loadmore-btn', $el).parent().attr('data-rl_load');

		var rl_allready = $('.ltabs-loadmore-btn', $el).parent().attr('data-rl_allready');



		if (countitem >= rl_total) {

			$('.ltabs-loadmore-btn', $el).addClass('loaded');

			$('.ltabs-image-loading', $el).css({display: 'none'});

			$('.ltabs-loadmore-btn', $el).attr('data-label', rl_allready);

			$('.ltabs-loadmore-btn', $el).removeClass('loading');

		}

	}

	

	function listing_tab_ajax(category_id ) {	

		var parent_active = $(category_id),

		total_product = parent_active.data('total'),

		tab_active = $('.ltabs-items-inner', parent_active),

		nb_column0 = $col_lg,

		nb_column1 = $col_md,

		nb_column2 = $col_sm,

		nb_column3 = $col_xs;

		nb_margin = parseInt($margin);

		tab_active.owlCarousel2({

			nav: true,

			dots: false,

			

			loop: false,

			autoplay: false,

			lazyLoad: true,
            rtl: true,
			autoplayHoverPause: true,

			autoplayTimeout: 5000,

			autoplaySpeed: 5000,

			navRewind: true,

			navText: ['', ''],

			margin: nb_margin ,

			responsive: {

				0: {

					items: nb_column3,

					nav: total_product <= nb_column3 ? false : ((true) ? true : false),

				},

				767: {

					items: nb_column2,

					nav: total_product <= nb_column2 ? false : ((true) ? true : false),

				},

				991: {

					items: nb_column1,

					nav: total_product <= nb_column1 ? false : ((true) ? true : false),

				},

				1199: {

					items: nb_column0,

				

					nav: total_product <= nb_column0 ? false : ((true) ? true : false),

				},

			}

		});

		

		/*Quick View*/

		$('.iframe-link').magnificPopup({

			type:'iframe',

			fixedContentPos: true,

			fixedBgPos: true,

			overflowY: 'auto',

			closeBtnInside: true,

			closeOnContentClick: true,

			preloader: true,

			midClick: true,

			removalDelay: 300,

			mainClass: 'my-mfp-zoom-in',

			//gallery: {  enabled: true }

		});

		

		

		$( '.product_1846281811484147376 .thumbs-product .item-img', $(category_id) ).click(function() {

			$( '.product_1846281811484147376 .thumbs-product .item-img', $(category_id) ).removeClass('thumb-active');

			$(this).addClass('thumb-active');

			var thumb_src = $(this).attr("data-src");

			$( ".product_1846281811484147376 .product-image-container img", $(category_id)).attr("src",thumb_src);

		}); 

	}

	

	$tab.on('click.ltabs-tab', function () {

		

		var $this = $(this);

		if ($this.hasClass('tab-sel')) return false;

		if ($this.parents('.ltabs-tabs').hasClass('ltabs-open')) {

			$this.parents('.ltabs-tabs').removeClass('ltabs-open');

		}

		$tab.removeClass('tab-sel');

		$this.addClass('tab-sel');

		var items_active = $this.attr('data-active-content');

		var _items_active = $(items_active,$element);

		$items_content.removeClass('ltabs-items-selected');

		_items_active.addClass('ltabs-items-selected');

		$tab_label_select.html($tab.filter('.tab-sel').children('.ltabs-tab-label').html());

		var $loading = $('.ltabs-loading', _items_active);

		var loaded = _items_active.hasClass('ltabs-items-loaded');

		

		

		type_show =$tabs.parents('.ltabs-tabs-container').attr('data-type_show');

		if (!loaded && !_items_active.hasClass('ltabs-process')) {

			_items_active.addClass('ltabs-process');

			var category_id 		= $this.attr('data-category-id'),

			path_url 	= 'ajax/listingtab_',

			ajax_url = $tabs.parents('.ltabs-tabs-container').attr('data-ajaxurl')+path_url+category_id+ '.html';

			

			$loading.show();

			$.ajax({

				type: 'POST',

				url: ajax_url,

				//dataType: 'json',// when on gave connection errors

				data: {

					is_ajax_listing_tabs: 1,

					ajax_reslisting_start: 1,

					categoryid: category_id,

					setting: setting,

					lbmoduleid: 1,

				},

				success: function (data) {

					

					if (data != '') {

						

						$('.ltabs-loading', _items_active).replaceWith(data);

						_items_active.addClass('ltabs-items-loaded').removeClass('ltabs-process');

						$loading.remove();

						if (type_show != 'slider') {

							showAnimateItems(_items_active);

						}

						updateStatus(_items_active);

						listing_tab_ajax(_items_active);

					}

					if(typeof(_SoQuickView) != 'undefined'){

						_SoQuickView();

					}

						

				},

				error: function(xhr, ajaxOptions, thrownError) {

					alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);

				}

				

			});



		} else {

			if (type_show == 'loadmore') {

				$('.ltabs-item', $items_content).removeAttr('style').addClass('new-ltabs-item');

				showAnimateItems(_items_active);

			}else{

				var $tag_id = $element;

				var owl = $('.owl2-carousel' , _items_active);

				var $navpage = $(".wap-listing-tabs", $tag_id);

				$navpage.siblings(".owl2-controls").addClass('hidden');

				

				owl = owl.data('owlCarousel2');

				

				if (typeof owl !== 'undefined') {

					owl.onResize();

				}

			}

		}

	});



})('#so_listing_tabs_2');

(function(element) {

	var $element = $(element),

		$tab = $('.ltabs-tab', $element),

		$tab_label = $('.ltabs-tab-label', $tab),

		$tabs = $('.ltabs-tabs', $element),

		ajax_url = $tabs.parents('.ltabs-tabs-container').attr('data-ajaxurl'),

		effect = $tabs.parents('.ltabs-tabs-container').attr('data-effect'),

		delay = $tabs.parents('.ltabs-tabs-container').attr('data-delay'),

		duration = $tabs.parents('.ltabs-tabs-container').attr('data-duration'),

		type_source = $tabs.parents('.ltabs-tabs-container').attr('data-type_source'),

		

		$col_lg = $tabs.parents('.ltabs-tabs-container').attr('data-lg'),

		$col_md = $tabs.parents('.ltabs-tabs-container').attr('data-md'),

		$col_sm = $tabs.parents('.ltabs-tabs-container').attr('data-sm'),

		$col_xs = $tabs.parents('.ltabs-tabs-container').attr('data-xs'),

		$margin = $tabs.parents('.ltabs-tabs-container').attr('data-margin'),

		

		$items_content = $('.ltabs-items', $element),

		$items_inner = $('.ltabs-items-inner', $items_content),

		$items_first_active = $('.ltabs-items-selected', $element),

		$select_box = $('.ltabs-selectbox', $element),

		$tab_label_select = $('.ltabs-tab-selected', $element),

		setting = '2',

		type_show = 'slider';

		enableSelectBoxes();

		

		/* First Ajax Listing tabs*/

		var el = $('.tab-sel',$element).attr('data-active-content'),

			el_active = $(el,$element);

		listing_tab_ajax(el_active);

		

	function enableSelectBoxes() {

		$tab_wrap = $('.ltabs-tabs-wrap', $element),

			$tab_label_select.html($('.ltabs-tab', $element).filter('.tab-sel').children('.ltabs-tab-label').html());

		if ($(window).innerWidth() <= 991) {

			$tab_wrap.addClass('ltabs-selectbox');

		} else {

			$tab_wrap.removeClass('ltabs-selectbox');

		}

	}

	

	$('span.ltabs-tab-selected, span.ltabs-tab-arrow', $element).click(function() {

		if ($('.ltabs-tabs', $element).hasClass('ltabs-open')) {

			$('.ltabs-tabs', $element).removeClass('ltabs-open');

		} else {

			$('.ltabs-tabs', $element).addClass('ltabs-open');

		}

	});

	

	$(window).resize(function() {

		if ($(window).innerWidth() <= 991) {

			$('.ltabs-tabs-wrap', $element).addClass('ltabs-selectbox');

		} else {

			$('.ltabs-tabs-wrap', $element).removeClass('ltabs-selectbox');

		}

	});

	

	function showAnimateItems(el) {

		var $_items = $('.new-ltabs-item', el), nub = 0;

		$('.ltabs-loadmore-btn', el).fadeOut('fast');

		$_items.each(function (i) {

			nub++;

			switch(effect) {

				case 'none' : $(this).css({'opacity':'1','filter':'alpha(opacity = 100)'}); break;

				default: animatesItems($(this),nub*delay,i,el);

			}

			if (i == $_items.length - 1) {

				$('.ltabs-loadmore-btn', el).fadeIn(3000);

			}

			$(this).removeClass('new-ltabs-item');

		});

	}



	function animatesItems($this,fdelay,i,el) {

		var $_items = $('.ltabs-item', el);

		$this.stop(true, true).attr("style",

			"-webkit-animation:" + effect +" "+ duration +"ms;"

			+ "-moz-animation:" + effect +" "+ duration +"ms;"

			+ "-o-animation:" + effect +" "+ duration +"ms;"

			+ "-moz-animation-delay:" + fdelay + "ms;"

			+ "-webkit-animation-delay:" + fdelay + "ms;"

			+ "-o-animation-delay:" + fdelay + "ms;"

			+ "animation-delay:" + fdelay + "ms;").delay(fdelay).animate({

				opacity: 1,

				filter: 'alpha(opacity = 100)'

			}, {

				delay: 1000

			});

		if (i == ($_items.length - 1)) {

			$(".ltabs-items-inner").addClass("play");

		}

	}

	

	

	function updateStatus($el) {

		$('.ltabs-loadmore-btn', $el).removeClass('loading');

		var countitem = $('.ltabs-item', $el).length;

		$('.ltabs-image-loading', $el).css({display: 'none'});

		$('.ltabs-loadmore-btn', $el).parent().attr('data-rl_start', countitem);

		var rl_total = $('.ltabs-loadmore-btn', $el).parent().attr('data-rl_total');

		var rl_load = $('.ltabs-loadmore-btn', $el).parent().attr('data-rl_load');

		var rl_allready = $('.ltabs-loadmore-btn', $el).parent().attr('data-rl_allready');



		if (countitem >= rl_total) {

			$('.ltabs-loadmore-btn', $el).addClass('loaded');

			$('.ltabs-image-loading', $el).css({display: 'none'});

			$('.ltabs-loadmore-btn', $el).attr('data-label', rl_allready);

			$('.ltabs-loadmore-btn', $el).removeClass('loading');

		}

	}

	

	function listing_tab_ajax(category_id ) {	

		var parent_active = $(category_id),

		total_product = parent_active.data('total'),

		tab_active = $('.ltabs-items-inner', parent_active),

		nb_column0 = $col_lg,

		nb_column1 = $col_md,

		nb_column2 = $col_sm,

		nb_column3 = $col_xs;

		nb_margin = parseInt($margin);

		tab_active.owlCarousel2({

			nav: true,

			dots: false,

			

			loop: false,

			autoplay: false,

			lazyLoad: true,
            rtl: true,
			autoplayHoverPause: true,

			autoplayTimeout: 5000,

			autoplaySpeed: 5000,

			navRewind: true,

			navText: ['', ''],

			margin: nb_margin ,

			responsive: {

				0: {

					items: nb_column3,

					nav: total_product <= nb_column3 ? false : ((true) ? true : false),

				},

				767: {

					items: nb_column2,

					nav: total_product <= nb_column2 ? false : ((true) ? true : false),

				},

				991: {

					items: nb_column1,

					nav: total_product <= nb_column1 ? false : ((true) ? true : false),

				},

				1199: {

					items: nb_column0,

				

					nav: total_product <= nb_column0 ? false : ((true) ? true : false),

				},

			}

		});

		

		/*Quick View*/

		$('.iframe-link').magnificPopup({

			type:'iframe',

			fixedContentPos: true,

			fixedBgPos: true,

			overflowY: 'auto',

			closeBtnInside: true,

			closeOnContentClick: true,

			preloader: true,

			midClick: true,

			removalDelay: 300,

			mainClass: 'my-mfp-zoom-in',

			//gallery: {  enabled: true }

		});

		

		

		$( '.product_1846281811484147376 .thumbs-product .item-img', $(category_id) ).click(function() {

			$( '.product_1846281811484147376 .thumbs-product .item-img', $(category_id) ).removeClass('thumb-active');

			$(this).addClass('thumb-active');

			var thumb_src = $(this).attr("data-src");

			$( ".product_1846281811484147376 .product-image-container img", $(category_id)).attr("src",thumb_src);

		}); 

	}

	

	$tab.on('click.ltabs-tab', function () {

		

		var $this = $(this);

		if ($this.hasClass('tab-sel')) return false;

		if ($this.parents('.ltabs-tabs').hasClass('ltabs-open')) {

			$this.parents('.ltabs-tabs').removeClass('ltabs-open');

		}

		$tab.removeClass('tab-sel');

		$this.addClass('tab-sel');

		var items_active = $this.attr('data-active-content');

		var _items_active = $(items_active,$element);

		$items_content.removeClass('ltabs-items-selected');

		_items_active.addClass('ltabs-items-selected');

		$tab_label_select.html($tab.filter('.tab-sel').children('.ltabs-tab-label').html());

		var $loading = $('.ltabs-loading', _items_active);

		var loaded = _items_active.hasClass('ltabs-items-loaded');

		

		

		type_show =$tabs.parents('.ltabs-tabs-container').attr('data-type_show');

		if (!loaded && !_items_active.hasClass('ltabs-process')) {

			_items_active.addClass('ltabs-process');

			var category_id 		= $this.attr('data-category-id'),

			path_url 	= 'ajax/listingtab_',

			ajax_url = $tabs.parents('.ltabs-tabs-container').attr('data-ajaxurl')+path_url+category_id+ '.html';

			

			$loading.show();

			$.ajax({

				type: 'POST',

				url: ajax_url,

				//dataType: 'json',// when on gave connection errors

				data: {

					is_ajax_listing_tabs: 1,

					ajax_reslisting_start: 1,

					categoryid: category_id,

					setting: setting,

					lbmoduleid: 1,

				},

				success: function (data) {

					

					if (data != '') {

						

						$('.ltabs-loading', _items_active).replaceWith(data);

						_items_active.addClass('ltabs-items-loaded').removeClass('ltabs-process');

						$loading.remove();

						if (type_show != 'slider') {

							showAnimateItems(_items_active);

						}

						updateStatus(_items_active);

						listing_tab_ajax(_items_active);

					}

					if(typeof(_SoQuickView) != 'undefined'){

						_SoQuickView();

					}

						

				},

				error: function(xhr, ajaxOptions, thrownError) {

					alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);

				}

				

			});



		} else {

			if (type_show == 'loadmore') {

				$('.ltabs-item', $items_content).removeAttr('style').addClass('new-ltabs-item');

				showAnimateItems(_items_active);

			}else{

				var $tag_id = $element;

				var owl = $('.owl2-carousel' , _items_active);

				var $navpage = $(".wap-listing-tabs", $tag_id);

				$navpage.siblings(".owl2-controls").addClass('hidden');

				

				owl = owl.data('owlCarousel2');

				

				if (typeof owl !== 'undefined') {

					owl.onResize();

				}

			}

		}

	});



})('#so_listing_tabs_3');

(function(element) {

	var $element = $(element),

		$tab = $('.ltabs-tab', $element),

		$tab_label = $('.ltabs-tab-label', $tab),

		$tabs = $('.ltabs-tabs', $element),

		ajax_url = $tabs.parents('.ltabs-tabs-container').attr('data-ajaxurl'),

		effect = $tabs.parents('.ltabs-tabs-container').attr('data-effect'),

		delay = $tabs.parents('.ltabs-tabs-container').attr('data-delay'),

		duration = $tabs.parents('.ltabs-tabs-container').attr('data-duration'),

		type_source = $tabs.parents('.ltabs-tabs-container').attr('data-type_source'),

		

		$col_lg = $tabs.parents('.ltabs-tabs-container').attr('data-lg'),

		$col_md = $tabs.parents('.ltabs-tabs-container').attr('data-md'),

		$col_sm = $tabs.parents('.ltabs-tabs-container').attr('data-sm'),

		$col_xs = $tabs.parents('.ltabs-tabs-container').attr('data-xs'),

		$margin = $tabs.parents('.ltabs-tabs-container').attr('data-margin'),

		

		$items_content = $('.ltabs-items', $element),

		$items_inner = $('.ltabs-items-inner', $items_content),

		$items_first_active = $('.ltabs-items-selected', $element),

		$select_box = $('.ltabs-selectbox', $element),

		$tab_label_select = $('.ltabs-tab-selected', $element),

		setting = '2',

		type_show = 'slider';

		enableSelectBoxes();

		

		/* First Ajax Listing tabs*/

		var el = $('.tab-sel',$element).attr('data-active-content'),

			el_active = $(el,$element);

		listing_tab_ajax(el_active);

		

	function enableSelectBoxes() {

		$tab_wrap = $('.ltabs-tabs-wrap', $element),

			$tab_label_select.html($('.ltabs-tab', $element).filter('.tab-sel').children('.ltabs-tab-label').html());

		if ($(window).innerWidth() <= 991) {

			$tab_wrap.addClass('ltabs-selectbox');

		} else {

			$tab_wrap.removeClass('ltabs-selectbox');

		}

	}

	

	$('span.ltabs-tab-selected, span.ltabs-tab-arrow', $element).click(function() {

		if ($('.ltabs-tabs', $element).hasClass('ltabs-open')) {

			$('.ltabs-tabs', $element).removeClass('ltabs-open');

		} else {

			$('.ltabs-tabs', $element).addClass('ltabs-open');

		}

	});

	

	$(window).resize(function() {

		if ($(window).innerWidth() <= 991) {

			$('.ltabs-tabs-wrap', $element).addClass('ltabs-selectbox');

		} else {

			$('.ltabs-tabs-wrap', $element).removeClass('ltabs-selectbox');

		}

	});

	

	function showAnimateItems(el) {

		var $_items = $('.new-ltabs-item', el), nub = 0;

		$('.ltabs-loadmore-btn', el).fadeOut('fast');

		$_items.each(function (i) {

			nub++;

			switch(effect) {

				case 'none' : $(this).css({'opacity':'1','filter':'alpha(opacity = 100)'}); break;

				default: animatesItems($(this),nub*delay,i,el);

			}

			if (i == $_items.length - 1) {

				$('.ltabs-loadmore-btn', el).fadeIn(3000);

			}

			$(this).removeClass('new-ltabs-item');

		});

	}



	function animatesItems($this,fdelay,i,el) {

		var $_items = $('.ltabs-item', el);

		$this.stop(true, true).attr("style",

			"-webkit-animation:" + effect +" "+ duration +"ms;"

			+ "-moz-animation:" + effect +" "+ duration +"ms;"

			+ "-o-animation:" + effect +" "+ duration +"ms;"

			+ "-moz-animation-delay:" + fdelay + "ms;"

			+ "-webkit-animation-delay:" + fdelay + "ms;"

			+ "-o-animation-delay:" + fdelay + "ms;"

			+ "animation-delay:" + fdelay + "ms;").delay(fdelay).animate({

				opacity: 1,

				filter: 'alpha(opacity = 100)'

			}, {

				delay: 1000

			});

		if (i == ($_items.length - 1)) {

			$(".ltabs-items-inner").addClass("play");

		}

	}

	

	

	function updateStatus($el) {

		$('.ltabs-loadmore-btn', $el).removeClass('loading');

		var countitem = $('.ltabs-item', $el).length;

		$('.ltabs-image-loading', $el).css({display: 'none'});

		$('.ltabs-loadmore-btn', $el).parent().attr('data-rl_start', countitem);

		var rl_total = $('.ltabs-loadmore-btn', $el).parent().attr('data-rl_total');

		var rl_load = $('.ltabs-loadmore-btn', $el).parent().attr('data-rl_load');

		var rl_allready = $('.ltabs-loadmore-btn', $el).parent().attr('data-rl_allready');



		if (countitem >= rl_total) {

			$('.ltabs-loadmore-btn', $el).addClass('loaded');

			$('.ltabs-image-loading', $el).css({display: 'none'});

			$('.ltabs-loadmore-btn', $el).attr('data-label', rl_allready);

			$('.ltabs-loadmore-btn', $el).removeClass('loading');

		}

	}

	

	function listing_tab_ajax(category_id ) {	

		var parent_active = $(category_id),

		total_product = parent_active.data('total'),

		tab_active = $('.ltabs-items-inner', parent_active),

		nb_column0 = $col_lg,

		nb_column1 = $col_md,

		nb_column2 = $col_sm,

		nb_column3 = $col_xs;

		nb_margin = parseInt($margin);

		tab_active.owlCarousel2({

			nav: true,

			dots: false,

			

			loop: false,

			autoplay: false,

			lazyLoad: true,
            rtl: true,
			autoplayHoverPause: true,

			autoplayTimeout: 5000,

			autoplaySpeed: 5000,

			navRewind: true,

			navText: ['', ''],

			margin: nb_margin ,

			responsive: {

				0: {

					items: nb_column3,

					nav: total_product <= nb_column3 ? false : ((true) ? true : false),

				},

				767: {

					items: nb_column2,

					nav: total_product <= nb_column2 ? false : ((true) ? true : false),

				},

				991: {

					items: nb_column1,

					nav: total_product <= nb_column1 ? false : ((true) ? true : false),

				},

				1199: {

					items: nb_column0,

				

					nav: total_product <= nb_column0 ? false : ((true) ? true : false),

				},

			}

		});

		

		/*Quick View*/

		$('.iframe-link').magnificPopup({

			type:'iframe',

			fixedContentPos: true,

			fixedBgPos: true,

			overflowY: 'auto',

			closeBtnInside: true,

			closeOnContentClick: true,

			preloader: true,

			midClick: true,

			removalDelay: 300,

			mainClass: 'my-mfp-zoom-in',

			//gallery: {  enabled: true }

		});

		

		

		$( '.product_1846281811484147376 .thumbs-product .item-img', $(category_id) ).click(function() {

			$( '.product_1846281811484147376 .thumbs-product .item-img', $(category_id) ).removeClass('thumb-active');

			$(this).addClass('thumb-active');

			var thumb_src = $(this).attr("data-src");

			$( ".product_1846281811484147376 .product-image-container img", $(category_id)).attr("src",thumb_src);

		}); 

	}

	

	$tab.on('click.ltabs-tab', function () {

		

		var $this = $(this);

		if ($this.hasClass('tab-sel')) return false;

		if ($this.parents('.ltabs-tabs').hasClass('ltabs-open')) {

			$this.parents('.ltabs-tabs').removeClass('ltabs-open');

		}

		$tab.removeClass('tab-sel');

		$this.addClass('tab-sel');

		var items_active = $this.attr('data-active-content');

		var _items_active = $(items_active,$element);

		$items_content.removeClass('ltabs-items-selected');

		_items_active.addClass('ltabs-items-selected');

		$tab_label_select.html($tab.filter('.tab-sel').children('.ltabs-tab-label').html());

		var $loading = $('.ltabs-loading', _items_active);

		var loaded = _items_active.hasClass('ltabs-items-loaded');

		

		

		type_show =$tabs.parents('.ltabs-tabs-container').attr('data-type_show');

		if (!loaded && !_items_active.hasClass('ltabs-process')) {

			_items_active.addClass('ltabs-process');

			var category_id 		= $this.attr('data-category-id'),

			path_url 	= 'ajax/listingtab_',

			ajax_url = $tabs.parents('.ltabs-tabs-container').attr('data-ajaxurl')+path_url+category_id+ '.html';

			

			$loading.show();

			$.ajax({

				type: 'POST',

				url: ajax_url,

				//dataType: 'json',// when on gave connection errors

				data: {

					is_ajax_listing_tabs: 1,

					ajax_reslisting_start: 1,

					categoryid: category_id,

					setting: setting,

					lbmoduleid: 1,

				},

				success: function (data) {

					

					if (data != '') {

						

						$('.ltabs-loading', _items_active).replaceWith(data);

						_items_active.addClass('ltabs-items-loaded').removeClass('ltabs-process');

						$loading.remove();

						if (type_show != 'slider') {

							showAnimateItems(_items_active);

						}

						updateStatus(_items_active);

						listing_tab_ajax(_items_active);

					}

					if(typeof(_SoQuickView) != 'undefined'){

						_SoQuickView();

					}

						

				},

				error: function(xhr, ajaxOptions, thrownError) {

					alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);

				}

				

			});



		} else {

			if (type_show == 'loadmore') {

				$('.ltabs-item', $items_content).removeAttr('style').addClass('new-ltabs-item');

				showAnimateItems(_items_active);

			}else{

				var $tag_id = $element;

				var owl = $('.owl2-carousel' , _items_active);

				var $navpage = $(".wap-listing-tabs", $tag_id);

				$navpage.siblings(".owl2-controls").addClass('hidden');

				

				owl = owl.data('owlCarousel2');

				

				if (typeof owl !== 'undefined') {

					owl.onResize();

				}

			}

		}

	});



})('#so_listing_tabs_4');

(function(element) {

	var $element = $(element),

		$tab = $('.ltabs-tab', $element),

		$tab_label = $('.ltabs-tab-label', $tab),

		$tabs = $('.ltabs-tabs', $element),

		ajax_url = $tabs.parents('.ltabs-tabs-container').attr('data-ajaxurl'),

		effect = $tabs.parents('.ltabs-tabs-container').attr('data-effect'),

		delay = $tabs.parents('.ltabs-tabs-container').attr('data-delay'),

		duration = $tabs.parents('.ltabs-tabs-container').attr('data-duration'),

		type_source = $tabs.parents('.ltabs-tabs-container').attr('data-type_source'),

		

		$col_lg = $tabs.parents('.ltabs-tabs-container').attr('data-lg'),

		$col_md = $tabs.parents('.ltabs-tabs-container').attr('data-md'),

		$col_sm = $tabs.parents('.ltabs-tabs-container').attr('data-sm'),

		$col_xs = $tabs.parents('.ltabs-tabs-container').attr('data-xs'),

		$margin = $tabs.parents('.ltabs-tabs-container').attr('data-margin'),

		

		$items_content = $('.ltabs-items', $element),

		$items_inner = $('.ltabs-items-inner', $items_content),

		$items_first_active = $('.ltabs-items-selected', $element),

		$select_box = $('.ltabs-selectbox', $element),

		$tab_label_select = $('.ltabs-tab-selected', $element),

		setting = '2',

		type_show = 'slider';

		enableSelectBoxes();

		

		/* First Ajax Listing tabs*/

		var el = $('.tab-sel',$element).attr('data-active-content'),

			el_active = $(el,$element);

		listing_tab_ajax(el_active);

		

	function enableSelectBoxes() {

		$tab_wrap = $('.ltabs-tabs-wrap', $element),

			$tab_label_select.html($('.ltabs-tab', $element).filter('.tab-sel').children('.ltabs-tab-label').html());

		if ($(window).innerWidth() <= 991) {

			$tab_wrap.addClass('ltabs-selectbox');

		} else {

			$tab_wrap.removeClass('ltabs-selectbox');

		}

	}

	

	$('span.ltabs-tab-selected, span.ltabs-tab-arrow', $element).click(function() {

		if ($('.ltabs-tabs', $element).hasClass('ltabs-open')) {

			$('.ltabs-tabs', $element).removeClass('ltabs-open');

		} else {

			$('.ltabs-tabs', $element).addClass('ltabs-open');

		}

	});

	

	$(window).resize(function() {

		if ($(window).innerWidth() <= 991) {

			$('.ltabs-tabs-wrap', $element).addClass('ltabs-selectbox');

		} else {

			$('.ltabs-tabs-wrap', $element).removeClass('ltabs-selectbox');

		}

	});

	

	function showAnimateItems(el) {

		var $_items = $('.new-ltabs-item', el), nub = 0;

		$('.ltabs-loadmore-btn', el).fadeOut('fast');

		$_items.each(function (i) {

			nub++;

			switch(effect) {

				case 'none' : $(this).css({'opacity':'1','filter':'alpha(opacity = 100)'}); break;

				default: animatesItems($(this),nub*delay,i,el);

			}

			if (i == $_items.length - 1) {

				$('.ltabs-loadmore-btn', el).fadeIn(3000);

			}

			$(this).removeClass('new-ltabs-item');

		});

	}



	function animatesItems($this,fdelay,i,el) {

		var $_items = $('.ltabs-item', el);

		$this.stop(true, true).attr("style",

			"-webkit-animation:" + effect +" "+ duration +"ms;"

			+ "-moz-animation:" + effect +" "+ duration +"ms;"

			+ "-o-animation:" + effect +" "+ duration +"ms;"

			+ "-moz-animation-delay:" + fdelay + "ms;"

			+ "-webkit-animation-delay:" + fdelay + "ms;"

			+ "-o-animation-delay:" + fdelay + "ms;"

			+ "animation-delay:" + fdelay + "ms;").delay(fdelay).animate({

				opacity: 1,

				filter: 'alpha(opacity = 100)'

			}, {

				delay: 1000

			});

		if (i == ($_items.length - 1)) {

			$(".ltabs-items-inner").addClass("play");

		}

	}

	

	

	function updateStatus($el) {

		$('.ltabs-loadmore-btn', $el).removeClass('loading');

		var countitem = $('.ltabs-item', $el).length;

		$('.ltabs-image-loading', $el).css({display: 'none'});

		$('.ltabs-loadmore-btn', $el).parent().attr('data-rl_start', countitem);

		var rl_total = $('.ltabs-loadmore-btn', $el).parent().attr('data-rl_total');

		var rl_load = $('.ltabs-loadmore-btn', $el).parent().attr('data-rl_load');

		var rl_allready = $('.ltabs-loadmore-btn', $el).parent().attr('data-rl_allready');



		if (countitem >= rl_total) {

			$('.ltabs-loadmore-btn', $el).addClass('loaded');

			$('.ltabs-image-loading', $el).css({display: 'none'});

			$('.ltabs-loadmore-btn', $el).attr('data-label', rl_allready);

			$('.ltabs-loadmore-btn', $el).removeClass('loading');

		}

	}

	

	function listing_tab_ajax(category_id ) {	

		var parent_active = $(category_id),

		total_product = parent_active.data('total'),

		tab_active = $('.ltabs-items-inner', parent_active),

		nb_column0 = $col_lg,

		nb_column1 = $col_md,

		nb_column2 = $col_sm,

		nb_column3 = $col_xs;

		nb_margin = parseInt($margin);

		tab_active.owlCarousel2({

			nav: true,

			dots: false,

			

			loop: false,

			autoplay: false,

			lazyLoad: true,
            rtl: true,
			autoplayHoverPause: true,

			autoplayTimeout: 5000,

			autoplaySpeed: 5000,

			navRewind: true,

			navText: ['', ''],

			margin: nb_margin ,

			responsive: {

				0: {

					items: nb_column3,

					nav: total_product <= nb_column3 ? false : ((true) ? true : false),

				},

				767: {

					items: nb_column2,

					nav: total_product <= nb_column2 ? false : ((true) ? true : false),

				},

				991: {

					items: nb_column1,

					nav: total_product <= nb_column1 ? false : ((true) ? true : false),

				},

				1199: {

					items: nb_column0,

				

					nav: total_product <= nb_column0 ? false : ((true) ? true : false),

				},

			}

		});

		

		/*Quick View*/

		$('.iframe-link').magnificPopup({

			type:'iframe',

			fixedContentPos: true,

			fixedBgPos: true,

			overflowY: 'auto',

			closeBtnInside: true,

			closeOnContentClick: true,

			preloader: true,

			midClick: true,

			removalDelay: 300,

			mainClass: 'my-mfp-zoom-in',

			//gallery: {  enabled: true }

		});

		

		

		$( '.product_1846281811484147376 .thumbs-product .item-img', $(category_id) ).click(function() {

			$( '.product_1846281811484147376 .thumbs-product .item-img', $(category_id) ).removeClass('thumb-active');

			$(this).addClass('thumb-active');

			var thumb_src = $(this).attr("data-src");

			$( ".product_1846281811484147376 .product-image-container img", $(category_id)).attr("src",thumb_src);

		}); 

	}

	

	$tab.on('click.ltabs-tab', function () {

		

		var $this = $(this);

		if ($this.hasClass('tab-sel')) return false;

		if ($this.parents('.ltabs-tabs').hasClass('ltabs-open')) {

			$this.parents('.ltabs-tabs').removeClass('ltabs-open');

		}

		$tab.removeClass('tab-sel');

		$this.addClass('tab-sel');

		var items_active = $this.attr('data-active-content');

		var _items_active = $(items_active,$element);

		$items_content.removeClass('ltabs-items-selected');

		_items_active.addClass('ltabs-items-selected');

		$tab_label_select.html($tab.filter('.tab-sel').children('.ltabs-tab-label').html());

		var $loading = $('.ltabs-loading', _items_active);

		var loaded = _items_active.hasClass('ltabs-items-loaded');

		

		

		type_show =$tabs.parents('.ltabs-tabs-container').attr('data-type_show');

		if (!loaded && !_items_active.hasClass('ltabs-process')) {

			_items_active.addClass('ltabs-process');

			var category_id 		= $this.attr('data-category-id'),

			path_url 	= 'ajax/listingtab_',

			ajax_url = $tabs.parents('.ltabs-tabs-container').attr('data-ajaxurl')+path_url+category_id+ '.html';

			

			$loading.show();

			$.ajax({

				type: 'POST',

				url: ajax_url,

				//dataType: 'json',// when on gave connection errors

				data: {

					is_ajax_listing_tabs: 1,

					ajax_reslisting_start: 1,

					categoryid: category_id,

					setting: setting,

					lbmoduleid: 1,

				},

				success: function (data) {

					

					if (data != '') {

						

						$('.ltabs-loading', _items_active).replaceWith(data);

						_items_active.addClass('ltabs-items-loaded').removeClass('ltabs-process');

						$loading.remove();

						if (type_show != 'slider') {

							showAnimateItems(_items_active);

						}

						updateStatus(_items_active);

						listing_tab_ajax(_items_active);

					}

					if(typeof(_SoQuickView) != 'undefined'){

						_SoQuickView();

					}

						

				},

				error: function(xhr, ajaxOptions, thrownError) {

					alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);

				}

				

			});



		} else {

			if (type_show == 'loadmore') {

				$('.ltabs-item', $items_content).removeAttr('style').addClass('new-ltabs-item');

				showAnimateItems(_items_active);

			}else{

				var $tag_id = $element;

				var owl = $('.owl2-carousel' , _items_active);

				var $navpage = $(".wap-listing-tabs", $tag_id);

				$navpage.siblings(".owl2-controls").addClass('hidden');

				

				owl = owl.data('owlCarousel2');

				

				if (typeof owl !== 'undefined') {

					owl.onResize();

				}

			}

		}

	});



})('#so_listing_tabs_5');

(function(element) {

	var $element = $(element),

		$tab = $('.ltabs-tab', $element),

		$tab_label = $('.ltabs-tab-label', $tab),

		$tabs = $('.ltabs-tabs', $element),

		ajax_url = $tabs.parents('.ltabs-tabs-container').attr('data-ajaxurl'),

		effect = $tabs.parents('.ltabs-tabs-container').attr('data-effect'),

		delay = $tabs.parents('.ltabs-tabs-container').attr('data-delay'),

		duration = $tabs.parents('.ltabs-tabs-container').attr('data-duration'),

		type_source = $tabs.parents('.ltabs-tabs-container').attr('data-type_source'),

		

		$col_lg = $tabs.parents('.ltabs-tabs-container').attr('data-lg'),

		$col_md = $tabs.parents('.ltabs-tabs-container').attr('data-md'),

		$col_sm = $tabs.parents('.ltabs-tabs-container').attr('data-sm'),

		$col_xs = $tabs.parents('.ltabs-tabs-container').attr('data-xs'),

		$margin = $tabs.parents('.ltabs-tabs-container').attr('data-margin'),

		

		$items_content = $('.ltabs-items', $element),

		$items_inner = $('.ltabs-items-inner', $items_content),

		$items_first_active = $('.ltabs-items-selected', $element),

		$select_box = $('.ltabs-selectbox', $element),

		$tab_label_select = $('.ltabs-tab-selected', $element),

		setting = '2',

		type_show = 'slider';

		enableSelectBoxes();

		

		/* First Ajax Listing tabs*/

		var el = $('.tab-sel',$element).attr('data-active-content'),

			el_active = $(el,$element);

		listing_tab_ajax(el_active);

		

	function enableSelectBoxes() {

		$tab_wrap = $('.ltabs-tabs-wrap', $element),

			$tab_label_select.html($('.ltabs-tab', $element).filter('.tab-sel').children('.ltabs-tab-label').html());

		if ($(window).innerWidth() <= 991) {

			$tab_wrap.addClass('ltabs-selectbox');

		} else {

			$tab_wrap.removeClass('ltabs-selectbox');

		}

	}

	

	$('span.ltabs-tab-selected, span.ltabs-tab-arrow', $element).click(function() {

		if ($('.ltabs-tabs', $element).hasClass('ltabs-open')) {

			$('.ltabs-tabs', $element).removeClass('ltabs-open');

		} else {

			$('.ltabs-tabs', $element).addClass('ltabs-open');

		}

	});

	

	$(window).resize(function() {

		if ($(window).innerWidth() <= 991) {

			$('.ltabs-tabs-wrap', $element).addClass('ltabs-selectbox');

		} else {

			$('.ltabs-tabs-wrap', $element).removeClass('ltabs-selectbox');

		}

	});

	

	function showAnimateItems(el) {

		var $_items = $('.new-ltabs-item', el), nub = 0;

		$('.ltabs-loadmore-btn', el).fadeOut('fast');

		$_items.each(function (i) {

			nub++;

			switch(effect) {

				case 'none' : $(this).css({'opacity':'1','filter':'alpha(opacity = 100)'}); break;

				default: animatesItems($(this),nub*delay,i,el);

			}

			if (i == $_items.length - 1) {

				$('.ltabs-loadmore-btn', el).fadeIn(3000);

			}

			$(this).removeClass('new-ltabs-item');

		});

	}



	function animatesItems($this,fdelay,i,el) {

		var $_items = $('.ltabs-item', el);

		$this.stop(true, true).attr("style",

			"-webkit-animation:" + effect +" "+ duration +"ms;"

			+ "-moz-animation:" + effect +" "+ duration +"ms;"

			+ "-o-animation:" + effect +" "+ duration +"ms;"

			+ "-moz-animation-delay:" + fdelay + "ms;"

			+ "-webkit-animation-delay:" + fdelay + "ms;"

			+ "-o-animation-delay:" + fdelay + "ms;"

			+ "animation-delay:" + fdelay + "ms;").delay(fdelay).animate({

				opacity: 1,

				filter: 'alpha(opacity = 100)'

			}, {

				delay: 1000

			});

		if (i == ($_items.length - 1)) {

			$(".ltabs-items-inner").addClass("play");

		}

	}

	

	

	function updateStatus($el) {

		$('.ltabs-loadmore-btn', $el).removeClass('loading');

		var countitem = $('.ltabs-item', $el).length;

		$('.ltabs-image-loading', $el).css({display: 'none'});

		$('.ltabs-loadmore-btn', $el).parent().attr('data-rl_start', countitem);

		var rl_total = $('.ltabs-loadmore-btn', $el).parent().attr('data-rl_total');

		var rl_load = $('.ltabs-loadmore-btn', $el).parent().attr('data-rl_load');

		var rl_allready = $('.ltabs-loadmore-btn', $el).parent().attr('data-rl_allready');



		if (countitem >= rl_total) {

			$('.ltabs-loadmore-btn', $el).addClass('loaded');

			$('.ltabs-image-loading', $el).css({display: 'none'});

			$('.ltabs-loadmore-btn', $el).attr('data-label', rl_allready);

			$('.ltabs-loadmore-btn', $el).removeClass('loading');

		}

	}

	

	function listing_tab_ajax(category_id ) {	

		var parent_active = $(category_id),

		total_product = parent_active.data('total'),

		tab_active = $('.ltabs-items-inner', parent_active),

		nb_column0 = $col_lg,

		nb_column1 = $col_md,

		nb_column2 = $col_sm,

		nb_column3 = $col_xs;

		nb_margin = parseInt($margin);

		tab_active.owlCarousel2({

			nav: true,

			dots: false,

			

			loop: false,

			autoplay: false,

			lazyLoad: true,
            rtl: true,
			autoplayHoverPause: true,

			autoplayTimeout: 5000,

			autoplaySpeed: 5000,

			navRewind: true,

			navText: ['', ''],

			margin: nb_margin ,

			responsive: {

				0: {

					items: nb_column3,

					nav: total_product <= nb_column3 ? false : ((true) ? true : false),

				},

				767: {

					items: nb_column2,

					nav: total_product <= nb_column2 ? false : ((true) ? true : false),

				},

				991: {

					items: nb_column1,

					nav: total_product <= nb_column1 ? false : ((true) ? true : false),

				},

				1199: {

					items: nb_column0,

				

					nav: total_product <= nb_column0 ? false : ((true) ? true : false),

				},

			}

		});

		

		/*Quick View*/

		$('.iframe-link').magnificPopup({

			type:'iframe',

			fixedContentPos: true,

			fixedBgPos: true,

			overflowY: 'auto',

			closeBtnInside: true,

			closeOnContentClick: true,

			preloader: true,

			midClick: true,

			removalDelay: 300,

			mainClass: 'my-mfp-zoom-in',

			//gallery: {  enabled: true }

		});

		

		

		$( '.product_1846281811484147376 .thumbs-product .item-img', $(category_id) ).click(function() {

			$( '.product_1846281811484147376 .thumbs-product .item-img', $(category_id) ).removeClass('thumb-active');

			$(this).addClass('thumb-active');

			var thumb_src = $(this).attr("data-src");

			$( ".product_1846281811484147376 .product-image-container img", $(category_id)).attr("src",thumb_src);

		}); 

	}

	

	$tab.on('click.ltabs-tab', function () {

		

		var $this = $(this);

		if ($this.hasClass('tab-sel')) return false;

		if ($this.parents('.ltabs-tabs').hasClass('ltabs-open')) {

			$this.parents('.ltabs-tabs').removeClass('ltabs-open');

		}

		$tab.removeClass('tab-sel');

		$this.addClass('tab-sel');

		var items_active = $this.attr('data-active-content');

		var _items_active = $(items_active,$element);

		$items_content.removeClass('ltabs-items-selected');

		_items_active.addClass('ltabs-items-selected');

		$tab_label_select.html($tab.filter('.tab-sel').children('.ltabs-tab-label').html());

		var $loading = $('.ltabs-loading', _items_active);

		var loaded = _items_active.hasClass('ltabs-items-loaded');

		

		

		type_show =$tabs.parents('.ltabs-tabs-container').attr('data-type_show');

		if (!loaded && !_items_active.hasClass('ltabs-process')) {

			_items_active.addClass('ltabs-process');

			var category_id 		= $this.attr('data-category-id'),

			path_url 	= 'ajax/listingtab_',

			ajax_url = $tabs.parents('.ltabs-tabs-container').attr('data-ajaxurl')+path_url+category_id+ '.html';

			

			$loading.show();

			$.ajax({

				type: 'POST',

				url: ajax_url,

				//dataType: 'json',// when on gave connection errors

				data: {

					is_ajax_listing_tabs: 1,

					ajax_reslisting_start: 1,

					categoryid: category_id,

					setting: setting,

					lbmoduleid: 1,

				},

				success: function (data) {

					

					if (data != '') {

						

						$('.ltabs-loading', _items_active).replaceWith(data);

						_items_active.addClass('ltabs-items-loaded').removeClass('ltabs-process');

						$loading.remove();

						if (type_show != 'slider') {

							showAnimateItems(_items_active);

						}

						updateStatus(_items_active);

						listing_tab_ajax(_items_active);

					}

					if(typeof(_SoQuickView) != 'undefined'){

						_SoQuickView();

					}

						

				},

				error: function(xhr, ajaxOptions, thrownError) {

					alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);

				}

				

			});



		} else {

			if (type_show == 'loadmore') {

				$('.ltabs-item', $items_content).removeAttr('style').addClass('new-ltabs-item');

				showAnimateItems(_items_active);

			}else{

				var $tag_id = $element;

				var owl = $('.owl2-carousel' , _items_active);

				var $navpage = $(".wap-listing-tabs", $tag_id);

				$navpage.siblings(".owl2-controls").addClass('hidden');

				

				owl = owl.data('owlCarousel2');

				

				if (typeof owl !== 'undefined') {

					owl.onResize();

				}

			}

		}

	});



})('#so_listing_tabs_6');

(function(element) {

	var $element = $(element),

		$tab = $('.ltabs-tab', $element),

		$tab_label = $('.ltabs-tab-label', $tab),

		$tabs = $('.ltabs-tabs', $element),

		ajax_url = $tabs.parents('.ltabs-tabs-container').attr('data-ajaxurl'),

		effect = $tabs.parents('.ltabs-tabs-container').attr('data-effect'),

		delay = $tabs.parents('.ltabs-tabs-container').attr('data-delay'),

		duration = $tabs.parents('.ltabs-tabs-container').attr('data-duration'),

		type_source = $tabs.parents('.ltabs-tabs-container').attr('data-type_source'),

		

		$col_lg = $tabs.parents('.ltabs-tabs-container').attr('data-lg'),

		$col_md = $tabs.parents('.ltabs-tabs-container').attr('data-md'),

		$col_sm = $tabs.parents('.ltabs-tabs-container').attr('data-sm'),

		$col_xs = $tabs.parents('.ltabs-tabs-container').attr('data-xs'),

		$margin = $tabs.parents('.ltabs-tabs-container').attr('data-margin'),

		

		$items_content = $('.ltabs-items', $element),

		$items_inner = $('.ltabs-items-inner', $items_content),

		$items_first_active = $('.ltabs-items-selected', $element),

		$select_box = $('.ltabs-selectbox', $element),

		$tab_label_select = $('.ltabs-tab-selected', $element),

		setting = '2',

		type_show = 'slider';

		enableSelectBoxes();

		

		/* First Ajax Listing tabs*/

		var el = $('.tab-sel',$element).attr('data-active-content'),

			el_active = $(el,$element);

		listing_tab_ajax(el_active);

		

	function enableSelectBoxes() {

		$tab_wrap = $('.ltabs-tabs-wrap', $element),

			$tab_label_select.html($('.ltabs-tab', $element).filter('.tab-sel').children('.ltabs-tab-label').html());

		if ($(window).innerWidth() <= 991) {

			$tab_wrap.addClass('ltabs-selectbox');

		} else {

			$tab_wrap.removeClass('ltabs-selectbox');

		}

	}

	

	$('span.ltabs-tab-selected, span.ltabs-tab-arrow', $element).click(function() {

		if ($('.ltabs-tabs', $element).hasClass('ltabs-open')) {

			$('.ltabs-tabs', $element).removeClass('ltabs-open');

		} else {

			$('.ltabs-tabs', $element).addClass('ltabs-open');

		}

	});

	

	$(window).resize(function() {

		if ($(window).innerWidth() <= 991) {

			$('.ltabs-tabs-wrap', $element).addClass('ltabs-selectbox');

		} else {

			$('.ltabs-tabs-wrap', $element).removeClass('ltabs-selectbox');

		}

	});

	

	function showAnimateItems(el) {

		var $_items = $('.new-ltabs-item', el), nub = 0;

		$('.ltabs-loadmore-btn', el).fadeOut('fast');

		$_items.each(function (i) {

			nub++;

			switch(effect) {

				case 'none' : $(this).css({'opacity':'1','filter':'alpha(opacity = 100)'}); break;

				default: animatesItems($(this),nub*delay,i,el);

			}

			if (i == $_items.length - 1) {

				$('.ltabs-loadmore-btn', el).fadeIn(3000);

			}

			$(this).removeClass('new-ltabs-item');

		});

	}



	function animatesItems($this,fdelay,i,el) {

		var $_items = $('.ltabs-item', el);

		$this.stop(true, true).attr("style",

			"-webkit-animation:" + effect +" "+ duration +"ms;"

			+ "-moz-animation:" + effect +" "+ duration +"ms;"

			+ "-o-animation:" + effect +" "+ duration +"ms;"

			+ "-moz-animation-delay:" + fdelay + "ms;"

			+ "-webkit-animation-delay:" + fdelay + "ms;"

			+ "-o-animation-delay:" + fdelay + "ms;"

			+ "animation-delay:" + fdelay + "ms;").delay(fdelay).animate({

				opacity: 1,

				filter: 'alpha(opacity = 100)'

			}, {

				delay: 1000

			});

		if (i == ($_items.length - 1)) {

			$(".ltabs-items-inner").addClass("play");

		}

	}

	

	

	function updateStatus($el) {

		$('.ltabs-loadmore-btn', $el).removeClass('loading');

		var countitem = $('.ltabs-item', $el).length;

		$('.ltabs-image-loading', $el).css({display: 'none'});

		$('.ltabs-loadmore-btn', $el).parent().attr('data-rl_start', countitem);

		var rl_total = $('.ltabs-loadmore-btn', $el).parent().attr('data-rl_total');

		var rl_load = $('.ltabs-loadmore-btn', $el).parent().attr('data-rl_load');

		var rl_allready = $('.ltabs-loadmore-btn', $el).parent().attr('data-rl_allready');



		if (countitem >= rl_total) {

			$('.ltabs-loadmore-btn', $el).addClass('loaded');

			$('.ltabs-image-loading', $el).css({display: 'none'});

			$('.ltabs-loadmore-btn', $el).attr('data-label', rl_allready);

			$('.ltabs-loadmore-btn', $el).removeClass('loading');

		}

	}

	

	function listing_tab_ajax(category_id ) {	

		var parent_active = $(category_id),

		total_product = parent_active.data('total'),

		tab_active = $('.ltabs-items-inner', parent_active),

		nb_column0 = $col_lg,

		nb_column1 = $col_md,

		nb_column2 = $col_sm,

		nb_column3 = $col_xs;

		nb_margin = parseInt($margin);

		tab_active.owlCarousel2({

			nav: true,

			dots: false,

			

			loop: false,

			autoplay: false,

			lazyLoad: true,
            rtl: true,
			autoplayHoverPause: true,

			autoplayTimeout: 5000,

			autoplaySpeed: 5000,

			navRewind: true,

			navText: ['', ''],

			margin: nb_margin ,

			responsive: {

				0: {

					items: nb_column3,

					nav: total_product <= nb_column3 ? false : ((true) ? true : false),

				},

				767: {

					items: nb_column2,

					nav: total_product <= nb_column2 ? false : ((true) ? true : false),

				},

				991: {

					items: nb_column1,

					nav: total_product <= nb_column1 ? false : ((true) ? true : false),

				},

				1199: {

					items: nb_column0,

				

					nav: total_product <= nb_column0 ? false : ((true) ? true : false),

				},

			}

		});

		

		/*Quick View*/

		$('.iframe-link').magnificPopup({

			type:'iframe',

			fixedContentPos: true,

			fixedBgPos: true,

			overflowY: 'auto',

			closeBtnInside: true,

			closeOnContentClick: true,

			preloader: true,

			midClick: true,

			removalDelay: 300,

			mainClass: 'my-mfp-zoom-in',

			//gallery: {  enabled: true }

		});

		

		

		$( '.product_1846281811484147376 .thumbs-product .item-img', $(category_id) ).click(function() {

			$( '.product_1846281811484147376 .thumbs-product .item-img', $(category_id) ).removeClass('thumb-active');

			$(this).addClass('thumb-active');

			var thumb_src = $(this).attr("data-src");

			$( ".product_1846281811484147376 .product-image-container img", $(category_id)).attr("src",thumb_src);

		}); 

	}

	

	$tab.on('click.ltabs-tab', function () {

		

		var $this = $(this);

		if ($this.hasClass('tab-sel')) return false;

		if ($this.parents('.ltabs-tabs').hasClass('ltabs-open')) {

			$this.parents('.ltabs-tabs').removeClass('ltabs-open');

		}

		$tab.removeClass('tab-sel');

		$this.addClass('tab-sel');

		var items_active = $this.attr('data-active-content');

		var _items_active = $(items_active,$element);

		$items_content.removeClass('ltabs-items-selected');

		_items_active.addClass('ltabs-items-selected');

		$tab_label_select.html($tab.filter('.tab-sel').children('.ltabs-tab-label').html());

		var $loading = $('.ltabs-loading', _items_active);

		var loaded = _items_active.hasClass('ltabs-items-loaded');

		

		

		type_show =$tabs.parents('.ltabs-tabs-container').attr('data-type_show');

		if (!loaded && !_items_active.hasClass('ltabs-process')) {

			_items_active.addClass('ltabs-process');

			var category_id 		= $this.attr('data-category-id'),

			path_url 	= 'ajax/listingtab_',

			ajax_url = $tabs.parents('.ltabs-tabs-container').attr('data-ajaxurl')+path_url+category_id+ '.html';

			

			$loading.show();

			$.ajax({

				type: 'POST',

				url: ajax_url,

				//dataType: 'json',// when on gave connection errors

				data: {

					is_ajax_listing_tabs: 1,

					ajax_reslisting_start: 1,

					categoryid: category_id,

					setting: setting,

					lbmoduleid: 1,

				},

				success: function (data) {

					

					if (data != '') {

						

						$('.ltabs-loading', _items_active).replaceWith(data);

						_items_active.addClass('ltabs-items-loaded').removeClass('ltabs-process');

						$loading.remove();

						if (type_show != 'slider') {

							showAnimateItems(_items_active);

						}

						updateStatus(_items_active);

						listing_tab_ajax(_items_active);

					}

					if(typeof(_SoQuickView) != 'undefined'){

						_SoQuickView();

					}

						

				},

				error: function(xhr, ajaxOptions, thrownError) {

					alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);

				}

				

			});



		} else {

			if (type_show == 'loadmore') {

				$('.ltabs-item', $items_content).removeAttr('style').addClass('new-ltabs-item');

				showAnimateItems(_items_active);

			}else{

				var $tag_id = $element;

				var owl = $('.owl2-carousel' , _items_active);

				var $navpage = $(".wap-listing-tabs", $tag_id);

				$navpage.siblings(".owl2-controls").addClass('hidden');

				

				owl = owl.data('owlCarousel2');

				

				if (typeof owl !== 'undefined') {

					owl.onResize();

				}

			}

		}

	});



})('#so_listing_tabs_7');

(function(element) {

	var $element = $(element),

		$tab = $('.ltabs-tab', $element),

		$tab_label = $('.ltabs-tab-label', $tab),

		$tabs = $('.ltabs-tabs', $element),

		ajax_url = $tabs.parents('.ltabs-tabs-container').attr('data-ajaxurl'),

		effect = $tabs.parents('.ltabs-tabs-container').attr('data-effect'),

		delay = $tabs.parents('.ltabs-tabs-container').attr('data-delay'),

		duration = $tabs.parents('.ltabs-tabs-container').attr('data-duration'),

		type_source = $tabs.parents('.ltabs-tabs-container').attr('data-type_source'),

		

		$col_lg = $tabs.parents('.ltabs-tabs-container').attr('data-lg'),

		$col_md = $tabs.parents('.ltabs-tabs-container').attr('data-md'),

		$col_sm = $tabs.parents('.ltabs-tabs-container').attr('data-sm'),

		$col_xs = $tabs.parents('.ltabs-tabs-container').attr('data-xs'),

		$margin = $tabs.parents('.ltabs-tabs-container').attr('data-margin'),

		

		$items_content = $('.ltabs-items', $element),

		$items_inner = $('.ltabs-items-inner', $items_content),

		$items_first_active = $('.ltabs-items-selected', $element),

		$select_box = $('.ltabs-selectbox', $element),

		$tab_label_select = $('.ltabs-tab-selected', $element),

		setting = '2',

		type_show = 'slider';

		enableSelectBoxes();

		

		/* First Ajax Listing tabs*/

		var el = $('.tab-sel',$element).attr('data-active-content'),

			el_active = $(el,$element);

		listing_tab_ajax(el_active);

		

	function enableSelectBoxes() {

		$tab_wrap = $('.ltabs-tabs-wrap', $element),

			$tab_label_select.html($('.ltabs-tab', $element).filter('.tab-sel').children('.ltabs-tab-label').html());

		if ($(window).innerWidth() <= 991) {

			$tab_wrap.addClass('ltabs-selectbox');

		} else {

			$tab_wrap.removeClass('ltabs-selectbox');

		}

	}

	

	$('span.ltabs-tab-selected, span.ltabs-tab-arrow', $element).click(function() {

		if ($('.ltabs-tabs', $element).hasClass('ltabs-open')) {

			$('.ltabs-tabs', $element).removeClass('ltabs-open');

		} else {

			$('.ltabs-tabs', $element).addClass('ltabs-open');

		}

	});

	

	$(window).resize(function() {

		if ($(window).innerWidth() <= 991) {

			$('.ltabs-tabs-wrap', $element).addClass('ltabs-selectbox');

		} else {

			$('.ltabs-tabs-wrap', $element).removeClass('ltabs-selectbox');

		}

	});

	

	function showAnimateItems(el) {

		var $_items = $('.new-ltabs-item', el), nub = 0;

		$('.ltabs-loadmore-btn', el).fadeOut('fast');

		$_items.each(function (i) {

			nub++;

			switch(effect) {

				case 'none' : $(this).css({'opacity':'1','filter':'alpha(opacity = 100)'}); break;

				default: animatesItems($(this),nub*delay,i,el);

			}

			if (i == $_items.length - 1) {

				$('.ltabs-loadmore-btn', el).fadeIn(3000);

			}

			$(this).removeClass('new-ltabs-item');

		});

	}



	function animatesItems($this,fdelay,i,el) {

		var $_items = $('.ltabs-item', el);

		$this.stop(true, true).attr("style",

			"-webkit-animation:" + effect +" "+ duration +"ms;"

			+ "-moz-animation:" + effect +" "+ duration +"ms;"

			+ "-o-animation:" + effect +" "+ duration +"ms;"

			+ "-moz-animation-delay:" + fdelay + "ms;"

			+ "-webkit-animation-delay:" + fdelay + "ms;"

			+ "-o-animation-delay:" + fdelay + "ms;"

			+ "animation-delay:" + fdelay + "ms;").delay(fdelay).animate({

				opacity: 1,

				filter: 'alpha(opacity = 100)'

			}, {

				delay: 1000

			});

		if (i == ($_items.length - 1)) {

			$(".ltabs-items-inner").addClass("play");

		}

	}

	

	

	function updateStatus($el) {

		$('.ltabs-loadmore-btn', $el).removeClass('loading');

		var countitem = $('.ltabs-item', $el).length;

		$('.ltabs-image-loading', $el).css({display: 'none'});

		$('.ltabs-loadmore-btn', $el).parent().attr('data-rl_start', countitem);

		var rl_total = $('.ltabs-loadmore-btn', $el).parent().attr('data-rl_total');

		var rl_load = $('.ltabs-loadmore-btn', $el).parent().attr('data-rl_load');

		var rl_allready = $('.ltabs-loadmore-btn', $el).parent().attr('data-rl_allready');



		if (countitem >= rl_total) {

			$('.ltabs-loadmore-btn', $el).addClass('loaded');

			$('.ltabs-image-loading', $el).css({display: 'none'});

			$('.ltabs-loadmore-btn', $el).attr('data-label', rl_allready);

			$('.ltabs-loadmore-btn', $el).removeClass('loading');

		}

	}

	

	function listing_tab_ajax(category_id ) {	

		var parent_active = $(category_id),

		total_product = parent_active.data('total'),

		tab_active = $('.ltabs-items-inner', parent_active),

		nb_column0 = $col_lg,

		nb_column1 = $col_md,

		nb_column2 = $col_sm,

		nb_column3 = $col_xs;

		nb_margin = parseInt($margin);

		tab_active.owlCarousel2({

			nav: true,

			dots: false,

			

			loop: false,

			autoplay: false,

			lazyLoad: true,
            rtl: true,
			autoplayHoverPause: true,

			autoplayTimeout: 5000,

			autoplaySpeed: 5000,

			navRewind: true,

			navText: ['', ''],

			margin: nb_margin ,

			responsive: {

				0: {

					items: nb_column3,

					nav: total_product <= nb_column3 ? false : ((true) ? true : false),

				},

				767: {

					items: nb_column2,

					nav: total_product <= nb_column2 ? false : ((true) ? true : false),

				},

				991: {

					items: nb_column1,

					nav: total_product <= nb_column1 ? false : ((true) ? true : false),

				},

				1199: {

					items: nb_column0,

				

					nav: total_product <= nb_column0 ? false : ((true) ? true : false),

				},

			}

		});

		

		/*Quick View*/

		$('.iframe-link').magnificPopup({

			type:'iframe',

			fixedContentPos: true,

			fixedBgPos: true,

			overflowY: 'auto',

			closeBtnInside: true,

			closeOnContentClick: true,

			preloader: true,

			midClick: true,

			removalDelay: 300,

			mainClass: 'my-mfp-zoom-in',

			//gallery: {  enabled: true }

		});

		

		

		$( '.product_1846281811484147376 .thumbs-product .item-img', $(category_id) ).click(function() {

			$( '.product_1846281811484147376 .thumbs-product .item-img', $(category_id) ).removeClass('thumb-active');

			$(this).addClass('thumb-active');

			var thumb_src = $(this).attr("data-src");

			$( ".product_1846281811484147376 .product-image-container img", $(category_id)).attr("src",thumb_src);

		}); 

	}

	

	$tab.on('click.ltabs-tab', function () {

		

		var $this = $(this);

		if ($this.hasClass('tab-sel')) return false;

		if ($this.parents('.ltabs-tabs').hasClass('ltabs-open')) {

			$this.parents('.ltabs-tabs').removeClass('ltabs-open');

		}

		$tab.removeClass('tab-sel');

		$this.addClass('tab-sel');

		var items_active = $this.attr('data-active-content');

		var _items_active = $(items_active,$element);

		$items_content.removeClass('ltabs-items-selected');

		_items_active.addClass('ltabs-items-selected');

		$tab_label_select.html($tab.filter('.tab-sel').children('.ltabs-tab-label').html());

		var $loading = $('.ltabs-loading', _items_active);

		var loaded = _items_active.hasClass('ltabs-items-loaded');

		

		

		type_show =$tabs.parents('.ltabs-tabs-container').attr('data-type_show');

		if (!loaded && !_items_active.hasClass('ltabs-process')) {

			_items_active.addClass('ltabs-process');

			var category_id 		= $this.attr('data-category-id'),

			path_url 	= 'ajax/listingtab_',

			ajax_url = $tabs.parents('.ltabs-tabs-container').attr('data-ajaxurl')+path_url+category_id+ '.html';

			

			$loading.show();

			$.ajax({

				type: 'POST',

				url: ajax_url,

				//dataType: 'json',// when on gave connection errors

				data: {

					is_ajax_listing_tabs: 1,

					ajax_reslisting_start: 1,

					categoryid: category_id,

					setting: setting,

					lbmoduleid: 1,

				},

				success: function (data) {

					

					if (data != '') {

						

						$('.ltabs-loading', _items_active).replaceWith(data);

						_items_active.addClass('ltabs-items-loaded').removeClass('ltabs-process');

						$loading.remove();

						if (type_show != 'slider') {

							showAnimateItems(_items_active);

						}

						updateStatus(_items_active);

						listing_tab_ajax(_items_active);

					}

					if(typeof(_SoQuickView) != 'undefined'){

						_SoQuickView();

					}

						

				},

				error: function(xhr, ajaxOptions, thrownError) {

					alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);

				}

				

			});



		} else {

			if (type_show == 'loadmore') {

				$('.ltabs-item', $items_content).removeAttr('style').addClass('new-ltabs-item');

				showAnimateItems(_items_active);

			}else{

				var $tag_id = $element;

				var owl = $('.owl2-carousel' , _items_active);

				var $navpage = $(".wap-listing-tabs", $tag_id);

				$navpage.siblings(".owl2-controls").addClass('hidden');

				

				owl = owl.data('owlCarousel2');

				

				if (typeof owl !== 'undefined') {

					owl.onResize();

				}

			}

		}

	});



})('#so_listing_tabs_8');

(function(element) {

	var $element = $(element),

		$tab = $('.ltabs-tab', $element),

		$tab_label = $('.ltabs-tab-label', $tab),

		$tabs = $('.ltabs-tabs', $element),

		ajax_url = $tabs.parents('.ltabs-tabs-container').attr('data-ajaxurl'),

		effect = $tabs.parents('.ltabs-tabs-container').attr('data-effect'),

		delay = $tabs.parents('.ltabs-tabs-container').attr('data-delay'),

		duration = $tabs.parents('.ltabs-tabs-container').attr('data-duration'),

		type_source = $tabs.parents('.ltabs-tabs-container').attr('data-type_source'),

		

		$col_lg = $tabs.parents('.ltabs-tabs-container').attr('data-lg'),

		$col_md = $tabs.parents('.ltabs-tabs-container').attr('data-md'),

		$col_sm = $tabs.parents('.ltabs-tabs-container').attr('data-sm'),

		$col_xs = $tabs.parents('.ltabs-tabs-container').attr('data-xs'),

		$margin = $tabs.parents('.ltabs-tabs-container').attr('data-margin'),

		

		$items_content = $('.ltabs-items', $element),

		$items_inner = $('.ltabs-items-inner', $items_content),

		$items_first_active = $('.ltabs-items-selected', $element),

		$select_box = $('.ltabs-selectbox', $element),

		$tab_label_select = $('.ltabs-tab-selected', $element),

		setting = '2',

		type_show = 'slider';

		enableSelectBoxes();

		

		/* First Ajax Listing tabs*/

		var el = $('.tab-sel',$element).attr('data-active-content'),

			el_active = $(el,$element);

		listing_tab_ajax(el_active);

		

	function enableSelectBoxes() {

		$tab_wrap = $('.ltabs-tabs-wrap', $element),

			$tab_label_select.html($('.ltabs-tab', $element).filter('.tab-sel').children('.ltabs-tab-label').html());

		if ($(window).innerWidth() <= 991) {

			$tab_wrap.addClass('ltabs-selectbox');

		} else {

			$tab_wrap.removeClass('ltabs-selectbox');

		}

	}

	

	$('span.ltabs-tab-selected, span.ltabs-tab-arrow', $element).click(function() {

		if ($('.ltabs-tabs', $element).hasClass('ltabs-open')) {

			$('.ltabs-tabs', $element).removeClass('ltabs-open');

		} else {

			$('.ltabs-tabs', $element).addClass('ltabs-open');

		}

	});

	

	$(window).resize(function() {

		if ($(window).innerWidth() <= 991) {

			$('.ltabs-tabs-wrap', $element).addClass('ltabs-selectbox');

		} else {

			$('.ltabs-tabs-wrap', $element).removeClass('ltabs-selectbox');

		}

	});

	

	function showAnimateItems(el) {

		var $_items = $('.new-ltabs-item', el), nub = 0;

		$('.ltabs-loadmore-btn', el).fadeOut('fast');

		$_items.each(function (i) {

			nub++;

			switch(effect) {

				case 'none' : $(this).css({'opacity':'1','filter':'alpha(opacity = 100)'}); break;

				default: animatesItems($(this),nub*delay,i,el);

			}

			if (i == $_items.length - 1) {

				$('.ltabs-loadmore-btn', el).fadeIn(3000);

			}

			$(this).removeClass('new-ltabs-item');

		});

	}



	function animatesItems($this,fdelay,i,el) {

		var $_items = $('.ltabs-item', el);

		$this.stop(true, true).attr("style",

			"-webkit-animation:" + effect +" "+ duration +"ms;"

			+ "-moz-animation:" + effect +" "+ duration +"ms;"

			+ "-o-animation:" + effect +" "+ duration +"ms;"

			+ "-moz-animation-delay:" + fdelay + "ms;"

			+ "-webkit-animation-delay:" + fdelay + "ms;"

			+ "-o-animation-delay:" + fdelay + "ms;"

			+ "animation-delay:" + fdelay + "ms;").delay(fdelay).animate({

				opacity: 1,

				filter: 'alpha(opacity = 100)'

			}, {

				delay: 1000

			});

		if (i == ($_items.length - 1)) {

			$(".ltabs-items-inner").addClass("play");

		}

	}

	

	

	function updateStatus($el) {

		$('.ltabs-loadmore-btn', $el).removeClass('loading');

		var countitem = $('.ltabs-item', $el).length;

		$('.ltabs-image-loading', $el).css({display: 'none'});

		$('.ltabs-loadmore-btn', $el).parent().attr('data-rl_start', countitem);

		var rl_total = $('.ltabs-loadmore-btn', $el).parent().attr('data-rl_total');

		var rl_load = $('.ltabs-loadmore-btn', $el).parent().attr('data-rl_load');

		var rl_allready = $('.ltabs-loadmore-btn', $el).parent().attr('data-rl_allready');



		if (countitem >= rl_total) {

			$('.ltabs-loadmore-btn', $el).addClass('loaded');

			$('.ltabs-image-loading', $el).css({display: 'none'});

			$('.ltabs-loadmore-btn', $el).attr('data-label', rl_allready);

			$('.ltabs-loadmore-btn', $el).removeClass('loading');

		}

	}

	

	function listing_tab_ajax(category_id ) {	

		var parent_active = $(category_id),

		total_product = parent_active.data('total'),

		tab_active = $('.ltabs-items-inner', parent_active),

		nb_column0 = $col_lg,

		nb_column1 = $col_md,

		nb_column2 = $col_sm,

		nb_column3 = $col_xs;

		nb_margin = parseInt($margin);

		tab_active.owlCarousel2({

			nav: true,

			dots: false,

			

			loop: false,

			autoplay: false,

			lazyLoad: true,
            rtl: true,
			autoplayHoverPause: true,

			autoplayTimeout: 5000,

			autoplaySpeed: 5000,

			navRewind: true,

			navText: ['', ''],

			margin: nb_margin ,

			responsive: {

				0: {

					items: nb_column3,

					nav: total_product <= nb_column3 ? false : ((true) ? true : false),

				},

				767: {

					items: nb_column2,

					nav: total_product <= nb_column2 ? false : ((true) ? true : false),

				},

				991: {

					items: nb_column1,

					nav: total_product <= nb_column1 ? false : ((true) ? true : false),

				},

				1199: {

					items: nb_column0,

				

					nav: total_product <= nb_column0 ? false : ((true) ? true : false),

				},

			}

		});

		

		/*Quick View*/

		$('.iframe-link').magnificPopup({

			type:'iframe',

			fixedContentPos: true,

			fixedBgPos: true,

			overflowY: 'auto',

			closeBtnInside: true,

			closeOnContentClick: true,

			preloader: true,

			midClick: true,

			removalDelay: 300,

			mainClass: 'my-mfp-zoom-in',

			//gallery: {  enabled: true }

		});

		

		

		$( '.product_1846281811484147376 .thumbs-product .item-img', $(category_id) ).click(function() {

			$( '.product_1846281811484147376 .thumbs-product .item-img', $(category_id) ).removeClass('thumb-active');

			$(this).addClass('thumb-active');

			var thumb_src = $(this).attr("data-src");

			$( ".product_1846281811484147376 .product-image-container img", $(category_id)).attr("src",thumb_src);

		}); 

	}

	

	$tab.on('click.ltabs-tab', function () {

		

		var $this = $(this);

		if ($this.hasClass('tab-sel')) return false;

		if ($this.parents('.ltabs-tabs').hasClass('ltabs-open')) {

			$this.parents('.ltabs-tabs').removeClass('ltabs-open');

		}

		$tab.removeClass('tab-sel');

		$this.addClass('tab-sel');

		var items_active = $this.attr('data-active-content');

		var _items_active = $(items_active,$element);

		$items_content.removeClass('ltabs-items-selected');

		_items_active.addClass('ltabs-items-selected');

		$tab_label_select.html($tab.filter('.tab-sel').children('.ltabs-tab-label').html());

		var $loading = $('.ltabs-loading', _items_active);

		var loaded = _items_active.hasClass('ltabs-items-loaded');

		

		

		type_show =$tabs.parents('.ltabs-tabs-container').attr('data-type_show');

		if (!loaded && !_items_active.hasClass('ltabs-process')) {

			_items_active.addClass('ltabs-process');

			var category_id 		= $this.attr('data-category-id'),

			path_url 	= 'ajax/listingtab_',

			ajax_url = $tabs.parents('.ltabs-tabs-container').attr('data-ajaxurl')+path_url+category_id+ '.html';

			

			$loading.show();

			$.ajax({

				type: 'POST',

				url: ajax_url,

				//dataType: 'json',// when on gave connection errors

				data: {

					is_ajax_listing_tabs: 1,

					ajax_reslisting_start: 1,

					categoryid: category_id,

					setting: setting,

					lbmoduleid: 1,

				},

				success: function (data) {

					

					if (data != '') {

						

						$('.ltabs-loading', _items_active).replaceWith(data);

						_items_active.addClass('ltabs-items-loaded').removeClass('ltabs-process');

						$loading.remove();

						if (type_show != 'slider') {

							showAnimateItems(_items_active);

						}

						updateStatus(_items_active);

						listing_tab_ajax(_items_active);

					}

					if(typeof(_SoQuickView) != 'undefined'){

						_SoQuickView();

					}

						

				},

				error: function(xhr, ajaxOptions, thrownError) {

					alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);

				}

				

			});



		} else {

			if (type_show == 'loadmore') {

				$('.ltabs-item', $items_content).removeAttr('style').addClass('new-ltabs-item');

				showAnimateItems(_items_active);

			}else{

				var $tag_id = $element;

				var owl = $('.owl2-carousel' , _items_active);

				var $navpage = $(".wap-listing-tabs", $tag_id);

				$navpage.siblings(".owl2-controls").addClass('hidden');

				

				owl = owl.data('owlCarousel2');

				

				if (typeof owl !== 'undefined') {

					owl.onResize();

				}

			}

		}

	});



})('#so_listing_tabs_9');

(function(element) {

	var $element = $(element),

		$tab = $('.ltabs-tab', $element),

		$tab_label = $('.ltabs-tab-label', $tab),

		$tabs = $('.ltabs-tabs', $element),

		ajax_url = $tabs.parents('.ltabs-tabs-container').attr('data-ajaxurl'),

		effect = $tabs.parents('.ltabs-tabs-container').attr('data-effect'),

		delay = $tabs.parents('.ltabs-tabs-container').attr('data-delay'),

		duration = $tabs.parents('.ltabs-tabs-container').attr('data-duration'),

		type_source = $tabs.parents('.ltabs-tabs-container').attr('data-type_source'),

		

		$col_lg = $tabs.parents('.ltabs-tabs-container').attr('data-lg'),

		$col_md = $tabs.parents('.ltabs-tabs-container').attr('data-md'),

		$col_sm = $tabs.parents('.ltabs-tabs-container').attr('data-sm'),

		$col_xs = $tabs.parents('.ltabs-tabs-container').attr('data-xs'),

		$margin = $tabs.parents('.ltabs-tabs-container').attr('data-margin'),

		

		$items_content = $('.ltabs-items', $element),

		$items_inner = $('.ltabs-items-inner', $items_content),

		$items_first_active = $('.ltabs-items-selected', $element),

		$select_box = $('.ltabs-selectbox', $element),

		$tab_label_select = $('.ltabs-tab-selected', $element),

		setting = '2',

		type_show = 'slider';

		enableSelectBoxes();

		

		/* First Ajax Listing tabs*/

		var el = $('.tab-sel',$element).attr('data-active-content'),

			el_active = $(el,$element);

		listing_tab_ajax(el_active);

		

	function enableSelectBoxes() {

		$tab_wrap = $('.ltabs-tabs-wrap', $element),

			$tab_label_select.html($('.ltabs-tab', $element).filter('.tab-sel').children('.ltabs-tab-label').html());

		if ($(window).innerWidth() <= 991) {

			$tab_wrap.addClass('ltabs-selectbox');

		} else {

			$tab_wrap.removeClass('ltabs-selectbox');

		}

	}

	

	$('span.ltabs-tab-selected, span.ltabs-tab-arrow', $element).click(function() {

		if ($('.ltabs-tabs', $element).hasClass('ltabs-open')) {

			$('.ltabs-tabs', $element).removeClass('ltabs-open');

		} else {

			$('.ltabs-tabs', $element).addClass('ltabs-open');

		}

	});

	

	$(window).resize(function() {

		if ($(window).innerWidth() <= 991) {

			$('.ltabs-tabs-wrap', $element).addClass('ltabs-selectbox');

		} else {

			$('.ltabs-tabs-wrap', $element).removeClass('ltabs-selectbox');

		}

	});

	

	function showAnimateItems(el) {

		var $_items = $('.new-ltabs-item', el), nub = 0;

		$('.ltabs-loadmore-btn', el).fadeOut('fast');

		$_items.each(function (i) {

			nub++;

			switch(effect) {

				case 'none' : $(this).css({'opacity':'1','filter':'alpha(opacity = 100)'}); break;

				default: animatesItems($(this),nub*delay,i,el);

			}

			if (i == $_items.length - 1) {

				$('.ltabs-loadmore-btn', el).fadeIn(3000);

			}

			$(this).removeClass('new-ltabs-item');

		});

	}



	function animatesItems($this,fdelay,i,el) {

		var $_items = $('.ltabs-item', el);

		$this.stop(true, true).attr("style",

			"-webkit-animation:" + effect +" "+ duration +"ms;"

			+ "-moz-animation:" + effect +" "+ duration +"ms;"

			+ "-o-animation:" + effect +" "+ duration +"ms;"

			+ "-moz-animation-delay:" + fdelay + "ms;"

			+ "-webkit-animation-delay:" + fdelay + "ms;"

			+ "-o-animation-delay:" + fdelay + "ms;"

			+ "animation-delay:" + fdelay + "ms;").delay(fdelay).animate({

				opacity: 1,

				filter: 'alpha(opacity = 100)'

			}, {

				delay: 1000

			});

		if (i == ($_items.length - 1)) {

			$(".ltabs-items-inner").addClass("play");

		}

	}

	

	

	function updateStatus($el) {

		$('.ltabs-loadmore-btn', $el).removeClass('loading');

		var countitem = $('.ltabs-item', $el).length;

		$('.ltabs-image-loading', $el).css({display: 'none'});

		$('.ltabs-loadmore-btn', $el).parent().attr('data-rl_start', countitem);

		var rl_total = $('.ltabs-loadmore-btn', $el).parent().attr('data-rl_total');

		var rl_load = $('.ltabs-loadmore-btn', $el).parent().attr('data-rl_load');

		var rl_allready = $('.ltabs-loadmore-btn', $el).parent().attr('data-rl_allready');



		if (countitem >= rl_total) {

			$('.ltabs-loadmore-btn', $el).addClass('loaded');

			$('.ltabs-image-loading', $el).css({display: 'none'});

			$('.ltabs-loadmore-btn', $el).attr('data-label', rl_allready);

			$('.ltabs-loadmore-btn', $el).removeClass('loading');

		}

	}

	

	function listing_tab_ajax(category_id ) {	

		var parent_active = $(category_id),

		total_product = parent_active.data('total'),

		tab_active = $('.ltabs-items-inner', parent_active),

		nb_column0 = $col_lg,

		nb_column1 = $col_md,

		nb_column2 = $col_sm,

		nb_column3 = $col_xs;

		nb_margin = parseInt($margin);

		tab_active.owlCarousel2({

			nav: true,

			dots: false,

			

			loop: false,

			autoplay: false,

			lazyLoad: true,
            rtl: true,
			autoplayHoverPause: true,

			autoplayTimeout: 5000,

			autoplaySpeed: 5000,

			navRewind: true,

			navText: ['', ''],

			margin: nb_margin ,

			responsive: {

				0: {

					items: nb_column3,

					nav: total_product <= nb_column3 ? false : ((true) ? true : false),

				},

				767: {

					items: nb_column2,

					nav: total_product <= nb_column2 ? false : ((true) ? true : false),

				},

				991: {

					items: nb_column1,

					nav: total_product <= nb_column1 ? false : ((true) ? true : false),

				},

				1199: {

					items: nb_column0,

				

					nav: total_product <= nb_column0 ? false : ((true) ? true : false),

				},

			}

		});

		

		/*Quick View*/

		$('.iframe-link').magnificPopup({

			type:'iframe',

			fixedContentPos: true,

			fixedBgPos: true,

			overflowY: 'auto',

			closeBtnInside: true,

			closeOnContentClick: true,

			preloader: true,

			midClick: true,

			removalDelay: 300,

			mainClass: 'my-mfp-zoom-in',

			//gallery: {  enabled: true }

		});

		

		

		$( '.product_1846281811484147376 .thumbs-product .item-img', $(category_id) ).click(function() {

			$( '.product_1846281811484147376 .thumbs-product .item-img', $(category_id) ).removeClass('thumb-active');

			$(this).addClass('thumb-active');

			var thumb_src = $(this).attr("data-src");

			$( ".product_1846281811484147376 .product-image-container img", $(category_id)).attr("src",thumb_src);

		}); 

	}

	

	$tab.on('click.ltabs-tab', function () {

		

		var $this = $(this);

		if ($this.hasClass('tab-sel')) return false;

		if ($this.parents('.ltabs-tabs').hasClass('ltabs-open')) {

			$this.parents('.ltabs-tabs').removeClass('ltabs-open');

		}

		$tab.removeClass('tab-sel');

		$this.addClass('tab-sel');

		var items_active = $this.attr('data-active-content');

		var _items_active = $(items_active,$element);

		$items_content.removeClass('ltabs-items-selected');

		_items_active.addClass('ltabs-items-selected');

		$tab_label_select.html($tab.filter('.tab-sel').children('.ltabs-tab-label').html());

		var $loading = $('.ltabs-loading', _items_active);

		var loaded = _items_active.hasClass('ltabs-items-loaded');

		

		

		type_show =$tabs.parents('.ltabs-tabs-container').attr('data-type_show');

		if (!loaded && !_items_active.hasClass('ltabs-process')) {

			_items_active.addClass('ltabs-process');

			var category_id 		= $this.attr('data-category-id'),

			path_url 	= 'ajax/listingtab_',

			ajax_url = $tabs.parents('.ltabs-tabs-container').attr('data-ajaxurl')+path_url+category_id+ '.html';

			

			$loading.show();

			$.ajax({

				type: 'POST',

				url: ajax_url,

				//dataType: 'json',// when on gave connection errors

				data: {

					is_ajax_listing_tabs: 1,

					ajax_reslisting_start: 1,

					categoryid: category_id,

					setting: setting,

					lbmoduleid: 1,

				},

				success: function (data) {

					

					if (data != '') {

						

						$('.ltabs-loading', _items_active).replaceWith(data);

						_items_active.addClass('ltabs-items-loaded').removeClass('ltabs-process');

						$loading.remove();

						if (type_show != 'slider') {

							showAnimateItems(_items_active);

						}

						updateStatus(_items_active);

						listing_tab_ajax(_items_active);

					}

					if(typeof(_SoQuickView) != 'undefined'){

						_SoQuickView();

					}

						

				},

				error: function(xhr, ajaxOptions, thrownError) {

					alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);

				}

				

			});



		} else {

			if (type_show == 'loadmore') {

				$('.ltabs-item', $items_content).removeAttr('style').addClass('new-ltabs-item');

				showAnimateItems(_items_active);

			}else{

				var $tag_id = $element;

				var owl = $('.owl2-carousel' , _items_active);

				var $navpage = $(".wap-listing-tabs", $tag_id);

				$navpage.siblings(".owl2-controls").addClass('hidden');

				

				owl = owl.data('owlCarousel2');

				

				if (typeof owl !== 'undefined') {

					owl.onResize();

				}

			}

		}

	});



})('#so_listing_tabs_10');

(function(element) {

	var $element = $(element),

		$tab = $('.ltabs-tab', $element),

		$tab_label = $('.ltabs-tab-label', $tab),

		$tabs = $('.ltabs-tabs', $element),

		ajax_url = $tabs.parents('.ltabs-tabs-container').attr('data-ajaxurl'),

		effect = $tabs.parents('.ltabs-tabs-container').attr('data-effect'),

		delay = $tabs.parents('.ltabs-tabs-container').attr('data-delay'),

		duration = $tabs.parents('.ltabs-tabs-container').attr('data-duration'),

		type_source = $tabs.parents('.ltabs-tabs-container').attr('data-type_source'),

		

		$col_lg = $tabs.parents('.ltabs-tabs-container').attr('data-lg'),

		$col_md = $tabs.parents('.ltabs-tabs-container').attr('data-md'),

		$col_sm = $tabs.parents('.ltabs-tabs-container').attr('data-sm'),

		$col_xs = $tabs.parents('.ltabs-tabs-container').attr('data-xs'),

		$margin = $tabs.parents('.ltabs-tabs-container').attr('data-margin'),

		

		$items_content = $('.ltabs-items', $element),

		$items_inner = $('.ltabs-items-inner', $items_content),

		$items_first_active = $('.ltabs-items-selected', $element),

		$select_box = $('.ltabs-selectbox', $element),

		$tab_label_select = $('.ltabs-tab-selected', $element),

		setting = '2',

		type_show = 'slider';

		enableSelectBoxes();

		

		/* First Ajax Listing tabs*/

		var el = $('.tab-sel',$element).attr('data-active-content'),

			el_active = $(el,$element);

		listing_tab_ajax(el_active);

		

	function enableSelectBoxes() {

		$tab_wrap = $('.ltabs-tabs-wrap', $element),

			$tab_label_select.html($('.ltabs-tab', $element).filter('.tab-sel').children('.ltabs-tab-label').html());

		if ($(window).innerWidth() <= 991) {

			$tab_wrap.addClass('ltabs-selectbox');

		} else {

			$tab_wrap.removeClass('ltabs-selectbox');

		}

	}

	

	$('span.ltabs-tab-selected, span.ltabs-tab-arrow', $element).click(function() {

		if ($('.ltabs-tabs', $element).hasClass('ltabs-open')) {

			$('.ltabs-tabs', $element).removeClass('ltabs-open');

		} else {

			$('.ltabs-tabs', $element).addClass('ltabs-open');

		}

	});

	

	$(window).resize(function() {

		if ($(window).innerWidth() <= 991) {

			$('.ltabs-tabs-wrap', $element).addClass('ltabs-selectbox');

		} else {

			$('.ltabs-tabs-wrap', $element).removeClass('ltabs-selectbox');

		}

	});

	

	function showAnimateItems(el) {

		var $_items = $('.new-ltabs-item', el), nub = 0;

		$('.ltabs-loadmore-btn', el).fadeOut('fast');

		$_items.each(function (i) {

			nub++;

			switch(effect) {

				case 'none' : $(this).css({'opacity':'1','filter':'alpha(opacity = 100)'}); break;

				default: animatesItems($(this),nub*delay,i,el);

			}

			if (i == $_items.length - 1) {

				$('.ltabs-loadmore-btn', el).fadeIn(3000);

			}

			$(this).removeClass('new-ltabs-item');

		});

	}



	function animatesItems($this,fdelay,i,el) {

		var $_items = $('.ltabs-item', el);

		$this.stop(true, true).attr("style",

			"-webkit-animation:" + effect +" "+ duration +"ms;"

			+ "-moz-animation:" + effect +" "+ duration +"ms;"

			+ "-o-animation:" + effect +" "+ duration +"ms;"

			+ "-moz-animation-delay:" + fdelay + "ms;"

			+ "-webkit-animation-delay:" + fdelay + "ms;"

			+ "-o-animation-delay:" + fdelay + "ms;"

			+ "animation-delay:" + fdelay + "ms;").delay(fdelay).animate({

				opacity: 1,

				filter: 'alpha(opacity = 100)'

			}, {

				delay: 1000

			});

		if (i == ($_items.length - 1)) {

			$(".ltabs-items-inner").addClass("play");

		}

	}

	

	

	function updateStatus($el) {

		$('.ltabs-loadmore-btn', $el).removeClass('loading');

		var countitem = $('.ltabs-item', $el).length;

		$('.ltabs-image-loading', $el).css({display: 'none'});

		$('.ltabs-loadmore-btn', $el).parent().attr('data-rl_start', countitem);

		var rl_total = $('.ltabs-loadmore-btn', $el).parent().attr('data-rl_total');

		var rl_load = $('.ltabs-loadmore-btn', $el).parent().attr('data-rl_load');

		var rl_allready = $('.ltabs-loadmore-btn', $el).parent().attr('data-rl_allready');



		if (countitem >= rl_total) {

			$('.ltabs-loadmore-btn', $el).addClass('loaded');

			$('.ltabs-image-loading', $el).css({display: 'none'});

			$('.ltabs-loadmore-btn', $el).attr('data-label', rl_allready);

			$('.ltabs-loadmore-btn', $el).removeClass('loading');

		}

	}

	

	function listing_tab_ajax(category_id ) {	

		var parent_active = $(category_id),

		total_product = parent_active.data('total'),

		tab_active = $('.ltabs-items-inner', parent_active),

		nb_column0 = $col_lg,

		nb_column1 = $col_md,

		nb_column2 = $col_sm,

		nb_column3 = $col_xs;

		nb_margin = parseInt($margin);

		tab_active.owlCarousel2({

			nav: true,

			dots: false,

			

			loop: false,

			autoplay: false,

			lazyLoad: true,
            rtl: true,
			autoplayHoverPause: true,

			autoplayTimeout: 5000,

			autoplaySpeed: 5000,

			navRewind: true,

			navText: ['', ''],

			margin: nb_margin ,

			responsive: {

				0: {

					items: nb_column3,

					nav: total_product <= nb_column3 ? false : ((true) ? true : false),

				},

				767: {

					items: nb_column2,

					nav: total_product <= nb_column2 ? false : ((true) ? true : false),

				},

				991: {

					items: nb_column1,

					nav: total_product <= nb_column1 ? false : ((true) ? true : false),

				},

				1199: {

					items: nb_column0,

				

					nav: total_product <= nb_column0 ? false : ((true) ? true : false),

				},

			}

		});

		

		/*Quick View*/

		$('.iframe-link').magnificPopup({

			type:'iframe',

			fixedContentPos: true,

			fixedBgPos: true,

			overflowY: 'auto',

			closeBtnInside: true,

			closeOnContentClick: true,

			preloader: true,

			midClick: true,

			removalDelay: 300,

			mainClass: 'my-mfp-zoom-in',

			//gallery: {  enabled: true }

		});

		

		

		$( '.product_1846281811484147376 .thumbs-product .item-img', $(category_id) ).click(function() {

			$( '.product_1846281811484147376 .thumbs-product .item-img', $(category_id) ).removeClass('thumb-active');

			$(this).addClass('thumb-active');

			var thumb_src = $(this).attr("data-src");

			$( ".product_1846281811484147376 .product-image-container img", $(category_id)).attr("src",thumb_src);

		}); 

	}

	

	$tab.on('click.ltabs-tab', function () {

		

		var $this = $(this);

		if ($this.hasClass('tab-sel')) return false;

		if ($this.parents('.ltabs-tabs').hasClass('ltabs-open')) {

			$this.parents('.ltabs-tabs').removeClass('ltabs-open');

		}

		$tab.removeClass('tab-sel');

		$this.addClass('tab-sel');

		var items_active = $this.attr('data-active-content');

		var _items_active = $(items_active,$element);

		$items_content.removeClass('ltabs-items-selected');

		_items_active.addClass('ltabs-items-selected');

		$tab_label_select.html($tab.filter('.tab-sel').children('.ltabs-tab-label').html());

		var $loading = $('.ltabs-loading', _items_active);

		var loaded = _items_active.hasClass('ltabs-items-loaded');

		

		

		type_show =$tabs.parents('.ltabs-tabs-container').attr('data-type_show');

		if (!loaded && !_items_active.hasClass('ltabs-process')) {

			_items_active.addClass('ltabs-process');

			var category_id 		= $this.attr('data-category-id'),

			path_url 	= 'ajax/listingtab_',

			ajax_url = $tabs.parents('.ltabs-tabs-container').attr('data-ajaxurl')+path_url+category_id+ '.html';

			

			$loading.show();

			$.ajax({

				type: 'POST',

				url: ajax_url,

				//dataType: 'json',// when on gave connection errors

				data: {

					is_ajax_listing_tabs: 1,

					ajax_reslisting_start: 1,

					categoryid: category_id,

					setting: setting,

					lbmoduleid: 1,

				},

				success: function (data) {

					

					if (data != '') {

						

						$('.ltabs-loading', _items_active).replaceWith(data);

						_items_active.addClass('ltabs-items-loaded').removeClass('ltabs-process');

						$loading.remove();

						if (type_show != 'slider') {

							showAnimateItems(_items_active);

						}

						updateStatus(_items_active);

						listing_tab_ajax(_items_active);

					}

					if(typeof(_SoQuickView) != 'undefined'){

						_SoQuickView();

					}

						

				},

				error: function(xhr, ajaxOptions, thrownError) {

					alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);

				}

				

			});



		} else {

			if (type_show == 'loadmore') {

				$('.ltabs-item', $items_content).removeAttr('style').addClass('new-ltabs-item');

				showAnimateItems(_items_active);

			}else{

				var $tag_id = $element;

				var owl = $('.owl2-carousel' , _items_active);

				var $navpage = $(".wap-listing-tabs", $tag_id);

				$navpage.siblings(".owl2-controls").addClass('hidden');

				

				owl = owl.data('owlCarousel2');

				

				if (typeof owl !== 'undefined') {

					owl.onResize();

				}

			}

		}

	});



})('#so_listing_tabs_11');

(function(element) {

	var $element = $(element),

		$tab = $('.ltabs-tab', $element),

		$tab_label = $('.ltabs-tab-label', $tab),

		$tabs = $('.ltabs-tabs', $element),

		ajax_url = $tabs.parents('.ltabs-tabs-container').attr('data-ajaxurl'),

		effect = $tabs.parents('.ltabs-tabs-container').attr('data-effect'),

		delay = $tabs.parents('.ltabs-tabs-container').attr('data-delay'),

		duration = $tabs.parents('.ltabs-tabs-container').attr('data-duration'),

		type_source = $tabs.parents('.ltabs-tabs-container').attr('data-type_source'),

		

		$col_lg = $tabs.parents('.ltabs-tabs-container').attr('data-lg'),

		$col_md = $tabs.parents('.ltabs-tabs-container').attr('data-md'),

		$col_sm = $tabs.parents('.ltabs-tabs-container').attr('data-sm'),

		$col_xs = $tabs.parents('.ltabs-tabs-container').attr('data-xs'),

		$margin = $tabs.parents('.ltabs-tabs-container').attr('data-margin'),

		

		$items_content = $('.ltabs-items', $element),

		$items_inner = $('.ltabs-items-inner', $items_content),

		$items_first_active = $('.ltabs-items-selected', $element),

		$select_box = $('.ltabs-selectbox', $element),

		$tab_label_select = $('.ltabs-tab-selected', $element),

		setting = '2',

		type_show = 'slider';

		enableSelectBoxes();

		

		/* First Ajax Listing tabs*/

		var el = $('.tab-sel',$element).attr('data-active-content'),

			el_active = $(el,$element);

		listing_tab_ajax(el_active);

		

	function enableSelectBoxes() {

		$tab_wrap = $('.ltabs-tabs-wrap', $element),

			$tab_label_select.html($('.ltabs-tab', $element).filter('.tab-sel').children('.ltabs-tab-label').html());

		if ($(window).innerWidth() <= 991) {

			$tab_wrap.addClass('ltabs-selectbox');

		} else {

			$tab_wrap.removeClass('ltabs-selectbox');

		}

	}

	

	$('span.ltabs-tab-selected, span.ltabs-tab-arrow', $element).click(function() {

		if ($('.ltabs-tabs', $element).hasClass('ltabs-open')) {

			$('.ltabs-tabs', $element).removeClass('ltabs-open');

		} else {

			$('.ltabs-tabs', $element).addClass('ltabs-open');

		}

	});

	

	$(window).resize(function() {

		if ($(window).innerWidth() <= 991) {

			$('.ltabs-tabs-wrap', $element).addClass('ltabs-selectbox');

		} else {

			$('.ltabs-tabs-wrap', $element).removeClass('ltabs-selectbox');

		}

	});

	

	function showAnimateItems(el) {

		var $_items = $('.new-ltabs-item', el), nub = 0;

		$('.ltabs-loadmore-btn', el).fadeOut('fast');

		$_items.each(function (i) {

			nub++;

			switch(effect) {

				case 'none' : $(this).css({'opacity':'1','filter':'alpha(opacity = 100)'}); break;

				default: animatesItems($(this),nub*delay,i,el);

			}

			if (i == $_items.length - 1) {

				$('.ltabs-loadmore-btn', el).fadeIn(3000);

			}

			$(this).removeClass('new-ltabs-item');

		});

	}



	function animatesItems($this,fdelay,i,el) {

		var $_items = $('.ltabs-item', el);

		$this.stop(true, true).attr("style",

			"-webkit-animation:" + effect +" "+ duration +"ms;"

			+ "-moz-animation:" + effect +" "+ duration +"ms;"

			+ "-o-animation:" + effect +" "+ duration +"ms;"

			+ "-moz-animation-delay:" + fdelay + "ms;"

			+ "-webkit-animation-delay:" + fdelay + "ms;"

			+ "-o-animation-delay:" + fdelay + "ms;"

			+ "animation-delay:" + fdelay + "ms;").delay(fdelay).animate({

				opacity: 1,

				filter: 'alpha(opacity = 100)'

			}, {

				delay: 1000

			});

		if (i == ($_items.length - 1)) {

			$(".ltabs-items-inner").addClass("play");

		}

	}

	

	

	function updateStatus($el) {

		$('.ltabs-loadmore-btn', $el).removeClass('loading');

		var countitem = $('.ltabs-item', $el).length;

		$('.ltabs-image-loading', $el).css({display: 'none'});

		$('.ltabs-loadmore-btn', $el).parent().attr('data-rl_start', countitem);

		var rl_total = $('.ltabs-loadmore-btn', $el).parent().attr('data-rl_total');

		var rl_load = $('.ltabs-loadmore-btn', $el).parent().attr('data-rl_load');

		var rl_allready = $('.ltabs-loadmore-btn', $el).parent().attr('data-rl_allready');



		if (countitem >= rl_total) {

			$('.ltabs-loadmore-btn', $el).addClass('loaded');

			$('.ltabs-image-loading', $el).css({display: 'none'});

			$('.ltabs-loadmore-btn', $el).attr('data-label', rl_allready);

			$('.ltabs-loadmore-btn', $el).removeClass('loading');

		}

	}

	

	function listing_tab_ajax(category_id ) {	

		var parent_active = $(category_id),

		total_product = parent_active.data('total'),

		tab_active = $('.ltabs-items-inner', parent_active),

		nb_column0 = $col_lg,

		nb_column1 = $col_md,

		nb_column2 = $col_sm,

		nb_column3 = $col_xs;

		nb_margin = parseInt($margin);

		tab_active.owlCarousel2({

			nav: true,

			dots: false,

			

			loop: false,

			autoplay: false,

			lazyLoad: true,
            rtl: true,
			autoplayHoverPause: true,

			autoplayTimeout: 5000,

			autoplaySpeed: 5000,

			navRewind: true,

			navText: ['', ''],

			margin: nb_margin ,

			responsive: {

				0: {

					items: nb_column3,

					nav: total_product <= nb_column3 ? false : ((true) ? true : false),

				},

				767: {

					items: nb_column2,

					nav: total_product <= nb_column2 ? false : ((true) ? true : false),

				},

				991: {

					items: nb_column1,

					nav: total_product <= nb_column1 ? false : ((true) ? true : false),

				},

				1199: {

					items: nb_column0,

				

					nav: total_product <= nb_column0 ? false : ((true) ? true : false),

				},

			}

		});

		

		/*Quick View*/

		$('.iframe-link').magnificPopup({

			type:'iframe',

			fixedContentPos: true,

			fixedBgPos: true,

			overflowY: 'auto',

			closeBtnInside: true,

			closeOnContentClick: true,

			preloader: true,

			midClick: true,

			removalDelay: 300,

			mainClass: 'my-mfp-zoom-in',

			//gallery: {  enabled: true }

		});

		

		

		$( '.product_1846281811484147376 .thumbs-product .item-img', $(category_id) ).click(function() {

			$( '.product_1846281811484147376 .thumbs-product .item-img', $(category_id) ).removeClass('thumb-active');

			$(this).addClass('thumb-active');

			var thumb_src = $(this).attr("data-src");

			$( ".product_1846281811484147376 .product-image-container img", $(category_id)).attr("src",thumb_src);

		}); 

	}

	

	$tab.on('click.ltabs-tab', function () {

		

		var $this = $(this);

		if ($this.hasClass('tab-sel')) return false;

		if ($this.parents('.ltabs-tabs').hasClass('ltabs-open')) {

			$this.parents('.ltabs-tabs').removeClass('ltabs-open');

		}

		$tab.removeClass('tab-sel');

		$this.addClass('tab-sel');

		var items_active = $this.attr('data-active-content');

		var _items_active = $(items_active,$element);

		$items_content.removeClass('ltabs-items-selected');

		_items_active.addClass('ltabs-items-selected');

		$tab_label_select.html($tab.filter('.tab-sel').children('.ltabs-tab-label').html());

		var $loading = $('.ltabs-loading', _items_active);

		var loaded = _items_active.hasClass('ltabs-items-loaded');

		

		

		type_show =$tabs.parents('.ltabs-tabs-container').attr('data-type_show');

		if (!loaded && !_items_active.hasClass('ltabs-process')) {

			_items_active.addClass('ltabs-process');

			var category_id 		= $this.attr('data-category-id'),

			path_url 	= 'ajax/listingtab_',

			ajax_url = $tabs.parents('.ltabs-tabs-container').attr('data-ajaxurl')+path_url+category_id+ '.html';

			

			$loading.show();

			$.ajax({

				type: 'POST',

				url: ajax_url,

				//dataType: 'json',// when on gave connection errors

				data: {

					is_ajax_listing_tabs: 1,

					ajax_reslisting_start: 1,

					categoryid: category_id,

					setting: setting,

					lbmoduleid: 1,

				},

				success: function (data) {

					

					if (data != '') {

						

						$('.ltabs-loading', _items_active).replaceWith(data);

						_items_active.addClass('ltabs-items-loaded').removeClass('ltabs-process');

						$loading.remove();

						if (type_show != 'slider') {

							showAnimateItems(_items_active);

						}

						updateStatus(_items_active);

						listing_tab_ajax(_items_active);

					}

					if(typeof(_SoQuickView) != 'undefined'){

						_SoQuickView();

					}

						

				},

				error: function(xhr, ajaxOptions, thrownError) {

					alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);

				}

				

			});



		} else {

			if (type_show == 'loadmore') {

				$('.ltabs-item', $items_content).removeAttr('style').addClass('new-ltabs-item');

				showAnimateItems(_items_active);

			}else{

				var $tag_id = $element;

				var owl = $('.owl2-carousel' , _items_active);

				var $navpage = $(".wap-listing-tabs", $tag_id);

				$navpage.siblings(".owl2-controls").addClass('hidden');

				

				owl = owl.data('owlCarousel2');

				

				if (typeof owl !== 'undefined') {

					owl.onResize();

				}

			}

		}

	});



})('#so_listing_tabs_12');





















(function(element) {

	var $element = $(element),

		$tab = $('.ltabs-tab', $element),

		$tab_label = $('.ltabs-tab-label', $tab),

		$tabs = $('.ltabs-tabs', $element),

		ajax_url = $tabs.parents('.ltabs-tabs-container').attr('data-ajaxurl'),

		effect = $tabs.parents('.ltabs-tabs-container').attr('data-effect'),

		delay = $tabs.parents('.ltabs-tabs-container').attr('data-delay'),

		duration = $tabs.parents('.ltabs-tabs-container').attr('data-duration'),

		type_source = $tabs.parents('.ltabs-tabs-container').attr('data-type_source'),

		$margin = $tabs.parents('.ltabs-tabs-container').attr('data-margin'),

		

		$col_lg = $tabs.parents('.ltabs-tabs-container').attr('data-lg'),

		$col_md = $tabs.parents('.ltabs-tabs-container').attr('data-md'),

		$col_sm = $tabs.parents('.ltabs-tabs-container').attr('data-sm'),

		$col_xs = $tabs.parents('.ltabs-tabs-container').attr('data-xs'),

		

		

		$items_content = $('.ltabs-items', $element),

		$items_inner = $('.ltabs-items-inner', $items_content),

		$items_first_active = $('.ltabs-items-selected', $element),

		$select_box = $('.ltabs-selectbox', $element),

		$tab_label_select = $('.ltabs-tab-selected', $element),

		setting = '2',

		type_show = 'slider';

		enableSelectBoxes();

		

		/* First Ajax Listing tabs*/

		var el = $('.tab-sel',$element).attr('data-active-content'),

			el_active = $(el,$element);

		listing_tab_ajax(el_active);

		

	function enableSelectBoxes() {

		$tab_wrap = $('.ltabs-tabs-wrap', $element),

			$tab_label_select.html($('.ltabs-tab', $element).filter('.tab-sel').children('.ltabs-tab-label').html());

		if ($(window).innerWidth() <= 991) {

			$tab_wrap.addClass('ltabs-selectbox');

		} else {

			$tab_wrap.removeClass('ltabs-selectbox');

		}

	}

	

	$('span.ltabs-tab-selected, span.ltabs-tab-arrow', $element).click(function() {

		if ($('.ltabs-tabs', $element).hasClass('ltabs-open')) {

			$('.ltabs-tabs', $element).removeClass('ltabs-open');

		} else {

			$('.ltabs-tabs', $element).addClass('ltabs-open');

		}

	});

	

	$(window).resize(function() {

		if ($(window).innerWidth() <= 991) {

			$('.ltabs-tabs-wrap', $element).addClass('ltabs-selectbox');

		} else {

			$('.ltabs-tabs-wrap', $element).removeClass('ltabs-selectbox');

		}

	});

	

	function showAnimateItems(el) {

		var $_items = $('.new-ltabs-item', el), nub = 0;

		$('.ltabs-loadmore-btn', el).fadeOut('fast');

		$_items.each(function (i) {

			nub++;

			switch(effect) {

				case 'none' : $(this).css({'opacity':'1','filter':'alpha(opacity = 100)'}); break;

				default: animatesItems($(this),nub*delay,i,el);

			}

			if (i == $_items.length - 1) {

				$('.ltabs-loadmore-btn', el).fadeIn(3000);

			}

			$(this).removeClass('new-ltabs-item');

		});

	}



	function animatesItems($this,fdelay,i,el) {

		var $_items = $('.ltabs-item', el);

		$this.stop(true, true).attr("style",

			"-webkit-animation:" + effect +" "+ duration +"ms;"

			+ "-moz-animation:" + effect +" "+ duration +"ms;"

			+ "-o-animation:" + effect +" "+ duration +"ms;"

			+ "-moz-animation-delay:" + fdelay + "ms;"

			+ "-webkit-animation-delay:" + fdelay + "ms;"

			+ "-o-animation-delay:" + fdelay + "ms;"

			+ "animation-delay:" + fdelay + "ms;").delay(fdelay).animate({

				opacity: 1,

				filter: 'alpha(opacity = 100)'

			}, {

				delay: 1000

			});

		if (i == ($_items.length - 1)) {

			$(".ltabs-items-inner").addClass("play");

		}

	}

	

	

	function updateStatus($el) {

		$('.ltabs-loadmore-btn', $el).removeClass('loading');

		var countitem = $('.ltabs-item', $el).length;

		$('.ltabs-image-loading', $el).css({display: 'none'});

		$('.ltabs-loadmore-btn', $el).parent().attr('data-rl_start', countitem);

		var rl_total = $('.ltabs-loadmore-btn', $el).parent().attr('data-rl_total');

		var rl_load = $('.ltabs-loadmore-btn', $el).parent().attr('data-rl_load');

		var rl_allready = $('.ltabs-loadmore-btn', $el).parent().attr('data-rl_allready');



		if (countitem >= rl_total) {

			$('.ltabs-loadmore-btn', $el).addClass('loaded');

			$('.ltabs-image-loading', $el).css({display: 'none'});

			$('.ltabs-loadmore-btn', $el).attr('data-label', rl_allready);

			$('.ltabs-loadmore-btn', $el).removeClass('loading');

		}

	}

	

	function listing_tab_ajax(category_id ) {	

		var parent_active = $(category_id),

		total_product = parent_active.data('total'),

		tab_active = $('.ltabs-items-inner', parent_active),

		nb_column0 = $col_lg,

		nb_column1 = $col_md,

		nb_column2 = $col_sm,

		nb_column3 = $col_xs;

		nb_margin = parseInt($margin);

		tab_active.owlCarousel2({

			nav: false,

			dots: false,

			

			loop: false,

			autoplay: false,

			lazyLoad: true,
			rtl: true,

			autoplayHoverPause: true,

			autoplayTimeout: 5000,

			autoplaySpeed: 5000,

			navRewind: true,

			navText: ['', ''],

			margin: nb_margin ,

			responsive: {

				0: {

					items: nb_column3,

					nav: total_product <= nb_column3 ? false : ((true) ? true : false),

				},

				767: {

					items: nb_column2,

					nav: total_product <= nb_column2 ? false : ((true) ? true : false),

				},

				991: {

					items: nb_column1,

					nav: total_product <= nb_column1 ? false : ((true) ? true : false),

				},

				1199: {

					items: nb_column0,

					nav: total_product <= nb_column0 ? false : ((true) ? true : false),

				},

			}

		});

		

		/*Quick View*/

		$('.iframe-link').magnificPopup({

			type:'iframe',

			fixedContentPos: true,

			fixedBgPos: true,

			overflowY: 'auto',

			closeBtnInside: true,

			closeOnContentClick: true,

			preloader: true,

			midClick: true,

			removalDelay: 300,

			mainClass: 'my-mfp-zoom-in',

			//gallery: {  enabled: true }

		});

		

		$( '.product_1846281811484147376 .thumbs-product .item-img', $element ).click(function() {

			$( '.product_1846281811484147376 .thumbs-product .item-img', $element ).removeClass('thumb-active');

			$(this).addClass('thumb-active');

			var thumb_src = $(this).attr("data-src");

			$( ".product_1846281811484147376 .product-image-container img").attr("src",thumb_src);

		}); 

	}

	

	$tab.on('click.ltabs-tab', function () {

		

		var $this = $(this);

		if ($this.hasClass('tab-sel')) return false;

		if ($this.parents('.ltabs-tabs').hasClass('ltabs-open')) {

			$this.parents('.ltabs-tabs').removeClass('ltabs-open');

		}

		$tab.removeClass('tab-sel');

		$this.addClass('tab-sel');

		var items_active = $this.attr('data-active-content');

		var _items_active = $(items_active,$element);

		$items_content.removeClass('ltabs-items-selected');

		_items_active.addClass('ltabs-items-selected');

		$tab_label_select.html($tab.filter('.tab-sel').children('.ltabs-tab-label').html());

		var $loading = $('.ltabs-loading', _items_active);

		var loaded = _items_active.hasClass('ltabs-items-loaded');

		

		

		type_show =$tabs.parents('.ltabs-tabs-container').attr('data-type_show');

		if (!loaded && !_items_active.hasClass('ltabs-process')) {

			_items_active.addClass('ltabs-process');

			var category_id 		= $this.attr('data-category-id'),

			path_url 	= 'ajax/listingtab_',

			ajax_url = $tabs.parents('.ltabs-tabs-container').attr('data-ajaxurl')+path_url+category_id+ '.html';

			

			$loading.show();

			$.ajax({

				type: 'POST',

				url: ajax_url,

				//dataType: 'json',// when on gave connection errors

				data: {

					is_ajax_listing_tabs: 1,

					ajax_reslisting_start: 1,

					categoryid: category_id,

					setting: setting,

					lbmoduleid: 1,

				},

				success: function (data) {

					

					if (data != '') {

						

						$('.ltabs-loading', _items_active).replaceWith(data);

						_items_active.addClass('ltabs-items-loaded').removeClass('ltabs-process');

						$loading.remove();

						if (type_show != 'slider') {

							showAnimateItems(_items_active);

						}

						updateStatus(_items_active);

						listing_tab_ajax(_items_active);

					}

					if(typeof(_SoQuickView) != 'undefined'){

						_SoQuickView();

					}

						

				},

				error: function(xhr, ajaxOptions, thrownError) {

					alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);

				}

				

			});



		} else {

			if (type_show == 'loadmore') {

				$('.ltabs-item', $items_content).removeAttr('style').addClass('new-ltabs-item');

				showAnimateItems(_items_active);

			}else{

				var $tag_id = $element;

				var owl = $('.owl2-carousel' , _items_active);

				var $navpage = $(".wap-listing-tabs", $tag_id);

				$navpage.siblings(".owl2-controls").addClass('hidden');

				

				owl = owl.data('owlCarousel2');

				

				if (typeof owl !== 'undefined') {

					owl.onResize();

				}

			}

		}

	});



})('#so_listing_tabs_0');



/* ---------------------------------------------------

	Owl carousel - Slider

-------------------------------------------------- */



$(document).ready(function ($) {

	"use strict";

	// Content slider

	$('.yt-content-slider').each(function () {

		var $slider = $(this),

			$panels = $slider.children('div'),

			data = $slider.data();

		// Remove unwanted br's

		//$slider.children(':not(.yt-content-slide)').remove();

		// Apply Owl Carousel

		

		$slider.owlCarousel2({

			responsiveClass: true,

			mouseDrag: true,

			video:true,

    		lazyLoad: (data.lazyload == 'yes') ? true : false,

			autoplay: (data.autoplay == 'yes') ? true : false,

			autoHeight: (data.autoheight == 'yes') ? true : false,

			autoplayTimeout: data.delay * 1000,

			smartSpeed: data.speed * 1000,

			autoplayHoverPause: (data.hoverpause == 'yes') ? true : false,

			center: (data.center == 'yes') ? true : false,

			loop: (data.loop == 'yes') ? true : false,

            dots: (data.pagination == 'yes') ? true : false,

            nav: (data.arrows == 'yes') ? true : false,

			dotClass: "owl2-dot",

			dotsClass: "owl2-dots",

            margin: data.margin,

            navText: ['',''],

			

			responsive: {

				0: {

					items: data.items_column4 

					},

				480: {

					items: data.items_column3

					},

				768: {

					items: data.items_column2

					},

				992: { 

					items: data.items_column1

					},

				1200: {

					items: data.items_column0 

					}

			}

		});

		

	});

// $(document).ready(function ($) {

// 	"use strict";

// 	$('.yt-content-slider').each(function () {

// 		var $slider = $(this),

// 			$panels = $slider.children('div'),

// 			data = $slider.data();

// 		$slider.owlCarousel2({
// 			rtl: true,
// 		});
// 	});
// });

$(document).ready(function ($) {

	"use strict";

	// Content slider

	$('.yt-content-slider').each(function () {

		var $slider = $(this),

			$panels = $slider.children('div'),

			data = $slider.data();

			$slider.owlCarousel2({

			responsiveClass: true,

			mouseDrag: true,

			video:true,
			rtl:(data.rtl == 'yes') ? true : false,

			});
	});
});		

	function buttonpage(element){

		var $element = $(element),

			$slider = $(".yt-content-slider", $element),

			data = $slider.data();

		if (data.buttonpage == "top") {

			$(".owl2-controls",$element).insertBefore($slider);

			$(".owl2-dots",$element).insertAfter($(".owl2-prev", $slider));

		} else {

			$(".owl2-nav",$element).insertBefore($slider);

			$(".owl2-controls",$element).insertAfter($slider);

		}	

	}

	

	// Home 1 - Latest Blogs

	(function (element) {

		buttonpage(element);

	})(".blog-sidebar");

	

	(function (element) {

		buttonpage(element);

	})("#so_extra_slider_1");

	

	(function (element) {

		buttonpage(element);

	})("#so_extra_slider_2");



}); 





// click header search header 

$(document).ready(function($) {

	$( ".search-header-w .icon-search" ).click(function() {

	$('#sosearchpro .search').slideToggle(200);

	$(this).toggleClass('active');

	});

});



/* ---------------------------------------------------

	1.Home page 5

-------------------------------------------------- */



/* ---------------------------------------------------

	2.Home page 6

-------------------------------------------------- */





//BLOCK Newsleter Popup

$(document).ready(function($) {

	$(window).load(function () {

		$('.common-home').addClass('hidden-scorll');

		$('.so_newletter_custom_popup_bg').addClass('popup_bg');

		$('input[name=\'hidden-popup\']').on('change', function(){

			if ($(this).is(':checked')) {

				checkCookie();

			} else {

				unsetCookie("so_newletter_custom_popup");

			}

		});

		function unsetCookie( name ) {

			document.cookie = name + '=; expires=Thu, 01 Jan 1970 00:00:01 GMT;';

		}

		$('.popup-close').click(function(){

			var this_close = $('.popup-close');

			this_close.parents().find('.common-home').removeClass('hidden-scorll');

			this_close.parents().find('#container-module-newletter').remove();

		});

	});

});



function setCookie(cname, cvalue, exdays) {

	var d = new Date();

	console.log(d.getTime());

	d.setTime(d.getTime() + (exdays*24*60*60*1000));

	var expires = "expires="+d.toUTCString();

	document.cookie = cname + "=" + cvalue + "; " + expires;

}

function getCookie(cname) {

	var name = cname + "=";

	var ca = document.cookie.split(';');

	for(var i=0; i<ca.length; i++) {

		var c = ca[i];

		while (c.charAt(0)==' ') c = c.substring(1);

		if (c.indexOf(name) == 0) return c.substring(name.length, c.length);

	}

	return "";

}

function checkCookie() {

	var check_cookie = getCookie("so_newletter_custom_popup");

	if(check_cookie == ""){

		setCookie("so_newletter_custom_popup", "Newletter Popup", 1 );

	}

}

function subscribe_newsletter()

{

	var emailpattern = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

	var email = $('#txtemail').val();

	var d = new Date();

	var createdate = d.getFullYear() + '-' + (d.getMonth()+1) + '-' + d.getDate() + ' ' + d.getHours() + ':' + d.getMinutes() + ':' + d.getSeconds();

	var status   = 0;

	var dataString = 'email='+email+'&createdate='+createdate+'&status='+status;

	if(email != "")

	{

		if(!emailpattern.test(email))

		{

			$('.show-error').remove();

			$('.send-mail').after('<span class="show-error" style="color: red;margin-left: 10px"> Invalid Email </span>')

			return false;

		}

		else

		{

			$.ajax({

				url: 'index.php?route=extension/module/so_newletter_custom_popup/newsletter',

				type: 'post',

				data: dataString,

				dataType: 'json',

				success: function(json) {

					$('.show-error').remove();

					if(json.message == "Subscription Successfull") {

						checkCookie();

						$('.send-mail').after('<span class="show-error" style="color: #003bb3;margin-left: 10px"> ' + json.message + '</span>');

						setTimeout(function () {

							var this_close = $('.popup-close');

							this_close.parent().css('display', 'none');

							this_close.parents().find('.so_newletter_custom_popup_bg').removeClass('popup_bg');

						}, 3000);



					}else{

						$('.send-mail').after('<span class="show-error" style="color: red;margin-left: 10px"> ' + json.message + '</span>');

					}

					document.getElementById('signup').reset();

				}

			});

			return false;

		}

	}

	else

	{

		alert("Email Is Require");

		$(email).focus();

		return false;

	}

}







(function($) {

  function generateBarGraph(wrapper) {

    // Set Up Values Array

    var values = [];



    // Get Values and save to Array

    $(wrapper + ' .bar').each(function(index, el) {

      values.push($(this).data('value'));

    });



    // Get Max Value From Array

    var max_value = Math.max.apply(Math, values);



    // Set width of bar to percent of max value

    $(wrapper + ' .bar').each(function(index, el) {

      var bar = $(this),

          value = bar.data('value'),

          percent = Math.ceil((value / max_value) * 100);



      // Set Width & Add Class

      bar.width(percent + '%');

      bar.addClass('in');

    });

  }



  // Generate the bar graph on window load...

  $(window).on('load', function(event) {

    generateBarGraph('#dashboard-stats');

  });

})(jQuery); // Fully reference jQuery after this point.





$('#datetimepicker1').datetimepicker({

    defaultDate: new Date(),

    format: 'DD/MM/YYYY H:mm:ss',

    sideBySide: true

});





function readURL(input) {

    if (input.files && input.files[0]) {

        var reader = new FileReader();

        reader.onload = function(e) {

            $('#imagePreview').css('background-image', 'url('+e.target.result +')');

            $('#imagePreview').hide();

            $('#imagePreview').fadeIn(650);

        }

        reader.readAsDataURL(input.files[0]);

    }

}

$("#imageUpload").change(function() {

    readURL(this);

});




$(function(){
    $(document).scroll(function(){
        if($(this).scrollTop() >= $('#fixed-image').offset().top - 50) {
            $('#fixed-image').addClass('fixes-part');
        } 
        else{
        	$('#fixed-image').removeClass('fixes-part');
        }
    });
});

function sticky_relocate() {
    var window_top = $(window).scrollTop();
    var div_top = $('#image-part-fixed').offset().top - 100;
       if (window_top > div_top) {
       $('#fixed-image').addClass('fixes-part');
       } 
       else {
            $('#fixed-image').removeClass('fixes-part');
        }
    var div_top = $('#relatedproduct').offset().top - 600;
    if (window_top > div_top) {
    $('#fixed-image').removeClass('fixes-part');
    } 
    }
    $(function() {
    $(window).scroll(sticky_relocate);
    sticky_relocate();
    });
