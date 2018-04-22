import axios from 'axios';

const xhr = axios.create({
    baseURL: 'http://localhost:8000'
});

export default xhr;