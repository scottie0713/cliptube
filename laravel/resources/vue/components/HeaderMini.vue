<template>
    <header class="header px-4 py-4 text-start">
        <img @click="goToPage('/')" src="../../images/title.png" width="160" />
    </header>
</template>

<script>
export default {
    methods: {
        goToPage(path) {
            this.$router.push(path);
        },
    },
};
</script>

<style scoped>
.header {
    width: 100%;
    height: 70px;
    background-color: #1d2023;
    color: aliceblue;
}
</style>
