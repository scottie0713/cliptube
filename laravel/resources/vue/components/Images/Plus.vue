<template>
    <div>
        <svg
            :width="size"
            :height="size"
            viewBox="0 0 1024 1024"
            class="icon"
            version="1.1"
            xmlns="http://www.w3.org/2000/svg"
            fill="#000000"
        >
            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
            <g
                id="SVGRepo_tracerCarrier"
                stroke-linecap="round"
                stroke-linejoin="round"
            ></g>
            <g id="SVGRepo_iconCarrier">
                <path
                    d="M512 512m-448 0a448 448 0 1 0 896 0 448 448 0 1 0-896 0Z"
                    fill="#4CAF50"
                ></path>
                <path
                    d="M448 298.666667h128v426.666666h-128z"
                    fill="#FFFFFF"
                ></path>
                <path
                    d="M298.666667 448h426.666666v128H298.666667z"
                    fill="#FFFFFF"
                ></path>
            </g>
        </svg>
    </div>
</template>

<script>
export default {
    props: {
        size: {
            type: String,
            default: "40px",
        },
    },
};
</script>

<style scoped>
</style>
