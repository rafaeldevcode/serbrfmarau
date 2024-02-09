'use strict';

/**
 * @since 1.6.0
 */
class ChangeLocationMaps{
    /**
     * @since 1.6.0
     * 
     * @param {object} event 
     */
    static init(event){
        const value = event.target.value;
        const regex = /src="([^"]+)"/;
        const match = value.match(regex);

        if (match) {
            const srcValue = match[1];
            
            $(event.target).val(srcValue);
          } else {
            $(event.target).val(value);
          }
    }
}
