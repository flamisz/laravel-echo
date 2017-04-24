<template>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Create a Comment</div>

                <div class="panel-body">
                    <form @submit.prevent="onSubmit">
                        <div class="form-group" :class="{ 'has-error': bodyError, 'has-success': success }">
                            <label for="body">Comment:</label>
                            <input type="text" class="form-control" id="body" name="body" v-model="body" @keydown="clearBodyError">
                            <span class="help-block" v-if="success">Comment added!</span>
                            <span class="help-block" v-if="bodyError" v-text="bodyError"></span>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary" :disabled="submitDisabled">Publish</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['articleId'],

        data: function () {
            return {
                body: '',
                bodyError: '',
                success: false,
                disableButton: false
            }
        },

        computed: {
            submitDisabled: function () {
                return (!!this.bodyError || this.disableButton)
            }
        },

        methods: {
            onSubmit() {
                this.disableButton = true;
                axios.post('/comments', {
                    body: this.body,
                    article_id: this.articleId
                })
                .then(response => {
                    Event.$emit('comment-was-submitted', response.data);
                    this.success = true;
                    this.body = '';
                    this.disableButton = false
                })
                .catch(error => {
                    this.bodyError = error.response.data.body[0];
                    this.success = false;
                    this.disableButton = false
                });
            },

            clearBodyError() {
                this.bodyError = '';
                this.success = false
            }
        }
    }
</script>
