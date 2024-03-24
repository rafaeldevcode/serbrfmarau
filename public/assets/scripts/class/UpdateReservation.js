'use strict';

class UpdateReservation {
    static payment () {
        $('[data-reservation-payment]').on('click', async (event) => {
            const id = $(event.target).attr('data-reservation-payment');
            const payment = event.target.checked ? 'on' : 'off';
            const formData = new FormData();
            const pather = $(event.target).parent().parent();

            formData.append('id', id);
            formData.append('payment', payment);
            formData.append('type', 'payment');

            const response = await this.update('/api/reservation/update', formData);
            
            if (response.success) { 
                Message.create(response.message, 'success');
            }

            if (response.data.payment === 'off') {
                pather.find('[data-status]').text('Não');
                pather.find('[data-status]').removeClass('bg-primary');
                pather.find('[data-status]').addClass('bg-danger');
            } else {
                pather.find('[data-status]').text('Sim');
                pather.find('[data-status]').removeClass('bg-danger');
                pather.find('[data-status]').addClass('bg-primary');
            }
        });

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

            const response = await this.update('/api/reservation/update', formData);
            
            if (response.success) { 
                Message.create(response.message, 'success');
            }
        });

        return this;
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
}
