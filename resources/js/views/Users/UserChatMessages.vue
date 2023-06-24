<template>
    <main>
        <h6>User chat message list {{user}}</h6>
    </main>
</template>
<script>
    export default {
        name: "Chats",
        props: { 
            props: ['user'],       
        },
        data() {
            return {}
        },
        methods: {},
        created() {}
    }
</script>