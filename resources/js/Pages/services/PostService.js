import axios from 'axios';

export default {
    getAll() {
        return axios.get('/api/posts');
    },
    get(id) {
        return axios.get(`/api/posts/${id}`);
    },
    create(data) {
        return axios.post('/api/posts', data);
    },
    update(id, data) {
        return axios.put(`/api/posts/${id}`, data);
    },
    delete(id) {
        return axios.delete(`/api/posts/${id}`);
    }
};