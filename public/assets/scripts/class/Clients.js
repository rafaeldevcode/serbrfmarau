'use strict';

class Clients {
    static init(selector, route, placeholder){
        $(selector).select2({
            placeholder: placeholder,
            allowClear: true,
            minimumInputLength: 1,
            allowClear: true,
            ajax: {
                url: route,
                dataType: 'json',
                delay: 250,
                method: "GET",
                cache: true,
                data: (params) => {
                    return {
                        search: params.term
                    };
                },
                processResults: (response, params) => {
                    if (response.data === null) {
                        const modifiedResults = [{
                            id: params.term,
                            cpf: params.term,
                            email: '',
                            phone: '',
                            amount_people: '0',
                            event: 'Jogo',
                            payment_type: 'Cartão de Débito'
                        }];

                        return {results: modifiedResults};
                    } else {
                        const modifiedResults = response.data.map(item => {
                            return {
                                id: item.cpf_cnpj,
                                cpf: item.cpf_cnpj,
                                email: item.email,
                                phone: item.phone,
                                amount_people: item.amount_people,
                                event: item.event,
                                payment_type: item.payment_type
                            };
                        });

                        return {results: modifiedResults};
                    }
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

                return response.cpf || response.text;
            },
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

    formatPhoneNumberByCountry(phoneNumber) {
        if (!phoneNumber) {
            return null;
        }
    
        // Remove qualquer caractere que não seja número ou '+'
        const cleaned = phoneNumber.replace(/[^\d+]/g, '');
    
        // Verifica formatos diferentes para números brasileiros
        let match;
        if ((match = cleaned.match(/^(\d{2})(\d{5})(\d{4})$/))) {
            // Formato com código de área (XX) XXXXX-XXXX
            return `(${match[1]}) ${match[2]}-${match[3]}`;
        } else if ((match = cleaned.match(/^(\d{2})(\d{4})(\d{4})$/))) {
            // Novo formato com código de área XX XXXX-XXXX
            return `${match[1]} ${match[2]}-${match[3]}`;
        } else if ((match = cleaned.match(/^(\d{5})(\d{4})$/))) {
            // Formato sem código de área XXXXX-XXXX
            return `${match[1]}-${match[2]}`;
        } else if ((match = cleaned.match(/^(\d{4})(\d{4})$/))) {
            // Formato com 8 dígitos (sem código de área) XXXX-XXXX
            return `${match[1]}-${match[2]}`;
        }
    
        return phoneNumber;
    }
    
}
