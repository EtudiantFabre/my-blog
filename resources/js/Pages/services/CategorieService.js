import axios from 'axios';

export default {
    getAll() {
        return axios.get('/api/categories');
    },
    get(id) {
        return axios.get(`/api/categories/${id}`);
    },
    create(data) {
        return axios.post('/api/categories', data);
    },
    update(id, data) {
        return axios.put(`/api/categories/${id}`, data);
    },
    delete(id) {
        return axios.delete(`/api/categories/${id}`);
    }
};