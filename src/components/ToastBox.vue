<template>
    <div class="alert alert-success toast-box">
        {{ message }}
    </div>
</template>

<script>
    export default {
        props: {
            message: {
                type: String,
                required: true
            }
        }
    }
</script>

<style>
    .toast-box {
        position: fixed;
        top: 10px;
        right: 10px;
        z-index: 9;
    }
</style>