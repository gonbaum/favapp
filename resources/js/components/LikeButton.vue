<template>
    <div class="">
        <button class="btn btn-danger ml-4" @click="likeImg" v-text="buttonText"></button>
    </div>
</template>

<script>
    export default {
        props: ['data', 'csrf_token'],

        mounted() {
            console.log('Component mounted.')
        },

        data: function () {
            return {
                isLiked: true
            }
        },

        methods: {
            likeImg() {
                axios.post('/like', {
                    'image_id' : this.data.id,
                    'image_url' : this.data.url,
                    'caption' : this.data.title,
                }, 
                {headers: {'Authorization': $('meta[name=csrf-token]').attr('content')}} )
                    .then(response => {
                        this.isLiked = !this.isLiked
                    })
                    .catch(errors => {
                        if (errors) {
                            //this.isLiked = !this.isLiked
                            alert('An error has ocurred')
                        }
                    })
            }
        },

        computed: {
            buttonText() {
                return (this.isLiked) ? 'Like' : 'Unlike'
            }
        }
    }
</script>
