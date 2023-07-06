window.addEventListener('popstate', function(event) {
	if (event.state) {
		ajax.Url({
			href       : event.state.link,
			eventstate : false
		});
	}
}, false);

const ajax = {
	Url : function(options) {
		const settings = Object.assign({}, {
			eventstate: true,
			top       : true,
			container : '#app',
			href      : window.location.href
		}, options);

		if (settings.eventstate) {
			history.pushState({link: settings.href}, null, settings.href);
		}

		$(settings.container).load(settings.href, {ajax: 'yes'});

		if (settings.top) {
			$('html, body').animate({scrollTop: 0}, 100);
		}
	},
	Reload: function(options) {
		const settings = Object.assign({}, {
			eventstate: true,
			top       : true,
			container : '#app',
			href      : window.location.href
		}, options);

		this.Url(settings);
	}
}

function setMeta(title, des, key) {
	document.title = title;
	document.description = des;
	document.keywords = key;
}

function eventKey(event) {
	return (event.which == null) ? event.keyCode : event.which;
}

function limitChar(elem, max_lenght, elem_out) {
	$(elem).bind('input propertychange', function() {
		let count    = $(this).val().length,
			num      = max_lenght - count,
			elem_val = $(this).val();

		if (num < 0) {
			$(this).val(elem_val.substr(0, max_lenght));
			return false;
		}

		$(elem_out).html(num);
	});
}

function formSubmit(form) {
	const preloader_container = $('<div>').addClass('button-preloader-container');
	const preloader = $('<div>').addClass('button-preloader');

	if ($('.form-notice').length) {
		$('.form-notice').remove();
	}

	$.ajax({
		url: $(form).attr('action'),
		method: 'POST',
		processData: false,
		contentType: false,
		cache: false,
		dataType: 'json',
		data: new FormData(form),
		beforeSend: function() {
			$(form).find('button[type="submit"]').attr('disabled', true);
			$(form).find('button[type="submit"] span').css({opacity: 0});

			preloader_container.append(preloader);
			$(form).find('button[type="submit"]').append(preloader_container);
		},
		complete: function() {
			$(form).find('button[type="submit"]').removeAttr('disabled');
			$(form).find('button[type="submit"] span').css({opacity: 1});
			preloader_container.remove();
		},
		success: function(data) {
			if (!data.status) {
				if (data.url) {
					if ($(form).attr('data-ajax')) {
						window.location.replace(data.url);
					} else {
						ajax.Url({
							href: data.url,
							top : false
						});
					}

					return false;
				}

				const form_notice = $('<div>').addClass('form-notice').html(data.text);
				const elem_target = $(data.element);

				elem_target.after(form_notice);

				form_notice.css({
					top: -form_notice.outerHeight() - 12 + 'px',
					left: (elem_target.outerWidth() / 2) - (form_notice.outerWidth() / 2) + 'px'
				}).animate({opacity: 1, top: '+=5px'}, 200);

				elem_target.focus();
			} else {
				if ($(form).attr('data-ajax')) {
					window.location.replace(data.url);
				} else {
					ajax.Url({
						href: data.url,
						top : false
					});
				}

				return false;
			}
		}
	});

	return false;
}

function dateTime(element) {
	const month_list = [
		'янв',
		'фев',
		'мар',
		'апр',
		'май',
		'июн',
		'июл',
		'авг',
		'сен',
		'окт',
		'ноя',
		'дек'
	];
	const day = $('<div>').addClass('date-time-day');
	const month = $('<div>').addClass('date-time-month');
	const year = $('<div>').addClass('date-time-year');
	const hours = $('<div>').addClass('date-time-hours');
	const separator = $('<div>').addClass('date-time-separator');
	const minutes = $('<div>').addClass('date-time-minutes');

	day.html((new Date().getDate() < 10) ? '0' + new Date().getDate() : new Date().getDate());
	month.html(month_list[new Date().getMonth()]);
	year.html(new Date().getFullYear());
	hours.html((new Date().getHours() < 10) ? '0' + new Date().getHours() : new Date().getHours());
	separator.html(':');
	minutes.html((new Date().getMinutes() < 10) ? '0' + new Date().getMinutes() : new Date().getMinutes());

	$(element).append(day, month, year, hours, separator, minutes);

	setInterval(function() {
		const now_date = new Date();
		const d = (now_date.getDate() < 10) ? '0' + now_date.getDate() : now_date.getDate();
		const h = (now_date.getHours() < 10) ? '0' + now_date.getHours() : now_date.getHours();
		const m = (now_date.getMinutes() < 10) ? '0' + now_date.getMinutes() : now_date.getMinutes();

		day.html(d);
		month.html(month_list[now_date.getMonth()]);
		year.html(now_date.getFullYear());
		hours.html(h);
		separator.html(':');
		minutes.html(m);
	}, 1000);
}