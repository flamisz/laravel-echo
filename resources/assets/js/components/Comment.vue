<template>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">

                    <div class="panel-heading">
                        {{ comment.creator.name }} said 
                        <time :datetime="comment.created_at">
                            {{ diffForHumans }}
                        </time>
                    </div>

                    <div class="panel-body">
                        {{ comment.body }}
                    </div>

                </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['now', 'comment'],

        computed: {
            diffForHumans: function () {
                return moment(this.comment.created_at).from(this.now)
            }
        }
    }
</script>
