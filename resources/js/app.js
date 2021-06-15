import 'bootstrap';
import Vue from 'vue';
require('./bootstrap');

const app = new Vue({
    el: '#app',
    data: {
        measurements: [],
        url: '',
    },
    mounted: function () {
        self = this;
        axios.get('/api')
            .then((response) => self.measurements = response.data.measurements)
            .catch((error) => console.log(error));
    },
    methods: {
        addTask: function(event) {
            event.preventDefault();
            axios.post('/api/add-task', {url: this.url})
                .then((response) => this.data = response.data.response)
                .catch((error) => console.log(error.response.data));
        }
    }
})
