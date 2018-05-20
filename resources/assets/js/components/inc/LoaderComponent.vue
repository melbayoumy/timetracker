<template>
    <div v-if="showLoader"
        style="position: fixed;
        top: 0; left:0; bottom: 0; right: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        background: rgba(0,0,0,.5)
        ">
        <div class="text-center text-white">
        <i class="fas fa-spinner fa-pulse fa-5x"></i>
        <p><em>{{ text }}</em></p>
        </div>
    </div>
</template>

<script>
export default {
    name: 'loader-component',
    props: {
        'show-loader': {
            default: false
        }, 
        'text': {
            default: 'Processing...'
        }
    }
}
</script>

