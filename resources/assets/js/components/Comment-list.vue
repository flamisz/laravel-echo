<template>
    <div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h3>Vue Comments</h3>
        </div>
    </div>

    <comment v-for="comment in comments">
        <span slot="header">{{ comment.creator.name }} said {{ comment.created_at }}</span>
        {{ comment.body }}
    </comment>
    </div>
</template>

<script>
    export default {
        props: ['article'],

        data: function () {
            return {
                comments: []
            }
        },

        mounted() {
            console.log('Comments mounted.');

            axios.get('/articles/' + this.article + '/comments')
                 .then(response => this.comments = response.data.comments);
        }
    }
</script>
