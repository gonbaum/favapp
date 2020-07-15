
<template>
    <div class="container">
         <div class="d-flex pt-2 pb-4" v-for='post in laravelData.data' :key='post.id'>
            <div class="row">
                <div class="col-6 offset-3">
                    <a href="">
                        <img :src="post.url" alt="" class="w-100">
                    </a>
                </div>
            </div>
            <div class="row pt-2 pb-4">
                <div class="col-6 d-flex">
                    <div>
                        <p>
                        <span class="font-weight-bold">
                            <span class="text-dark ">{{ post.title }}</span>
                        </span></p>
                    </div>
                    <div class="pt-1">
                        <Like-button :data='post' userId="" imgId="" likes="" isLiked=""></Like-button>
                    </div>
                </div>
            </div>        
        </div>
        <pagination :data="laravelData" @pagination-change-page="getResults" :limit=8  ></pagination>
    </div>
</template>

<script>
    export default {

        mounted() {
            console.log('Component mounted.')
            // Fetch initial results
		    this.getResults();
        },

        data: function () {
            return {
                // Our data object that holds the Laravel paginator data
                laravelData: {},
            }
        },

        methods: {
            // Our method to GET results from a Laravel endpoint
                getResults(page = 1) {
                    axios.get('/api/photos?page=' + page)
                        .then(response => {
                            this.laravelData = response.data;
                        });
                }

        }
    }
</script>
