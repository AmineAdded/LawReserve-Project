import axios from "axios";

const apiClient = axios.create({
    baseURL: "http://localhost/vueApi/",
    withCredentials: false,
    headers: {
        Accept: 'application/json',
        'Content-Type': 'application/json',
    }
})

export default {
    
    getEvents() {
        return apiClient.get('/events.php');
    },
    
    getServices(userName) {
        return apiClient.get('/services.php', {
            params: {
                userName: userName
            }
        });
    },
    
    deleteService(id){
        return apiClient.delete('/deleteService.php?id='+id);
    },
    displayService(id){
        return apiClient.get('/displayService.php?id='+id);
    },
    addService(service){
        return apiClient.post('/addService.php',service);
    },
    getAppointments(userName) {
        return apiClient.get('/appointments.php', {
            params: {
                userName: userName
            }
        });
    },
    getAllServices() {
        return apiClient.get('/DisplayServices.php');  // Assurez-vous que l'URL correspond à votre fichier PHP
    },
    getAppointmentsClient(userName) {
        return apiClient.get('/appointmentsClient.php', {
            params: {
                userName: userName,
            },
        });
    },
    payAppointement(appointment){
        return apiClient.post('/payAppointment.php',appointment);
    }
}