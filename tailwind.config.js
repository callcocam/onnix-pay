import colors from 'tailwindcss/colors'
const defaultTheme = require("tailwindcss/defaultTheme");
import forms from '@tailwindcss/forms'
import typography from '@tailwindcss/typography'
import preset from './vendor/filament/support/tailwind.config.preset'

const navyColor = {
    50: "#f7e7fe",
    100: "#efcffc",
    200: "#e6b7fb",
    300: "#de9ff9",
    400: "#d687f8",
    450: "#ce6ef7",
    500: "#c656f5",
    600: "#bd3ef4",
    700: "#b526f2",
    750: "#ad0ef1",
    800: "#9c0dd9",
    900: "#8a0bc1",
};

const customColors = {
    "banner-primary": '#7708aa',
    "banner-secundary": '#d72673',
    "bg-primary": '#7708aa',
    "bg-secundary": '#d72673',
    navy: navyColor,
    "slate-150": "#E9EEF5",
    primary: colors.indigo["600"],
    "primary-focus": colors.indigo["700"],
    "secondary-light": "#ff57d8",
    secondary: "#F000B9",
    "secondary-focus": "#BD0090",
    "accent-light": colors.indigo["400"],
    accent: "#5f5af6",
    "accent-focus": "#4d47f5",
    info: colors.sky["500"],
    "info-focus": colors.sky["600"],
    success: colors.emerald["500"],
    "success-focus": colors.emerald["600"],
    warning: "#ff9800",
    "warning-focus": "#e68200",
    error: "#ff5724",
    "error-focus": "#f03000",
};

export default {
    presets: [preset],
    content: [
        './resources/**/*.blade.php',
        './vendor/filament/**/*.blade.php',
        './app/Filament/**/*.php',
        './resources/views/filament/**/*.blade.php',
        './vendor/filament/**/*.blade.php',],
    theme: {
        extend: {
            colors: customColors,
            fontFamily: {
                sans: ["Poppins", ...defaultTheme.fontFamily.sans],
                inter: ["Inter", ...defaultTheme.fontFamily.sans],
            },
            fontSize: {
                tiny: ["0.625rem", "0.8125rem"],
                "tiny+": ["0.6875rem", "0.875rem"],
                "xs+": ["0.8125rem", "1.125rem"],
                "sm+": ["0.9375rem", "1.375rem"],
            }, 
            opacity: {
                15: ".15",
            },
            spacing: {
                4.5: "1.125rem",
                5.5: "1.375rem",
                18: "4.5rem",
            },
            boxShadow: {
                soft: "0 3px 10px 0 rgb(48 46 56 / 6%)",
                "soft-dark": "0 3px 10px 0 rgb(25 33 50 / 30%)",
            },
            zIndex: {
                1: "1",
                2: "2",
                3: "3",
                4: "4",
                5: "5",
            },
            keyframes: {
                "fade-out": {
                    "0%": {
                        opacity: 1,
                        visibility: "visible",
                    },
                    "100%": {
                        opacity: 0,
                        visibility: "hidden",
                    },
                },
            },
        },
    },
    corePlugins: {
        textOpacity: false,
        backgroundOpacity: false,
        borderOpacity: false,
        divideOpacity: false,
        placeholderOpacity: false,
        ringOpacity: false,
        aspectRatio: false,
    },
    plugins: [require('@tailwindcss/aspect-ratio'), forms, typography],
}
