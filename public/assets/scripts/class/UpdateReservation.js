'use strict';

class UpdateReservation {
    static payment () {
        const reservations = document.querySelectorAll('[data-reservation-payment]');

        if (reservations) {
            reservations.forEach((item) => {
                this.eventClick(item);
            });
    
        }
        return this;
    }

    static status() {
        $('[data-reservation-status]').on('change', async (event) => {
            const id = $(event.target).attr('data-reservation-status');
            const status = $(event.target).val();
            const formData = new FormData();

            formData.append('id', id);
            formData.append('status', status);
            formData.append('type', 'status');

            const response = await this.update('/api/reservations/update', formData);
            
            if (response.success) { 
                Message.create(response.message, 'success');
            }
        });

        return this;
    }

    static openModal () {
        const buttons = document.querySelectorAll('[data-reservation]');

        if (buttons) {
            buttons.forEach((item) => {
                $(item).on('click', async (event) => {
                    $('[data-list="payments"]').html('');

                    Modal.open('payments');

                    const id = $(item).attr('data-reservation');

                    const response = await this.get(`/api/payments?id=${id}`);
                    
                    Object.keys(response.data).forEach((key) => {
                        this.createItem(response.data[key]); 
                    });
                });
            });
        }

        return this;
    }

    static eventClick (item) {
        $(item).on('click', async (event) => {
            const id = $(event.target).attr('data-reservation-payment');
            const payment = event.target.checked ? 'on' : 'off';
            const formData = new FormData();
            // const pather = $(event.target).parent().parent();

            formData.append('id', id);
            formData.append('payment', payment);
            formData.append('type', 'payment');

            const response = await this.update('/api/reservations/update', formData);
            
            if (response.success) { 
                Message.create(response.message, 'success');
            }

            // if (response.data.payment === 'off') {
            //     pather.find('[data-status]').text('Não');
            //     pather.find('[data-status]').removeClass('bg-primary');
            //     pather.find('[data-status]').addClass('bg-danger');
            // } else {
            //     pather.find('[data-status]').text('Sim');
            //     pather.find('[data-status]').removeClass('bg-danger');
            //     pather.find('[data-status]').addClass('bg-primary');
            // }
        });
    }

    static update (route, data) {
        return new Promise((resolve, reject) => {
            $.ajax({
                url: route,
                type: 'POST',
                data: data,
                processData: false,
                contentType: false,
                success: function(response) {
                    resolve(response);
                },
                error: function(xhr, status, error) {
                    reject(error);
                }
            });
        });
    }

    static get (route) {
        return new Promise((resolve, reject) => {
            $.ajax({
                url: route,
                type: 'GET',
                processData: false,
                contentType: false,
                success: function(response) {
                    resolve(response);
                },
                error: function(xhr, status, error) {
                    reject(error);
                }
            });
        });
    }

    static createItem (data) {
        const content = $('<div />');
        content.attr('class', 'flex items-center justify-between border-b');

        const span = $('<span />');
        span.text(this.mountName(data.token));

        const input = this.createCheckBox(data.id, data.status);

        content.append(span);
        content.append(input);

        $('[data-list="payments"]').append(content);
    }

    static createCheckBox (id, status) {
        const label = $('<label />');
        label.attr('class', 'relative inline-flex items-center my-3 pointer');

        const input = $('<input />');
        input.attr({
            type: 'checkbox',
            class: 'sr-only peer',
            id: 'payment',
            name: 'payment'
        });
        input.attr('data-reservation-payment', id);

        if (status === 'on') {
            input.attr('checked', true);
        }

        const div = $('<div />');
        div.attr('class', "w-11 h-6 bg-secondary rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-secondary after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-color-main");

        const span1 = $('<span />');
        span1.attr('class', 'ml-3 text-sm font-medium text-secondary');

        const span2 = $('<span />');
        span2.attr('class', 'text-danger');

        span1.append(span2);

        label.append(input);
        label.append(div);
        label.append(span1);

        this.eventClick(input);

        return label;
    }

    static mountName (token) {
        const months = ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Nov', 'Out', 'Nov', 'Dez'];
        const arr = token.split(':');
        const text = `${months[arr[1]-1]} de ${arr[0]} - Semana ${arr[2]}`;

        return text;
    }
}
