'use strict';

/**
 * Create or hiddens the message
 */
class Message{
    /**
     * Hidden message
     * 
     * @since 1.0.0
     * 
     * @param {string} elementIndentfy 
     * @return {void}
     */
    static hide(elementIndentfy){
        const message = $(elementIndentfy);
    
        setTimeout(()=>{
            message.attr('data-message', 'false');
    
            setTimeout(() => {
                message.remove();
            }, 1000);
        }, 5000);
    }
    
    /**
     * Create message
     * 
     * @since 1.0.0
     * 
     * @param {string} textMessage 
     * @param {string} typeMessage 
     * @returns {void}
     */
    static create(textMessage, typeMessage){
        const alert = $('<div />');
        alert.attr('class', `d-flex flex-row position-fixed end-0 top-0 m-2 p-0 shadow border border-${typeMessage} border-2 rounded bg-light`);
        alert.attr('data-message', 'true');

        const divIcon = $('<div />');
        divIcon.attr('class', `d-flex align-items-center bg-${typeMessage} py-1 px-2`);

        const icon = $('<i />');
        icon.attr('class', `bi ${this.getIcon(typeMessage)} text-light fs-5`);

        const message = $('<p />');
        message.attr('class', `d-flex align-items-center m-0 px-2 text-${typeMessage}`);
        message.text(textMessage);

        divIcon.append(icon);
        alert.append(divIcon);
        alert.append(message);
        $('body').append(alert);

        this.hide('[data-message=true]');
    }

    static getIcon(typeMessage){
        let classIcon;
        switch (typeMessage ) {
            case 'danger':
                classIcon = 'bi-dash-circle-fill';
                break;
            case 'success':
                classIcon = 'bi-check-circle-fill';
                break;
            case 'warning':
                classIcon = 'bi bi-exclamation-circle-fill';
                break;
            case 'secondary':
                classIcon = 'bi bi-question-circle-fill';
            default:
                classIcon = 'bi bi-question-circle-fill';
                break;
        }
        return classIcon;
    }
}
