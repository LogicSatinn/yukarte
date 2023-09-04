/** @type {import('tailwindcss').Config} */
import preset from './vendor/filament/support/tailwind.config.preset'

export default {
    presets: [preset],
    content: [
        './vendor/filament/**/*.blade.php',
        './resources/**/*.blade.php',
    ],
}

