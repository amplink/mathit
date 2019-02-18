(function($) {

    $.fn.homework_manegement_add = function(options) {

        if (typeof options == 'string' ) {
            var settings = options;
        }
        else {
            var settings = $.extend({
                placeholder: '선택',
                numDisplayed: 6,
                overflowText: '{n}개 선택됨',
                searchText: '문항 검색',
                showSearch: true
            }, options);
        }


        // 생성자
        function homework_manegement_add(select, settings) {
            this.$select = $(select);
            this.settings = settings;
            this.create();
        }

        // prototype
        homework_manegement_add.prototype = {
            create: function() {
                var add = this.$select.is('[custumdrop]') ? ' selector' : ''; //체크박스유무
                this.$select.wrap('<div class="placeholder' + add + '"></div>');
                this.$select.before('<div class="headbox"><div class="identifier">' +
                    this.settings.placeholder + '</div><span class="arrow"></span></div>');
                this.$select.before('<div class="combobox hidden"></div>');
                this.$select.addClass('hidden');
                this.reload();
            },

            reload: function() {
                var choices = '';
                if (this.settings.showSearch) {
                    choices += '<div class="search"><input type="search" placeholder="' +
                        this.settings.searchText + '" /></div>';
                }
                choices += this.build(this.$select);
                this.$select.siblings('.combobox').html(choices);
                this.reloadDropdown();
            },

            destroy: function() {
                var $wrap = this.$select.closest('.placeholder');
                $wrap.find('.headbox').remove();
                $wrap.find('.combobox').remove();
                this.$select.unwrap().removeClass('hidden');
            },

            build: function($element) {
                var $this = this;

                var choices = '';
                $element.children().each(function(i, el) {
                    var $el = $(el);

                    if ('optiongroup' == $el.prop('nodeName').toLowerCase()) {
                        choices += '<div class="options">';
                        choices += '<div class="group_label">' + $el.prop('label') + '</div>';
                        choices += $this.build($el);
                        choices += '</div>';
                    }
                    else {
                        var selected = $el.is('[selected]') ? ' selected' : '';
                        choices += '<div class="var_option' + selected + '" data-value="' + $el.prop('value') + '">' +
                            '<span class="checkbox"><i></i></span>' +
                            '<div class="room">' + $el.html() + '</div>' +
                            '</div>';
                    }
                });

                return choices;
            },

            reloadDropdown: function() {
                var $wrap = this.$select.closest('.placeholder');
                var settings = this.settings;
                var labelText = [];

                $wrap.find('.var_option.selected').each(function(i, el) {
                    labelText.push($(el).find('.room').text());
                });

                if (labelText.length < 1) {
                    labelText = settings.placeholder;
                }
                else if (labelText.length > settings.numDisplayed) {
                    labelText = settings.overflowText.replace('{n}', labelText.length);
                }
                else {
                    labelText = labelText.join(', ');
                }

                $wrap.find('.identifier').html(labelText);
                this.$select.trigger('change');
            }
        }
        // end   homework_manegement_add.prototype = {

        //각 매칭하는 요소 체크
        return this.each(function() {
            var data = $(this).data('homework_manegement_add');

            if (!data) {
                data = new homework_manegement_add(this, settings);
                $(this).data('homework_manegement_add', data);
            }

            if (typeof settings == 'string') {
                data[settings]();
            }
        });
    }

    // 이벤트
    $(document).on('click', '.identifier', function() {
        var $wrap = $(this).closest('.placeholder');
        $wrap.find('.combobox').toggleClass('hidden');
        $wrap.find('.search input').focus();
    });

    $(document).on('click', '.var_option', function() {
        var $this = this;
        var $wrap = $(this).closest('.placeholder');

        // select custumdrop="question"
        if ($wrap.hasClass('selector')) { //다중선택
            var selected = [];

            $(this).toggleClass('selected');
            $wrap.find('.var_option.selected').each(function(i, el) {
                selected.push($(el).attr('data-value'));
            });
        }
        // Single select
        else {
            var selected = $(this).attr('data-value');
            $wrap.find('.var_option').removeClass('selected');
            $(this).addClass('selected');
            $wrap.find('.combobox').hide();
        }

        $wrap.find('select').val(selected);
        $wrap.find('select').homework_manegement_add('reloadDropdown');
    });

    $(document).on('click', function(e) {
        var $wrap = $(e.target).closest('.placeholder');
        if ($wrap.length < 1) {
            $('.combobox').addClass('hidden');
        }
        else {
            var is_hidden = $wrap.find('.combobox').hasClass('hidden');
            $('.combobox').addClass('hidden');
            if (!is_hidden) {
                $wrap.find('.combobox').removeClass('hidden');
            }
        }
    });

    $(document).on('keyup', '.search input', function() {
        var $wrap = $(this).closest('.placeholder');
        var keywords = $(this).val();

        $wrap.find('.var_option, .group_label').removeClass('hidden');

        if ('' != keywords) {
            $wrap.find('.var_option').each(function() {
                var regex = new RegExp(keywords, 'gi');
                if (null === $(this).find('.room').text().match(regex)) {
                    $(this).addClass('hidden');
                }
            });

            $wrap.find('.group_label').each(function() {
                var num_visible = $(this).closest('.options').find('.var_option:not(.hidden)').length;
                if (num_visible < 1) {
                    $(this).addClass('hidden');
                }
            });
        }
    });

})(jQuery);