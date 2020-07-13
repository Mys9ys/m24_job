(function($) {
	var methods;
	var customClass = 'custom-forms-wrapper';
	var customSelector = '.' + customClass;
	methods = {
		init: function (options) {
			return this.each(function () {
				var self = $(this);
				var inputs = self.children('input');
				self.addClass(customClass);
				//������ ��� �������
				inputs.each(function () {
					var self = $(this);
					var parent = self.parent(customSelector);
					switch( $(this).attr('type') ) {
						case 'checkbox':
							parent.addClass('checkbox');
							self.addClass('master');
							break;
						case 'radio':
							parent.addClass('radio');
							self.addClass('master');
							break;
						case 'text':
							parent.addClass('text');
							self.addClass('master');
							break;
						case 'file':
							parent.addClass('file');
							self.addClass('invisible');
							parent.append('<div class="master">�������� ����</div>');
							parent.append('<div class="slave file"></div>');
							parent.append('<div class="slave file-blocker"></div>');
							break;

					}
				});
				//�������������� ������ ������� � ���������� �� ��������� � �������
				inputs.each(function(){
					var parent = $(this).parent(customSelector);
					if ($(this).is(':checked'))
						parent.addClass('active');
					else
						parent.removeClass('active');

					if ($(this).is(':disabled'))
						parent.addClass('disable');
					else
						parent.removeClass('disable');
				});
				//��������� ���������
				inputs.change(function(){
					$(this).customForms('refresh');
				});
				//���������
				inputs.focus(function(){
					var parent = $(this).parent(customSelector);
					parent.addClass('focus');
				});
				inputs.blur(function(){
					var parent = $(this).parent(customSelector);
					parent.removeClass('focus');
				});
			});
		},
		refresh: function() {
			var parent = $(this).parent(customSelector);
			//������� ��������� � ������ �����
			if( $(this).is('[type=radio]') )
				$(customSelector + '.radio input[name="'+ $(this).attr('name') +'"]').each(function () {
					var parent = $(this).parent(customSelector);
					parent.removeClass('active');
				});
			//������ ��� � ����-�����
			if( $(this).is('[type=file]') ) {
				var file = $(this).val();
				file = file.replace("C:\\fakepath\\","");
				if (file) {
					parent.find('.master').text(file);
				} else {
					parent.find('.master').text('�������� ����');
				}
			}
			//����������� ������ ������������ ��������
			if ($(this).is(':checked'))
				parent.addClass('active');
			else
				parent.removeClass('active');

			if ($(this).is(':disabled'))
				parent.addClass('disable');
			else
				parent.removeClass('disable');
		}
	};
	$.fn.customForms = function ( method ) {
		if ( methods[method] ) {
			return methods[ method ].apply( this, Array.prototype.slice.call( arguments, 1 ));
		} else if ( typeof method === 'object' || ! method ) {
			return methods.init.apply( this, arguments );
		} else {
			$.error( '����� ' +  method + ' � jQuery.customForms �� ����������' );
		}
	};
})(jQuery);
