<template>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <slot name="header"></slot>
                </div>

                <div class="panel-body">
                    <slot></slot>
                </div>
            </div>
            now: {{ now }}
        </div>
    </div>
</template>

<script>
    export default {
        props: ['now'],

        mounted() {
            console.log('Comment mounted.')
        }
    }
</script>
