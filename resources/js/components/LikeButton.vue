<template>
    <div class="">
        <button class="btn btn-danger ml-4" @click="likeImg" v-text="buttonText"></button>
    </div>
</template>

<script>
    export default {
        props: ['userId', 'imgId', 'likes', 'isLiked'],

        mounted() {
            console.log('Component mounted.')
        },

        data: function () {
            return {
                status: this.isLiked,
            }
        },

        methods: {
            likeImg() {
                /*axios.post('/profile/' + this.userId + '/like/' + this.imgId)
                    .then(response => {
                        this.status = !this.isLiked
                    })
                    .catch(errors => {
                        if (errors.response.status == 401) {
                            window.location = '/login'
                        }
                    })*/
            }
        },

        computed: {
            buttonText() {
                return (this.status) ? 'Unlike' : 'Like'
            }
        }
    }
</script>
