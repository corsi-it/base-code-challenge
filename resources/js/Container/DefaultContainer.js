import ApiClient from "../Client/ApiClient.js";

class DefaultContainer {

    instance = null;

    classes = {};

    constructor() {
        this.setClass("ApiClient", new ApiClient());
        this.setClass("AuthService", new AuthService());
    }

    static getInstance() {
        if (this.instance === null) {
            this.instance = new DefaultContainer();
        }
        return this.instance;
    }

    setClass(name, classObject) {
        this.classes[name] = classObject;
    }

    getClass(name) {
        return this.classes[name];
    }
}
