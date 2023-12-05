import axios from "axios";

const instance = axios.create({
    baseURL : 'http://127.0.0.1:8000/api/',
    headers : {
        'Content-Type' : 'aplication/json',
        'Authorization' : `Bearer ${localStorage.getItem('token')}`
        }
})

export default instance