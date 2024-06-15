class AuthService {

    apiClient = null;

    user = null;

    constructor(apiClient) {
        this.apiClient = apiClient;
    }

    async login(username, password) {
        const response = await this.apiClient.createToken(username, password);
        if (response.token) {
            localStorage.setItem('token', response.token);
            return true;
        }
        return false;
    }
}

export default AuthService;
