<template>
    <div>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h3>Vue Comments</h3>
            </div>
        </div>

        <comment v-for="comment in comments" :now="now" :comment="comment"></comment>
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
            axios.get('/articles/' + this.article + '/comments')
                 .then(response => this.comments = response.data);

            window.setInterval(() => {
                this.now = (new Date()).getTime();
            },1000*60);

            Event.$on('comment-was-submitted', comment => {
                this.comments.unshift(comment);
            });

            Echo.channel('comment.' + this.article)
                .listen('CommentCreated', (e) => {
                    console.log(e.comment.body);
                });
        }
    }
</script>
