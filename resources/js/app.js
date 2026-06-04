import './bootstrap';

// Ya no necesitas importar, axios está global
window.axios.get('/sanctum/csrf-cookie').then(response => {
    window.axios.post("/api/user/login", {
        email: 'arturo@gmail.com',
        password: '12345678',
    }).then((res) => {
        console.log(res.data);        
    }).catch((error) => {
        console.log(error.response?.data || error);            
    });
});
