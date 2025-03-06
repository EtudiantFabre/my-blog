import axios from 'axios';

export default {
    getAll() {
        return axios.get('/api/comments');
    },
    get(id) {
        return axios.get(`/api/comments/${id}`);
    },
    create(data) {
        return axios.post('/api/comments', data);
    },
    update(id, data) {
        return axios.put(`/api/comments/${id}`, data);
    },
    delete(id) {
        return axios.delete(`/api/comments/${id}`);
    }
};