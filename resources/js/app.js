/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('modal', {
    template: '#modal-template'
});

var app = new Vue({
    el: '#vue-wrapper',

    data: {
        inquiries: [],
        hasError: false,
        hasDeleted: false,
        hasEmailError: false,
        showModal: false,
        e_id: '',
        e_name: '',
        e_company: '',
        e_email: '',
        e_phone: '',
        e_message: '',
        newInquiry: {'name': '', 'company': '', 'email': '', 'phone': '', 'message': ''},
    },
    mounted: function mounted() {
        this.getInquiries();
    },
    methods: {
        getInquiries: function getInquiries() {
            var _this = this;

            axios.get('/inquiries').then(function (response) {
                _this.inquiries = response.data;
            });
        },
        setVal(val_id, val_name, val_company, val_email, val_phone, val_message) {
            this.e_id = val_id;
            this.e_name = val_name;
            this.e_company = val_company;
            this.e_email = val_email;
            this.e_phone = val_phone;
            this.e_message = val_message;
        },

        createInquiry: function createInquiry() {
            console.log('clicked');
            var _this = this;
            var input = this.newInquiry;

            if (input['name'] == '' || input['email'] == '' || input['phone'] == '' || input['message'] == '') {
                this.hasError = false;
            } else {
                this.hasError = true;
                axios.post('/inquiries', input).then(function (response) {
                    _this.newInquiry = {'name': '', 'company': '', 'email': '', 'phone': '', 'message': ''};
                    _this.getInquiries();
                });
                this.hasDeleted = true;
            }
        },
        editInquiry: function () {
            var i_val_1 = document.getElementById('e_id');
            var n_val_1 = document.getElementById('e_name');
            var c_val_1 = document.getElementById('e_company');
            var e_val_1 = document.getElementById('e_email');
            var p_val_1 = document.getElementById('e_phone');
            var m_val_1 = document.getElementById('e_message');

            axios.post('/edit_inquiry/' + i_val_1.value, {
                name: n_val_1.value,
                company: c_val_1.value,
                email: e_val_1.value,
                phone: p_val_1.value,
                message: m_val_1.value
            })
                .then(response => {
                    this.getInquiries();
                    this.showModal = false
                });
            this.hasDeleted = true;
        },
        deleteInquiry: function deleteInquiry(item) {
            var _this = this;
            axios.post('/inquiries/' + item.id).then(function (response) {
                _this.getInquiries();
                _this.hasError = true,
                    _this.hasDeleted = false

            });
        }
    }
});
