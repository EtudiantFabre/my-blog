import axios from 'axios';

export default {
    getAll() {
        return axios.get('/api/tags');
    },
    get(id) {
        return axios.get(`/api/tags/${id}`);
    },
    create(data) {
        return axios.post('/api/tags', data);
    },
    update(id, data) {
        return axios.put(`/api/tags/${id}`, data);
    },
    delete(id) {
        return axios.delete(`/api/tags/${id}`);
    }
};