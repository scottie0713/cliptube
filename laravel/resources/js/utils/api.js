import axios from "axios";

async function apiGet(url, onSuccess, onFailure) {
    try {
        const response = await axios.get(url);
        if (response.status >= 200 && response.status < 300) {
            onSuccess(response.data);
        } else {
            onFailure(`Unexpected response status: ${response.status}`);
        }
    } catch (error) {
        console.error("API GET request error:", error);
        onFailure(error);
    }
}

async function apiPost(url, data, onSuccess, onFailure) {
    try {
        const response = await axios.post(url, data);
        if (response.status >= 200 && response.status < 300) {
            onSuccess(response.data);
        } else {
            onFailure(`Unexpected response status: ${response.status}`);
        }
    } catch (error) {
        console.error("API POST request error:", error);
        onFailure(error);
    }
}

async function apiPut(url, data, onSuccess, onFailure) {
    try {
        const response = await axios.put(url, data);
        if (response.status >= 200 && response.status < 300) {
            onSuccess(response.data);
        } else {
            onFailure(`Unexpected response status: ${response.status}`);
        }
    } catch (error) {
        console.error("API POST request error:", error);
        onFailure(error);
    }
}

async function apiDelete(url, data, onSuccess, onFailure) {
    try {
        const response = await axios.delete(url, data);
        if (response.status >= 200 && response.status < 300) {
            onSuccess(response.data);
        } else {
            onFailure(`Unexpected response status: ${response.status}`);
        }
    } catch (error) {
        console.error("API POST request error:", error);
        onFailure(error);
    }
}
export { apiGet, apiPost, apiPut, apiDelete };
