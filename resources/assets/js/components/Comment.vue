<template>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">NAME said DATE</div>

                    <div class="panel-body">
                        <slot></slot>
                    </div>
                </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Comment mounted.')
        }
    }
</script>
