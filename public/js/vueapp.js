var app = new Vue({
    el: '#line-status',
    data: {
        tflData: []
    },

    ready: function(){
        //can run this to get the initial updated x seconds ago to work on initial page load
    },

    methods: {
        getData: function () {

            Vue.axios.get('/api/update')
                .then((response) => {
                    this.tflData = response.data;
                })

        }
    }
})