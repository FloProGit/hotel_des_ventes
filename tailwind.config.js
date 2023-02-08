/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./assets/**/*.js",
        "./templates/**/*.html.twig",
    ],
    theme: {
        extend: {
            colors: {
                "primary-color": "var(--primary-color)",
                "secondary-color": "var(--secondary-color)",
                "text-color": "var(--text-color)"
            },
            container: {
                padding: {
                    DEFAULT: '1rem',
                    sm: '2rem',
                    lg: '4rem',
                    xl: '5rem',
                    '2xl': '6rem',
                },
                
            },
        },
    },
    plugins: [],
}
