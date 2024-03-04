'use strict';

/**
 * Search and manipulate schedules for event management
 */
class HoursAvailable {
    /**
     * @since 1.7.0
     * 
     * @returns void
     */
    constructor () {
        this.location = $('#location_id');
        this.date = $('#date');
        this.reservetionId = $('#reservation_id');
        this.day = $('#day');
        this.period = $('#period');
        this.getHour = true;
        this.price = 0;
    }

    /**
     * @since 1.7.0
     * 
     * @returns {Object}
     */
    submited () {
        $('#save-hours').on('submit', (event) => {
            if (this.validityHours()) {
                $('#save-hours').submit();
            } else {
                event.preventDefault();

                $('#get-hours').click();
                Message.create('É necessário escolher os horários!', 'danger');
            }
        });

        return this;
    }

    /**
     * @since 1.7.0
     * 
     * @returns {Object}
     */
    selectSeveralHours () {
        $(document).ready(function () {
            const checkboxes = $('[data-checked="hour"]');
            let firstChecked = null;

            checkboxes.on('change', function () {
                if ($(this).prop('checked')) {
                    if (firstChecked === null) {
                        firstChecked = checkboxes.index(this);
                    } else {
                        const lastIndex = checkboxes.index(this);

                        checkboxes.each(function (index, checkbox) {
                            if (!checkbox.disabled && index >= firstChecked && index <= lastIndex) {
                                $(this).prop('checked', true);
                            }
                        });
                    }
                }
            });
        });

        return this;
    }

    /**
     * @since 1.7.0
     * 
     * @returns {Object}
     */
    getHours () {
        if (this.getHour) {
            $('#get-hours').on('click', async (event) => {
                this.setLocation();
                Modal.open('hours');

                if (this.getHour) {
                    this.clearBlockHours();
                    let count = 0;

                    const response = await this.get();

                    this.price = response.price;
                
                    Object.keys(response.hours).forEach((key) => {
                        this.createBlockHour(response.hours[key], key); 
                        if(response.hours[key].checked){
                            count++;
                        }
                    });
        
                    Preloader.hide('hours');
                    this.selectSeveralHours();
    
                    this.getHour = false;

                    $('#total-value').text(`R$ ${this.price * count}`);
                }
            });
        }

        return this;
    }

    /**
     * @since 1.7.0
     * 
     * @returns {void}
     */
    setLocation () {
        $('#location').text(this.location.find(`option[value="${this.location.val()}"]`).text());
    }

    /**
     * @since 1.7.0
     * 
     * @returns {void}
     */
    setPrice () {
        let count = 0;
        const checkboxes = $('[data-checked="hour"]');

        if(!this.period.attr('disabled')) event.preventDefault();

        setTimeout(() => {
            checkboxes.each(function (index, checkbox) {
                if (checkbox.checked) {
                    count++;
                }
            });

            $('#total-value').text(`R$ ${this.price * count}`);
        }, 200);
    }

    /**
     * @since 1.7.0
     * 
     * @returns {void}
     */
    createBlockHour (data, key) {
        if(data.blocked && !data.checked) return;
        const classBlock = data.blocked ? 'border-danger bg-danger text-white opacity-50' : 'border-color-main';

        const block = $('<div />');

        const input = $('<input />');
        input.attr('data-checked', 'hour');
        input.attr({
            type: 'checkbox',
            name: 'hours[]',
            value: data.hour,
            class: 'hidden',
            id: `hour_${key}`
        });

        if (data.blocked) {
            input.attr('disabled', 'disabled');
        }

        if (data.checked) {
            input.attr('checked', 'checked');
        }

        const label = $('<label />');
        label.attr({
            class: `p-2 rounded border pointer text-gray-500 block ${classBlock}`,
            for: `hour_${key}`
        });

        const span = $('<span />');
        span.text(data.hour);

        label.append(span);
        block.append(input);
        block.append(label);

        $('[data-list="hours"]').append(block);

        this.calculateTotalHourlyValue(input);
    }

    /**
     * @since 1.7.0
     * 
     * @returns {void}
     */
    clearBlockHours () {
        $('[data-list="hours"]').html('');
    }

    /**
     * @since 1.7.0
     * 
     * @param {*}
     * @returns {void}
     */
    async togglePeriod(id) {
        const response = await this.getLocationType(id);

        if(response.success){
            if(response.data.type == 'period') {
                this.period.attr('disabled', false);
                this.period.parent().parent().parent().show()
            } else {
                this.period.attr('disabled', true);
                this.period.parent().parent().parent().hide()
            }
        }
    }

    /**
     * @since 1.7.0
     * 
     * @returns {Object}
     */
    changeLocation() {
        if(this.location.length > 0) this.togglePeriod(this.location.val())

        this.location.on('change', async (event) => {
            this.clearBlockHours();
            this.getHour = true;

            this.togglePeriod(event.target.value);
        });

        return this;
    }

    /**
     * @since 1.7.0
     * 
     * @returns {Object}
     */
    changeDate () {
        this.date.on('change', async (event) => {
            this.clearBlockHours();
            Preloader.show('hours');

            const response = await this.get();

            this.price = response.price;
        
            Object.keys(response.hours).forEach((key) => {
                this.createBlockHour(response.hours[key], key); 
            });

            Preloader.hide('hours');
            this.selectSeveralHours();
        });

        return this;
    }

    /**
     * @since 1.7.0
     * 
     * @returns {Object}
     */
    changePeiod () {
        this.period.on('change', async (event) => {
            this.clearBlockHours();

            this.clearBlockHours();
            Preloader.show('hours');

            const response = await this.get();

            this.price = response.price;
        
            Object.keys(response.hours).forEach((key) => {
                this.createBlockHour(response.hours[key], key); 
            });

            Preloader.hide('hours');
            this.selectSeveralHours();

            if (event.target.value.length > 0) {
                const hours = this.getHoursByPeriod();
                
                const checkboxes = $('[data-checked="hour"]');
        
                checkboxes.each(function (index, checkbox) {
                    if ($(checkbox).attr('disabled') !== 'disabled' && hours.includes($(checkbox).val())){
                        checkbox.checked = true;
                    }
                });
            }

            this.setPrice();
        });

        return this;
    }

    /**
     * @since 1.7.0
     * 
     * @returns {Object}
     */
    changeDay () {
        this.day.on('change', async (event) => {
            this.clearBlockHours();
            Preloader.show('hours');

            const response = await this.get();

            this.price = response.price;
        
            Object.keys(response.hours).forEach((key) => {
                this.createBlockHour(response.hours[key], key); 
            });

            Preloader.hide('hours');
            this.selectSeveralHours();
        });

        return this;
    }

    /**
     * @since 1.7.0
     * 
     * @returns {Object}
     */
    changeType () {
        const day = $('#day');
        const type = $('#type');

        if (type.val() === 'Fixo') {
            day.parent().parent().parent().show();
            day.removeAttr('disabled');

            this.date.parent().parent().parent().hide();
            this.date.attr('disabled', 'disabled');
        } else {
            day.parent().parent().parent().hide();
            day.attr('disabled', 'disabled');

            this.date.parent().parent().parent().show();
            this.date.removeAttr('disabled', 'disabled');
        }

        type.on('change', async (event) => {
            if (event.target.value === 'Fixo') {
                day.parent().parent().parent().show();
                day.removeAttr('disabled');

                this.date.parent().parent().parent().hide();
                this.date.attr('disabled', 'disabled');
            } else {
                day.parent().parent().parent().hide();
                day.attr('disabled', 'disabled');

                this.date.parent().parent().parent().show();
                this.date.removeAttr('disabled', 'disabled');
            }

            this.period.val('');
            this.day.val('');
            this.getHour = true;
        });

        return this;
    }

    /**
     * @since 1.7.0
     * 
     * @returns {boolean}
     */
    validityHours () {
        if (this.reservetionId.val()) return true;

        const checkboxes = $('[data-checked="hour"]');
        let isValid = false;

        checkboxes.each((key, checkbox) => {
            if (checkbox.checked) {
                isValid = true;
            }
        });

        return isValid;
    }

    /**
     * @since 1.7.0
     * 
     * @param {Object} checkbox 
     * @returns {void}
     */
    calculateTotalHourlyValue (checkbox) {
        checkbox.on('click', (event) => {
            this.setPrice();
        });
    }

    /**
     * @since 1.7.0
     * 
     * @returns {Array}
     */
    getHoursByPeriod () {
        const hours = [];
        const periods = {
            Manhã: {
                start: 8,
                end: 13
            },
            Tarde: {
                start: 13,
                end: 18
            },
            Noite: {
                start: 18,
                end: 23
            }
        }

        for (let i = 0; i < 24; i++) {
            if(i >= periods[this.period.val()].start && i <= periods[this.period.val()].end){
                let hourOne;
                let hourTwo;
    
                if (i < 10) {
                    hourOne = `0${i}:00`;
                    hourTwo = `0${i}:30`;
                } else {
                    hourOne = `${i}:00`;
                    hourTwo = `${i}:30`;
                }
    
                hours.push(hourOne);
                hours.push(hourTwo);
            }
        }

        hours.pop();

        return hours;
    }

    /**
     * @since 1.7.0
     * 
     * @returns {Promise}
     */
    get() {
        return new Promise((resolve, reject) => {
            $.ajax({
                url: route('/api/hours'),
                type: 'GET',
                processData: true,
                contentType: false,
                data: {
                    date: this.date.attr('disabled') === 'disabled' ? null : this.date.val(),
                    reservation_id: this.reservetionId.val(),
                    location_id: this.location.val(),
                    day: this.day.attr('disabled') === 'disabled' ? null : this.day.val()
                },
                success: function(response) {
                    resolve(response);
                },
                error: function(xhr, status, error) {
                    reject(error);
                }
            });
        });
    }

        /**
         * @since 1.7.0
         * 
         * @param {*}
         * @returns {Promise}
         */
        getLocationType(id) {
            return new Promise((resolve, reject) => {
                $.ajax({
                    url: route('/api/locations'),
                    type: 'GET',
                    processData: true,
                    contentType: false,
                    data: {
                        id: id
                    },
                    success: function(response) {
                        resolve(response);
                    },
                    error: function(xhr, status, error) {
                        reject(error);
                    }
                });
            });
        }
}
