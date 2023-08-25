<template>
    <div :class="{ 'message-card': this.isMsgCardActive, 'inactive': !this.isMsgCardActive }">
        <h2>{{ msgText }}</h2>
        <Button @click="changeBtnText()">
            <template v-slot:btn-value>
                {{ btnText }}
            </template>
        </Button>
    </div>
</template>

<script>
    import Button from './Button.vue';
    export default {
        props: ['msgText', 'btnText', 'isMsgCardActive'],
        components: {
            Button,
        },
    }
</script>

<style scoped>
    .message-card {
        background: #212b2a;
        height: 150px;
        padding: 25px;
        border-radius: 20px;
        display: flex;
        flex-direction: column;
        gap: 15px;
        justify-content: center;
        box-shadow: 0 0 10px 0 #fff;

        position: absolute;
    }

    .inactive {
        display: none;
    }

    .message-card > h2 {
        color: #fff;
    }
</style>