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
    variants: {
        extend: {
            textColor: ["hover"],
            backgroundColor: ["hover"],
        },
    },
    plugins: [],
};
// ./tailwindcss -i ./static.css -o ./public/css/output.css --watch
// - Primary: #003a70
// - Tints:
// #e6ebf1
// #ccd8e2
// #33618d
// - Shades:
// #003465
// #001122
// 50: "230,235,241",
//                     100: "204,216,226",
//                     200: "51,97,141",
//                     500: "0, 58, 112",
//                     600: "0,52,101",
//                     800: "0, 17, 34",
