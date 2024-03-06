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
        this.type = $('#type');
        this.price = 0;
        this.countBlock = 0;
        this.typeReservation = null;
        this.hoursHidden = this.getHoursHidden();
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
        $(document).ready(async () => {
            this.clearBlockHours();
            Preloader.show('hours');

            const response = await this.get();

            this.price = response.price;

            if (response.message) {
                Message.create(response.message, 'info');
                this.createBlockMessage(response.message);
            } else {
                Object.keys(response.hours).forEach((key) => {
                    this.createBlockHour(response.hours[key], key, response.hours[parseInt(key)+1], response.end_hour); 
                });
            }

            if (this.countBlock === 0 && this.location.val() !== undefined) {
                Message.create('Todos os horários já reservados!', 'info');
                this.createBlockMessage('Todos os horários já reservados!'); 
            }

            Preloader.hide('hours');
            this.selectSeveralHours();

            this.setPrice();
        });

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
    setPrice (event = false) {
        let count = 0;
        const checkboxes = $('[data-checked="hour"]');

        if(!this.period.attr('disabled') && event) event.preventDefault();

        setTimeout(() => {
            checkboxes.each(function (index, checkbox) {
                if (checkbox.checked) {
                    count++;
                }
            });

            if(count > 0){
                $('#schedule').removeClass('hidden');
                $('#schedule').addClass('flex');
    
                $('#schedule').attr('data-cookies-show', true);
            } else {
                // $('#schedule').attr('data-cookies-show', false);

                // setInterval(() => {
                //     $('#schedule').addClass('hidden');
                //     $('#schedule').removeClass('flex');
                // }, 400);
            }

            if(count > 1){
                $('#schedule').find('button').removeAttr('disabled');
                $('#schedule').find('#warning').text('');
            } else {
                $('#schedule').find('button').attr('disabled', true);
                $('#schedule').find('#warning').text('Para proseguir selecione no mínimo dois blocos de horário!');
            }

            const price = this.typeReservation == 'hour' ? this.price * count : this.price;
            $('#total-value').text(`R$ ${price}`);
        }, 200);
    }

    /**
     * @since 1.7.0
     * 
     * @returns {void}
     */
    createBlockHour (date, key, nextDate, endHour) {
        if(date.blocked && !date.checked || (endHour == date.hour)) return;

        const hoursHidden = this.typeReservation == 'hour' ? [] : this.hoursHidden;
        const classHidden = hoursHidden.includes(date.hour) ? ' hidden' : '';
        const classBlock = date.blocked ? 'border-danger bg-danger text-white opacity-50' : 'border-color-main';
        const dateFormat = this.type.val() == 'Normal' ? this.getDateFormated() : this.translateDay();

        const tr = $('<tr />');
        tr.attr('class', `bg-white border-b hover:bg-gray-100 text-gray-900${classHidden}`);

        const tdTitle = $('<td />');
        tdTitle.attr({
            class: 'px-2 py-4 whitespace-nowrap text-secondary',
            scope: 'row'
        });
        tdTitle.text(`${dateFormat} - ${date.hour} às ${this.getLastHour(date.hour, nextDate.hour)}`);
        
        const tdPrice = $('<td />');
        tdPrice.attr({
            class: 'px-2 py-4 whitespace-nowrap text-secondary',
            scope: 'row'
        });
        tdPrice.text(`R$ ${this.price}`);

        const tdAction = $('<td />');
        tdAction.attr({
            class: 'px-2 py-4 whitespace-nowrap flex justify-end',
            scope: 'row'
        });

        const block = $('<div />');

        const input = $('<input />');
        input.attr('data-checked', 'hour');
        input.attr({
            type: 'checkbox',
            name: 'hours[]',
            value: date.hour,
            class: 'hidden',
            id: `hour_${key}`
        });

        if (date.blocked) {
            input.attr('disabled', 'disabled');
        }

        if (date.checked) {
            input.attr('checked', 'checked');
        }

        const label = $('<label />');
        label.attr({
            class: `p-2 rounded border pointer text-gray-500 block text-xs ${classBlock}`,
            for: `hour_${key}`
        });

        const span = $('<span />');
        span.text('Reservar');

        label.append(span);
        block.append(input);
        block.append(label);
        tdAction.append(block);
        tr.append(tdTitle);
        tr.append(tdPrice);
        tr.append(tdAction);

        $('[data-list="hours"]').append(tr);

        this.countBlock = this.countBlock + 1;

        this.calculateTotalHourlyValue(input);
    }

    /**
     * @since 1.7.0
     * 
     * @param {string} message
     * @returns {void}
     */
    createBlockMessage(message) {
        const tr = $('<tr />');
        tr.attr('class', 'border border-color-main rounded p-4 shadow-lg w-full');

        const td = $('<td />');
        td.attr({
            class: 'px-2 py-4 whitespace-nowrap text-secondary',
            scope: 'row'
        });

        const p = $('<p />');
        p.attr('class', 'text-center font-semibold text-secondary');
        p.text(message);

        td.append(p);
        tr.append(td);
        $('[data-list="hours"]').append(tr);
    }

    /**
     * @since 1.7.0
     * 
     * @returns {void}
     */
    clearBlockHours () {
        this.countBlock = 0;
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
                this.period.parent().parent().parent().show();

                this.type.attr('disabled', true);
                this.type.parent().parent().parent().hide();

                $('#email').attr('required', true);;
                $('[for=email]').find('span').text('*');
                $('#identifier').attr('required', true);
                $('[for=identifier]').find('span').text('*');
                $('#amount_people').attr('required', true);
                $('[for=amount_people]').find('span').text('*');
            } else {
                this.period.attr('disabled', true);
                this.period.parent().parent().parent().hide();

                this.type.attr('disabled', false);
                this.type.parent().parent().parent().show();

                $('#email').removeAttr('required');
                $('[for=email]').find('span').text('');
                $('#identifier').removeAttr('required');
                $('[for=identifier]').find('span').text('');
                $('#amount_people').removeAttr('required');
                $('[for=amount_people]').find('span').text('');
            }

            this.type.val('Normal');

            this.day.attr('disabled', true);
            this.day.parent().parent().parent().hide();

            this.date.attr('disabled', false);
            this.date.parent().parent().parent().show();
        }

        this.typeReservation = response.data.type;
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

            this.togglePeriod(event.target.value);

            this.getHours();
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

           this.getHours();
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
            Preloader.show('hours');

            const response = await this.get();

            this.price = response.price;

            if (response.message) {
                Message.create(response.message, 'info');
                this.createBlockMessage(response.message);
            } else {
                Object.keys(response.hours).forEach((key) => {
                    this.createBlockHour(response.hours[key], key, response.hours[parseInt(key)+1], response.end_hour); 
                });
            }

            if (this.countBlock === 0) {
                Message.create('Sem horários disponíves!', 'info');
                this.createBlockMessage('Sem horários disponíves!'); 
            }

            Preloader.hide('hours');
            this.selectSeveralHours();

            if (event.target.value.length > 0) {
                const hours = this.getHoursByPeriod();
                hours.pop();
                
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
            this.getHours();
        });

        return this;
    }

    /**
     * @since 1.7.0
     * 
     * @returns {Object}
     */
    changeType () {
        this.clearBlockHours();
        const day = $('#day');

        if (this.type.val() === 'Fixo') {
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

        this.type.on('change', async (event) => {
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
            this.getHours();
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
            this.setPrice(event);
        });
    }

    /**
     * @since 1.7.0
     * 
     * @returns {string}
     */
    translateDay(){
        const days = {
            Sunday: 'Domingo',
            Monday: 'Segunda',
            Tuesday: 'Terça',
            Wednesday: 'Quarta',
            Thursday: 'Quinta',
            Friday: 'Sexta',
            Saturday: 'Sábado'
        }

        return days[this.day.val()];
    }

    /**
     * @since 1.7.0
     * 
     * @returns {String}
     */
    getLastHour(hour, nextHour){
        if(this.typeReservation == 'hour') return nextHour;

        const manha = this.getHoursByPeriod('Manhã');
        const tarde = this.getHoursByPeriod('Tarde');
        const noite = this.getHoursByPeriod('Noite');

        if(manha.includes(hour) && !tarde.includes(hour)){
            return manha[manha.length-1];
        }

        if(tarde.includes(hour) && !noite.includes(hour)){
            return tarde[tarde.length-1];
        }

        if(noite.includes(hour)){
            return noite[noite.length-1];
        }
    }

    /**
     * @since 1.7.0
     * 
     * @returns {Array}
     */
    getHoursHidden(){
        const manha = this.getHoursByPeriod('Manhã');
        const tarde = this.getHoursByPeriod('Tarde');
        const noite = this.getHoursByPeriod('Noite');

        manha.shift();
        manha.pop();

        tarde.shift();
        tarde.pop();

        noite.shift();
        noite.pop();
        
        return [...manha, ...tarde, ...noite];
    }

    /**
     * @since 1.7.0
     * 
     * @param {string} period
     * @returns {Array}
     */
    getHoursByPeriod (customPeriod = false) {
        const hours = [];
        const periods = this.getPeriods();
        const period = customPeriod ? customPeriod : this.period.val();

        for (let i = 0; i < 24; i++) {
            if(i >= periods[period].start && i <= periods[period].end){
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
     * @returns {Object}
     */
    getPeriods(){
        return {
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
    }

    /**
     * @since 1.7.0
     * 
     * @returns {string}
     */
    getDateFormated() {
        const date = new Date(this.date.val());
        const days = ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb'];
        const months = ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'];
        const dayWeek = days[date.getDay()+1];
        const day = date.getDate()+1;
        const month = months[date.getMonth()];

        return dayWeek + ', ' + day + '/' + month;
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
                    location_id: this.location.val() === undefined ? 0 : this.location.val(),
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
