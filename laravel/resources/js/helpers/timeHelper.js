// mixins/commonMethods.js
export const timeHelper = {
    methods: {
        timeFormat(seconds) {
            if (seconds === 0) {
                return "0:00";
            }
            const hours = Math.floor(seconds / 3600);
            const minutes = Math.floor((seconds % 3600) / 60);
            const remainingSeconds = Math.floor(seconds % 60);

            return `${hours > 0 ? `${hours}:` : ""}${minutes < 10 && hours > 0 ? "0" : ""
                }${minutes}:${remainingSeconds < 10 ? "0" : ""}${remainingSeconds}`;
        },
    }
};
