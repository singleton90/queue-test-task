import 'bootstrap';
import Vue from 'vue';
require('./bootstrap');

const app = new Vue({
    el: '#app',
    data: {
        measurements: [],
        url: '',
        statistics: [],
        hasError: false,
        errorMessage: '',
    },
    mounted: function () {
        this.refreshData();
        setInterval(this.refreshData, 5000);
    },
    methods: {
        addTask: function(e) {
            e.preventDefault();
            self = this;
            axios.post('/api/add-task', {url: this.url})
                .then(function (response) {
                    if (response.data.status === 'error') {
                        self.addError(response.data.message);
                    } else {
                        self.removeError();
                        self.url = '';
                    }
                    self.refreshData();
                })
                .catch((error) => console.log(error.response.data));
        },
        refreshData: function () {
            self = this;
            axios.get('/api')
                .then(function (response) {
                    self.measurements = response.data.measurements;
                    self.statistics = response.data.statistics;
                })
                .catch((error) => console.log(error));
        },
        addError: function (message) {
            this.hasError = true;
            this.errorMessage = message;
        },
        removeError: function (event) {
            this.hasError = false;
            this.errorMessage = '';
        }
    }
})
