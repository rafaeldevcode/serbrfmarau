'use strict';

class Clients {
    static init(selector, route, placeholder){
        $(selector).select2({
            placeholder: placeholder,
            allowClear: true,
            dataType: 'json',
            minimumInputLength: 1,
            ajax: {
                url: route,
                delay: 250,
                method: "GET",
                cache: true,
                data: (params) => {
                    return {
                        search: params.term
                    };
                },
                processResults: (response) => {
                    const modifiedResults = response.data.map(item => {
                        return {
                            id: item.cpf,
                            cpf: item.cpf,
                            email: item.email,
                            phone: item.phone,
                            amount_people: item.amount_people,
                            event: item.event,
                            payment_type: item.payment_type
                        };
                    });
                
                    return {results: modifiedResults};
                }
            },
            templateResult: (response, params) => {
                if (response.loading) return 'Pesquisando...';

                const span = $('<span />');
                span.attr('data-client-id', response.id);
                span.attr('data-client-email', response.email);
                span.attr('data-client-phone', response.phone);
                span.attr('data-client-amount_people', response.amount_people);
                span.attr('data-client-event', response.event);
                span.attr('data-client-payment_type', response.payment_type);
                
                span.text(response.cpf);

                return span;
            },
            templateSelection: (response) => {                

                return response.cpf;
            }
        });
    }

    static insertClient(event){
        const option = $(`[data-client-id="${event.target.value}"]`);

        const email = option.attr('data-client-email');
        const phone = option.attr('data-client-phone');
        const amountPeople = option.attr('data-client-amount_people');
        const eventType = option.attr('data-client-event');
        const paymentType = option.attr('data-client-payment_type');

        $('#email').val(email);
        $('#phone').val(phone);
        $('#amount_people').val(amountPeople);
        $('#event_type').val(eventType);
        $('#payment_type').val(paymentType);
    }
}
