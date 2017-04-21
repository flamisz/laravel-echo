<template>
    <div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h3>Vue Comments</h3>
        </div>
    </div>

    <comment v-for="comment in comments" :now="now">
        <span slot="header">
            {{ comment.creator.name }} said 
            <time :datetime="comment.created_at">
                {{ comment.formatted_created_at }}
            </time>
        </span>
        {{ comment.body }}
    </comment>
    </div>
</template>

<script>
    export default {
        props: ['article'],

        data: function () {
            return {
                comments: [],
                now: Date.now()
            }
        },

        mounted() {
            console.log('Comments mounted.');

            var self = this;
            setInterval(function () {
                console.log('updating ticker')
                self.$data.now = Date.now()
            }, 1000)

            axios.get('/articles/' + this.article + '/comments')
                 .then(response => this.comments = response.data);
        }
    }
</script>
