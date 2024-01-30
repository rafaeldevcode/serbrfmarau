/** 
 * @type {import('tailwindcss').Config} 
 * 
 */
module.exports = {
    content: [
        "./public/libs/tailwind/import.css",
        "./resources/errors/*.php",
        "./resources/partials/**/*.php",
        "./policies/*.php",
        "./*.php"
    ],
    theme: {
        screens: {
            sm: "540px",
            // => @media (min-width: 576px) { ... }

            md: "720px",
            // => @media (min-width: 768px) { ... }

            lg: "960px",
            // => @media (min-width: 992px) { ... }

            xl: "1140px",
            // => @media (min-width: 1200px) { ... }

            "2xl": "1320px",
            // => @media (min-width: 1400px) { ... }
        },
        container: {
            center: true,
            padding: "16px",
        },
        extend: {
            colors: {
                "color-main": "#3695FF",
                "primary": "#0062FF",
                "secondary": "#6C757D",
                "success": "#008000",
                "info": '#0DCAF0',
                "warning": "#FFFF00",
                "danger": "#FF0000",
                "light": '#FFFFFF',
                "dark": '#000000',
            },
            boxShadow: {
                input: "0px 7px 20px rgba(0, 0, 0, 0.03)",
                pricing: "0px 39px 23px -27px rgba(0, 0, 0, 0.04)",
                "switch-1": "0px 0px 5px rgba(0, 0, 0, 0.15)",
                testimonial: "0px 60px 120px -20px #EBEFFD",
            },
            zIndex: {
                "9999": "9999",
            }
        },
    },
    plugins: [
        function ({ addUtilities }) {
            const newUtilities = {
                '.btn': {
                    padding: '0.5rem 1rem',
                    borderRadius: '0.25rem',
                    display: 'block',
                },
                '.btn-danger': {
                    backgroundColor: '#FF0000',
                    border: '1px solid #FF0000',
                    color: '#fff',
                    transition: '.4s all',
                    '&:hover': {
                        backgroundColor: '#fff',
                        color: '#FF0000',
                    },
                },
                '.btn-primary': {
                    backgroundColor: '#0062FF',
                    border: '1px solid #0062FF',
                    color: '#fff',
                    transition: '.4s all',
                    '&:hover': {
                        backgroundColor: '#fff',
                        color: '#0062FF',
                    },
                },
                '.btn-color-main': {
                    backgroundColor: '#3695FF',
                    border: '1px solid #3695FF',
                    color: '#fff',
                    transition: '.4s all',
                    '&:hover': {
                        backgroundColor: '#fff',
                        color: '#3695FF',
                    },
                },
                '.btn-secondary': {
                    backgroundColor: '#6C757D',
                    border: '1px solid #6C757D',
                    color: '#fff',
                    transition: '.4s all',
                    '&:hover': {
                        backgroundColor: '#fff',
                        color: '#6C757D',
                    },
                },
                '.btn-info': {
                    backgroundColor: '#0DCAF0',
                    border: '1px solid #0DCAF0',
                    color: '#fff',
                    transition: '.4s all',
                    '&:hover': {
                        backgroundColor: '#fff',
                        color: '#0DCAF0',
                    },
                },
            };
      
            addUtilities(newUtilities, ['responsive', 'hover']);
        },
    ],
}
