/** @type {import('tailwindcss').Config} */
module.exports = {
    content: ["./resources/**/*.blade.php"],
    //darkmode: 'class - pra pegar por classe' 'media - pra pegar pelo computador'
    theme: {
        extend: {
            colors: {
                unifei: {
                    50: "#e6ebf1",
                    100: "#ccd8e2",
                    200: "#33618d",
                    500: "#003a70",
                    600: "#003465",
                    800: "#001122",
                },
            },
        },
    },
    plugins: [],
};
// ./tailwindcss -i ./tailwind.css -o ./src/css/styles.css --watch
// - Primary: #003a70
// - Tints:
// #e6ebf1
// #ccd8e2
// #33618d
// - Shades:
// #003465
// #001122
