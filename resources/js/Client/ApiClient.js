class ApiClient {

    baseUrl = import.meta.env.VITE_API_BASE_URL;

    constructor() {
    }

    async createToken(email, password) {
        const response = await fetch(`${this.baseUrl}/tokens/create`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
            },
            body: JSON.stringify({
                'email': email,
                'password': password,
            }),
        });
        return response.json();
    }

    async getUsers(token) {
        const response = await fetch(`${this.baseUrl}/users`);
        return response.json();
    }

    async getProducts(token) {
        const response = await fetch(`${this.baseUrl}/products`);
        return response.json();
    }

    async getRequests(token) {
        const response = await fetch(`${this.baseUrl}/requests`);
        return response.json();
    }
}

export default ApiClient;
