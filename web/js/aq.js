(function($) {
	const functions = {
		clickCancelChildren: function(elem, event) {
			let status = false;

			(function recurs() {
				elem.children().each(function(i, el) {
					if (el === event) {
						status = true;
					} else {
						elem = $(el);
						recurs();
					}
				});
			})();

			return status;
		},
		startPosition: function(options) {
			const before = getComputedStyle(options.element.get(0), ':before') ?? 0;
			let css = {};

			switch (options.position) {
				case 'top':
					$(options.element).css({
						top: $(options.target).offset().top - $(options.element).outerHeight() - parseInt(before.width) - (parseInt(before.borderWidth) * 2) + 'px',
						left: $(options.target).offset().left - ($(options.element).outerWidth() / 2) + ($(options.target).outerWidth() / 2) + 'px'
					});
					css = {top: '+=5px'};
				break;
				case 'right':
					$(options.element).css({
						top: $(options.target).offset().top - ($(options.element).outerHeight() / 2) + ($(options.target).outerHeight() / 2) + 'px',
						left: $(options.target).offset().left + $(options.target).outerWidth() + parseInt(before.width) + (parseInt(before.borderWidth) * 2) + 'px'
					});
					css = {left: '-=5px'};
				break;
				case 'bottom':
					$(options.element).css({
						top: $(options.target).offset().top + $(options.target).outerHeight() + parseInt(before.width) + (parseInt(before.borderWidth) * 2) + 'px',
						left: $(options.target).offset().left - ($(options.element).outerWidth() / 2) + ($(options.target).outerWidth() / 2) + 'px'
					});
					css = {top: '-=5px'};
				break;
				case 'left':
					$(options.element).css({
						top: $(options.target).offset().top - ($(options.element).outerHeight() / 2) + ($(options.target).outerHeight() / 2) + 'px',
						left: $(options.target).offset().left - $(options.element).outerWidth() - parseInt(before.width) - (parseInt(before.borderWidth) * 2) + 'px'
					});
					css = {left: '+=5px'};
				break;
			}

			$(options.element).animate({opacity: 1, ...css}, options.duration);
		},
		endPosition: function(options) {
			let css = {};

			switch (options.position) {
				case 'top':
					css = {top: '-=5px'};
				break;
				case 'right':
					css = {left: '+=5px'};
				break;
				case 'bottom':
					css = {top: '+=5px'};
				break;
				case 'left':
					css = {left: '-=5px'};
				break;
			}

			$(options.element).animate({opacity: 0, ...css}, options.duration, function() {
				$(this).remove();
			});
		}
	};
	const methods = {
		init: function() {},
		tooltip: function(options) {
			const settings = $.extend({
				container: 'body',
				position : 'top',
				duration : 200,
				theme    : 'light'
			}, options);

			for (const element of this) {
				const tooltip_container = $('<div>').addClass([
					'aq-tooltip-container',
					settings.position,
					settings.theme
				]);

				$(element).on('mouseenter', function() {
					$(tooltip_container).html($(element).attr('title'));
					$(element).attr('data-title', $(element).attr('title')).removeAttr('title');

					$(settings.container).append(tooltip_container);

					functions.startPosition({
						position: settings.position,
						element : tooltip_container,
						target  : element,
						duration: settings.duration
					});
				}).on('mouseleave', function() {
					$(element).attr('title', $(element).data('title')).removeAttr('data-title');

					functions.endPosition({
						position: settings.position,
						element : tooltip_container,
						duration: settings.duration
					});
				});
			}
		},
		tooltipBox: function(options) {
			const settings = $.extend({
				container: 'body',
				position : 'top',
				duration : 200,
				text     : null,
				theme    : 'light'
			}, options);

			for (const element of this) {
				if ($('*').is('.aq-tooltip-box-container') && $(element).hasClass('event-click')) return;

				const tooltip_box_container = $('<div>').addClass([
					'aq-tooltip-box-container',
					settings.position,
					settings.theme
				]).html(settings.text);

				$(element).addClass('event-click');
				$(settings.container).append(tooltip_box_container);

				functions.startPosition({
					position: settings.position,
					element : tooltip_box_container,
					target  : element,
					duration: settings.duration
				});

				$(document).bind('click', function(e) {
					if (e.target === element ||
						functions.clickCancelChildren($(element), e.target) ||
						$(e.target) === tooltip_box_container ||
						functions.clickCancelChildren(tooltip_box_container, e.target)
					) return;

					$(element).removeClass('event-click');

					functions.endPosition({
						position: settings.position,
						element : tooltip_box_container,
						duration: settings.duration
					});
				});
			};
		},
		box: function(options) {
			const settings = $.extend({
				container: 'body',
				width    : 'auto',
				height   : 'auto',
				title    : null,
				html     : null,
				ajax     : {}
			}, options);


			const box_overlay         = $('<div>').addClass('aq-box-overlay');
			const box_container       = $('<div>').addClass('aq-box-container');
			const box_header          = $('<div>').addClass('aq-box-header');
			const box_title           = $('<div>').addClass('aq-box-title').html(settings.title);
			const box_btn_close       = $('<div>').addClass('aq-box-btn-close');
			const box_body            = $('<div>').addClass('aq-box-body');
			const preloader_container = $('<div>').addClass('aq-box-preloader-container');
			const preloader           = $('<div>').addClass('aq-box-preloader');

			box_container.css({
				width: settings.width,
				height: settings.height
			});

			preloader_container.append(preloader);
			box_header.append(box_title, box_btn_close);
			box_container.append(box_header, box_body);
			box_overlay.append(box_container);
			$(settings.container).append(box_overlay);

			$(window).scroll(function() {
				box_overlay.css({
					top: $(window).scrollTop() + 'px',
					position: 'absolute'
				});
			});

			if (settings.ajax.url) {
				$.ajax({
					...settings.ajax,
					beforeSend: function() {
						box_body.html(preloader_container);
					},
					success: function(data) {
						box_body.html(data);
					}
				});
			} else {
				box_body.html(settings.html);
			}

			box_btn_close.on('click', function() {
				box_overlay.remove();
			});
		},
		select: function(options) {
			const settings = $.extend({
				width    : 'auto',
				height   : 'auto',
				font_size: '14px',
				duration : 200,
				theme    : 'light'
			}, options);

			for (const element of this) {
				let event_click = false;

				$(element).css({display: 'none'});

				const select_container = $('<div>').addClass('aq-select-container').css({
					width: settings.width,
					fontSize: settings.font_size
				});
				const select_input = $('<div>').addClass([
					'aq-select-input',
					settings.theme
				]).css({
					width : '100%',
					height: settings.height
				}).html($(element).find('option:selected').html());

				select_container.append(select_input);
				$(element).after(select_container);

				select_input.on('click', function() {
					event_click = (event_click) ? false : true;

					if (event_click) {
						const select_items_container = $('<div>').addClass([
							'aq-select-items-container',
							settings.theme
						]).css({width: settings.width});

						$(element).find('option').each(function(index, item) {
							const select_item = $('<div>').addClass([
								'aq-select-item',
								settings.theme
							]).html($(item).html());

							if (item.selected) select_item.addClass('selected');
							if (item.disabled) select_item.addClass('disabled');

							select_item.on('click', function() {
								if ($(this).hasClass('disabled')) {
									event_click = true;
								} else {
									event_click = false;

									select_input.html(item.innerHTML);
									$(element).prop('selectedIndex', index).trigger('change');
								}
							});

							select_items_container.append(select_item);
						});

						select_container.append(select_items_container);

						const position = ($(window).outerHeight() + window.scrollY > parseInt(select_container.offset().top + select_container.outerHeight() + select_items_container.outerHeight())) ? 'bottom' : 'top';

						select_items_container.toggleClass(position);

						switch (position) {
							case 'top':
								select_items_container.css({
									top: -select_items_container.outerHeight() - 7 + 'px',
									left: (select_container.outerWidth() / 2) - (select_items_container.outerWidth() / 2) + 'px'
								}).animate({opacity: 1, top: '+=5px'}, settings.duration);
							break;
							case 'bottom':
								select_items_container.css({
									top: select_input.outerHeight() + 7 + 'px',
									left: (select_container.outerWidth() / 2) - (select_items_container.outerWidth() / 2) + 'px'
								}).animate({opacity: 1, top: '-=5px'}, settings.duration);
							break;
						}

						$(document).bind('click', function(e) {
							if ($(e.target) === select_input ||
								functions.clickCancelChildren(select_container, e.target) &&
								event_click
							) return;

							event_click = false;

							functions.endPosition({
								position: position,
								element : select_items_container,
								duration: settings.duration
							});
						});
					}
				});
			};
		},
		calendar: function(options) {
			const settings = $.extend({
				container : 'body',
				position  : 'top',
				duration  : 200,
				elem_click: null,
				theme     : 'light',
				week_name : [
					'Пн',
					'Вт',
					'Ср',
					'Чт',
					'Пт',
					'Сб',
					'Вс'
				],
				month_name: [
					'Янв',
					'Фев',
					'Мар',
					'Апр',
					'Май',
					'Июн',
					'Июл',
					'Авг',
					'Сен',
					'Окт',
					'Ноя',
					'Дек'
				]
			}, options);

			for (const element of this) {
				let event_click = false;

				const elem_click = settings.elem_click ?? element;

				$(elem_click).on('click', function(e) {
					e.preventDefault();

					if (event_click) return;

					event_click = true;

					const current_date = (isNaN(Date.parse(element.value)))
					? new Date()
					: new Date(element.value);

					let current_day   = current_date.getDate();
					let current_month = current_date.getMonth();
					let current_year  = current_date.getFullYear();

					const calendar_container       = $('<div>').addClass(['aq-calendar-container', settings.theme]);
					const calendar_days_container  = $('<div>').addClass('aq-calendar-days-container');
					const calendar_days_table      = $('<table>').addClass(['aq-calendar-days-table', settings.theme]);
					const calendar_month_container = $('<div>').addClass(['aq-calendar-month-container', settings.theme]);
					const calendar_year_container  = $('<div>').addClass('aq-calendar-year-container');
					const calendar_year_input      = $('<input type="text" maxlength="4">').addClass('aq-calendar-year-input').val(current_year);
					const calendar_month_table     = $('<div>').addClass(['aq-calendar-month-table', settings.theme]);

					renderDays();
					renderMonth();

					calendar_year_input.on('input', function() {
						let value = this.value;

						if (!value.match(/^(\d+)$/g)) {
							value = value.substring(0, value.length - 1);
							this.value = value;

							return false;
						}

						renderDays();
					});

					calendar_days_container.append(calendar_days_table);
					calendar_year_container.append(calendar_year_input);
					calendar_month_container.append(calendar_year_container);
					calendar_month_container.append(calendar_month_table);
					calendar_container.append(calendar_days_container, calendar_month_container);
					$(settings.container).append(calendar_container);

					const position = ($(window).outerHeight() + window.scrollY > parseInt($(element).offset().top + $(element).outerHeight() + calendar_container.outerHeight())) ? 'bottom' : 'top';

					calendar_container.toggleClass(position);

					functions.startPosition({
						position: position,
						element : calendar_container,
						target  : elem_click,
						duration: settings.duration
					});

					$(document).bind('click', function(e) {
						if ($(e.target) === calendar_container ||
							e.target === element ||
							e.target === elem_click &&
							event_click ||
							$(e.target).hasClass('aq-calendar-month-container') ||
							functions.clickCancelChildren(calendar_month_container, e.target)
						) return;

						event_click = false;

						functions.endPosition({
							position: position,
							element : calendar_container,
							duration: settings.duration
						});
					});

					function renderDays() {
						calendar_days_table.html('');

						const week_row = $('<tr>');

						calendar_days_table.append(week_row);

						for (const week_name of settings.week_name) {
							week_row.append($('<th>').html(week_name));
						}

						calendar_days_table.append(week_row);

						const prev_days    = new Date(calendar_year_input.val(), current_month, 0).getDay();
						const day_of_month = new Date(calendar_year_input.val(), current_month + 1, 0).getDate();
						const next_days    = new Date(calendar_year_input.val(), current_month, day_of_month).getDay();

						calendar_days_table.append($('<tr>'));

						for (let i = 0; i < prev_days; i++) {
							calendar_days_table.children('tr').last().append($('<td>'));
						}

						for (let i = 1; i <= day_of_month; i++) {
							const td = $('<td>').addClass('aq-calendar-day').html(i.toString());

							if (i === current_day &&
								parseInt(current_month) === parseInt(current_date.getMonth()) &&
								parseInt(current_year) === parseInt(calendar_year_input.val())) {
									td.addClass('active');
							}

							calendar_days_table.children('tr').last().append(td);

							if (new Date(new Date(calendar_year_input.val(), current_month, 1).getFullYear(), new Date(calendar_year_input.val(), current_month, 1).getMonth(), i).getDay() === 0 && i !== day_of_month) {
								calendar_days_table.append($('<tr>'));
							}

							td.on('click', function() {
								insertDate(i);
							});
						}

						if (next_days !== 0) {
							for (let i = next_days; i < 7; i++) {
								calendar_days_table.children('tr').last().append($('<td>'));
							}
						}
					}

					function renderMonth() {
						for (let i = 0; i <= 11; i++) {
							let month = $('<div>').html(settings.month_name[i]).addClass('aq-calendar-month-name');

							if (i === parseInt(current_month)) {
								month.addClass('active');
							}

							month.on('click', function() {
								current_month = i;

								calendar_month_table.children().removeClass('active');
								$(this).addClass('active');

								renderDays();
							});

							calendar_month_table.append(month);
						}
					}

					function insertDate(day) {
						current_month = (current_month + 1 < 10) ? '0' + (current_month + 1) : current_month + 1;
						day = (parseInt(day) < 10) ? '0' + day : day;
						$(element).val(calendar_year_input.val() + '-' + current_month + '-' + day);
					}
				});
			}
		},
		phoneMask: function(options) {
			const settings = $.extend({
				mask   : '+7 (___) ___ __ __'
			}, options);

			for (const element of this) {
				$(element).attr('placeholder', settings.mask);

				$(element).on('input', function(event) {
					let keyCode = event.keyCode && (keyCode = event.keyCode);
					let pos = element.selectionStart;

					if (pos < 3) event.preventDefault();

					let i = 0;
					let def = settings.mask.replace(/\D/g, '');
					let val = element.value.replace(/\D/g, '');
					let new_value = settings.mask.replace(/[_\d]/g, function (a) {
						return i < val.length ? val.charAt(i++) || def.charAt(i) : a;
					});

					i = new_value.indexOf('_');

					if (i != -1) {
						i < 5 && (i = 3);
						new_value = new_value.slice(0, i);
					}

					let reg = settings.mask.substr(0, element.value.length).replace(/_+/g, function(a) {
						return '\\d{1,' + a.length + '}'
					}).replace(/[+()]/g, '\\$&');

					reg = new RegExp('^' + reg + '$');

					if (!reg.test(element.value) || element.value.length < 5 || keyCode > 47 && keyCode < 58) element.value = new_value;
					if (event.type == 'blur' && this.value.length < 5) element.value = ''
				});
			}
		}
	};

	$.fn.aq = function(method) {
		if (methods[method]) {
			return methods[method].apply(this, Array.prototype.slice.call(arguments, true));
		} else if (typeof method === 'object' || ! method) {
			return methods.init.apply(this, arguments);
		}
	}
})(jQuery);