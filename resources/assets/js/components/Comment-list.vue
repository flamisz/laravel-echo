<template>
    <div>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h3>Vue Comments
                    <span v-if="hasNewComment" @click="loadNewComments" class="label label-info" style="cursor:pointer">
                        {{ newCommentMessage }}
                    </span>
                </h3>
            </div>
        </div>

        <transition-group name="list">
            <comment v-for="comment in comments" :now="now" :comment="comment" :key="comment.id"></comment>
        </transition-group>
    </div>
</template>

<script>
    export default {
        props: ['article'],

        data: function () {
            return {
                comments: [],
                now: Date.now(),
                newComments: []
            }
        },

        computed: {
            hasNewComment: function () {
                return (!!this.newComments.length)
            },
            newCommentMessage: function () {
                return this.newComments.length + ' new' 
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
                    flash('New comment on page.');
                    this.newComments.unshift(e.comment);
                });
        },

        methods: {
            loadNewComments() {
                this.comments = this.newComments.concat(this.comments);
                this.newComments = [];
            }
        }
    }
</script>
<style>
    .list-move {
        transition: all 1s ease;
    }
    .list-enter-active {
        transition: all 1s ease;
    }
    .list-enter {
        opacity: 0;
        transform: translateY(-30px);
    }
</style>
