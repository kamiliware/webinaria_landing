module.exports = {
    mode: 'jit',
    purge: {
        content: [
            './src/**/*.php',
            './template-parts/**/*.php',
            './*.php',
            './inc/**/*.php',
            './inc/*.php',
            './src/**/*.js',
        ],
    },
    darkMode: 'media', //you can set it to media(uses prefers-color-scheme) or class(better for toggling modes via a button)
    theme: {
        colors: {
            transparent: 'transparent',
            white: '#ffffff',
            black: '#000000',
            violet: {
                light: '#3e2e8b',
                DEFAULT: '#342678',
                darker: '#352b5d',
                dark: '#20154c',
            },
            pink: {
                light: '#ff5a8d',
                DEFAULT: '#f8165d',
                dark: '#d2295d',
            },
            cyan: {
                DEFAULT: '#259dfe',
                dark: '#0093f1'
            },
            gray: {
                100: '#f5f5f5',
                200: '#aba6c1',
                300: '#989898',
                400: '#838589',
                800: '#3e3e3e',
            }
        },
        extend: {},
    },
    variants: {},
    plugins: [],
}