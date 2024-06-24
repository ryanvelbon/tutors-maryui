const defaultTheme = require('tailwindcss/defaultTheme')

module.exports = {
    daisyui: {
        themes: ['light', 'dark', 'cupcake'],
    },
    theme: {
        extend: {
            fontFamily: {
                sans: ['Inter var', ...defaultTheme.fontFamily.sans],
            },
            maxWidth: {
                '7xl': '84rem',
            },
            spacing: {
                '128': '32rem',
                '144': '36rem',
                '160': '40rem',
            },
        },
    },
    variants: {
        extend: {
            backgroundColor: ['active'],
        }
    },
    content: [
        './app/**/*.php',
        './resources/**/*.html',
        './resources/**/*.js',
        './resources/**/*.jsx',
        './resources/**/*.ts',
        './resources/**/*.tsx',
        './resources/**/*.php',
        './resources/**/*.vue',
        './resources/**/*.twig',
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/robsontenorio/mary/src/View/Components/**/*.php',
    ],
    plugins: [
        require('@tailwindcss/forms'),
        require('@tailwindcss/typography'),
        require('daisyui'),
    ],
}
