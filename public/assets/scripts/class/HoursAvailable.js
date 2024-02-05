'use strict';

class HoursAvailable {
    constructor () {
        this.location = $('#location_id');
        this.date = $('#date');
        this.eventId = $('#event_id');
        this.day = $('#day');
        this.period = $('#period');
        this.getHour = true;
        this.price = 0;
    }

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

    setLocation () {
        $('#location').text(this.location.find(`option[value="${this.location.val()}"]`).text());
    }

    createBlockHour (data, key) {
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

    clearBlockHours () {
        $('[data-list="hours"]').html('');
    }

    changeLocation() {
        $('[data-change="locations"]').on('change', (event) => {
            this.clearBlockHours();
            this.getHour = true;
        });

        return this;
    }

    changeDate () {
        $('#date').on('change', async (event) => {
            this.clearBlockHours();
            Preloader.show('hours');

            const response = await this.get();

            this.priceprice;
        
            Object.keys(response.hours).forEach((key) => {
                this.createBlockHour(response.hours[key], key); 
            });

            Preloader.hide('hours');
            this.selectSeveralHours();
        });

        return this;
    }

    changePeiod () {
        $('#period').on('change', async (event) => {
            this.clearBlockHours();

            this.clearBlockHours();
            Preloader.show('hours');

            const response = await this.get();

            this.priceprice;
        
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
        });

        return this;
    }

    changeDay () {
        $('#day').on('change', async (event) => {
            this.clearBlockHours();
            Preloader.show('hours');

            const response = await this.get();

            this.priceprice;
        
            Object.keys(response.hours).forEach((key) => {
                this.createBlockHour(response.hours[key], key); 
            });

            Preloader.hide('hours');
            this.selectSeveralHours();
        });

        return this;
    }

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
        });

        return this;
    }

    validityHours () {
        if (this.eventId.val()) return true;

        const checkboxes = $('[data-checked="hour"]');
        let isValid = false;

        checkboxes.each((key, checkbox) => {
            if (checkbox.checked) {
                isValid = true;
            }
        });

        return isValid;
    }

    calculateTotalHourlyValue (checkbox) {
        const checkboxes = $('[data-checked="hour"]');
        let count = 0;

        checkbox.on('click', (event) => {
            setTimeout(() => {
                checkboxes.each(function (index, checkbox) {
                    if (checkbox.checked) {
                        count++;
                    }
                });

                $('#total-value').text(`R$ ${this.price * count}`);
            }, 100);
        });
    }

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

    get() {
        return new Promise((resolve, reject) => {
            $.ajax({
                url: route('/api/hours'),
                type: 'GET',
                processData: true,
                contentType: false,
                data: {
                    date: this.date.attr('disabled') === 'disabled' ? null : this.date.val(),
                    event_id: this.eventId.val(),
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
}
