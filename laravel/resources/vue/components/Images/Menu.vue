<template>
    <div>
        <svg
            :height="size"
            :width="size"
            version="1.1"
            id="Layer_1"
            xmlns="http://www.w3.org/2000/svg"
            xmlns:xlink="http://www.w3.org/1999/xlink"
            viewBox="0 0 64 64"
            xml:space="preserve"
            fill="#000000"
        >
            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
            <g
                id="SVGRepo_tracerCarrier"
                stroke-linecap="round"
                stroke-linejoin="round"
            ></g>
            <g id="SVGRepo_iconCarrier">
                <circle class="st0" cx="32" cy="32" r="32"></circle>
                <path
                    class="st1"
                    d="M37,21v18H15V21H37 M37,18H15c-1.7,0-3,1.3-3,3v18c0,1.7,1.3,3,3,3h22c1.7,0,3-1.3,3-3V21 C40,19.3,38.7,18,37,18L37,18z"
                ></path>
                <g class="st2">
                    <path
                        class="st3"
                        d="M48.5,52H24c-0.8,0-1.5-0.7-1.5-1.5S23.2,49,24,49h23V30c0-0.8,0.7-1.5,1.5-1.5c0.8,0,1.5,0.7,1.5,1.5v20.5 C50,51.3,49.3,52,48.5,52z"
                    ></path>
                </g>
                <g class="st2">
                    <path
                        class="st3"
                        d="M43.5,47H19c-0.8,0-1.5-0.7-1.5-1.5S18.2,44,19,44h23V25c0-0.8,0.7-1.5,1.5-1.5c0.8,0,1.5,0.7,1.5,1.5v20.5 C45,46.3,44.3,47,43.5,47z"
                    ></path>
                </g>
                <path
                    class="st4"
                    d="M37,19v18H15V19H37 M37,16H15c-1.7,0-3,1.3-3,3v18c0,1.7,1.3,3,3,3h22c1.7,0,3-1.3,3-3V19 C40,17.3,38.7,16,37,16L37,16z"
                ></path>
                <g>
                    <path
                        class="st5"
                        d="M48.5,50H24c-0.8,0-1.5-0.7-1.5-1.5S23.2,47,24,47h23V28c0-0.8,0.7-1.5,1.5-1.5c0.8,0,1.5,0.7,1.5,1.5v20.5 C50,49.3,49.3,50,48.5,50z"
                    ></path>
                </g>
                <g>
                    <path
                        class="st5"
                        d="M43.5,45H19c-0.8,0-1.5-0.7-1.5-1.5S18.2,42,19,42h23V23c0-0.8,0.7-1.5,1.5-1.5c0.8,0,1.5,0.7,1.5,1.5v20.5 C45,44.3,44.3,45,43.5,45z"
                    ></path>
                </g>
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
.st0 {
    fill: #4f5d73;
}
.st1 {
    opacity: 0.2;
    fill: #231f20;
}
.st2 {
    opacity: 0.2;
}
.st3 {
    fill: #231f20;
}
.st4 {
    fill: #ffffff;
}
.st5 {
    fill: #e0e0d1;
}
</style>
