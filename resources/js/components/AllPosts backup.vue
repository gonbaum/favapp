

<template>
    <div class="container">
        <div class="d-flex pt-2 pb-4" v-for='post in posts' :key='post.id'>
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
                            <span class="text-dark">{{ post.title }}</span>
                        </span></p>
                    </div>
                    <div class="pt-1">
                        <Like-button userId="" imgId="" likes="" isLiked=""></Like-button>
                    </div>
                </div>
            </div>        
        </div>
    </div>
</template>

<script>

    export default {
        props: [],

        mounted() {
            console.log('Component mounted.')
            this.getPosts()
        },

        data: function () {
            return {
                posts: [],
            }
        },

        methods: {
            /*getPosts() {
                let self = this
                axios.get('https://jsonplaceholder.typicode.com/photos',{
                        params: {
                        _limit: 50
                        }
                    })
                    .then(function(res){
                        console.log(res.data)
                        self.posts = res.data
                    })
            }*/
        }
    }
</script>
