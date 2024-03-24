'use strict';

class Reservations extends HoursAvailable {
    async init () {
        this.blockPreviusHours = false;
        const reservations = document.querySelectorAll('[data-reservation]');

        reservations.forEach((item) => {
            $(item).on('click', () => {
                if ($(item).attr('data-reservation') === 'false') {
                    this.removeOldHours();

                    $(item).find('[data-icon="id"]').css('transform', 'rotate(180deg)');
                    
                    this.date = $(item).parent().find('[data-date="date"]');
                    this.location = $(item).parent().find('[name="location_id"]');
                    this.typeReservation = $(item).parent().find('[name="type"]').val();
                    this.body = $(item).parent().find('[data-list="hours"]');

                    this.loadContent();
                    this.changeDate(item);

                    $(item).attr('data-reservation', true);
                }
            });
        });
    }

    changeDate (item) {
        this.date.on('change', () => {
            if ($(item).attr('data-reservation') === 'true') {
                this.body.html('');
                this.loadContent();
            }
        });
    }

    removeOldHours () {
        $('[data-icon="id"]').css('transform', 'rotate(0)');
        $('[data-reservation]').attr('data-reservation', false);
        $('[data-list="hours"]').html('');
    }

    async loadContent () {
        const response = await this.get();

        Object.keys(response.hours).forEach((key) => {
            this.createBlockHour(response.hours[key], key, response.hours[parseInt(key)+1], response.end_hour); 
        });
    }

    createBlockHour (date, key, nextDate, endHour) {
        if(date.blocked && !date.checked || (endHour == date.hour)) return;
        if (this.typeReservation === 'period' && !this.getHoursAllPeriods().includes(date.hour)) return;

        const hoursHidden = this.typeReservation == 'hour' ? [] : this.hoursHidden;
        const classHidden = hoursHidden.includes(date.hour) ? ' hidden' : '';
        const classChecked = date.checked ? 'bg-gray-100' : 'bg-white';
        const dateFormat = (this.type.val() === 'Normal' || this.type.val() === undefined) ? this.getDateFormated() : this.translateDay();

        const tr = $('<tr />');
        tr.attr('class', `${classChecked} border-b hover:bg-gray-100 text-gray-900${classHidden}`);

        const tdTitle = $('<td />');
        tdTitle.attr({
            class: 'px-2 py-4 whitespace-nowrap text-secondary flex flex-col-reverse items-start',
            scope: 'row'
        });
        tdTitle.text(`${dateFormat} - ${date.hour} às ${this.getLastHour(date.hour, nextDate.hour)}`);

        const tdPrice = $('<td />');

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

        input.attr('disabled', 'disabled');

        if (date.checked) {
            input.attr('checked', 'checked');
        }

        const label = $('<label />');
        label.attr({
            class: `p-2 rounded border pointer text-gray-500 block text-xs border-color-main`,
            for: `hour_${key}`
        });

        const span = $('<span />');
        span.text(date.checked ? 'Reservado' : 'Não reservado');

        label.append(span);
        block.append(input);
        block.append(label);
        tdAction.append(block);
        tr.append(tdTitle);
        tr.append(tdPrice);
        tr.append(tdAction);

        this.body.append(tr);
    }
}
