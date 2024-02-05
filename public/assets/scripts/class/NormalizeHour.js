'use strict';

/**
 * Scripts to normalize minutes
 */
class NormalizeHour {
    /**
     * @since 1.7.0
     * @returns {void}
     */
    static init() {
        $('[data-input="hour"]').on('input', (event) => {
            var selectedTime = event.target.value.split(':');
            var minutes = selectedTime[1];

            if (minutes < 15) {
                minutes = '00';
            } else if (minutes < 45) {
                minutes = '30';
            } else {
                // Ajustar apenas os minutos sem incrementar a hora
                minutes = '00';
            }

            event.target.value = selectedTime[0] + ':' + minutes;
        });
    }
}

