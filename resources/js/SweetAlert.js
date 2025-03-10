import swal from 'sweetalert2';

export default {
    install: (app) => {
        app.config.globalProperties.$swal = swal;
    },
};
