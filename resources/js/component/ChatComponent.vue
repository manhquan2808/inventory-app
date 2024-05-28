<template>
    <div>
        <h1>Chatroom</h1>
        <div v-for="message in messages" :key="message.id">
            <strong>{{ message.user }}:</strong> {{ message.message }}
        </div>
        <input type="text" v-model="message" @keyup.enter="sendMessage">
    </div>
</template>

<script>
export default {
    data() {
        return {
            messages: [],
            message: ''
        };
    },
    mounted() {
        this.fetchMessages();
        Echo.channel('chat')
            .listen('MessageSent', (e) => {
                this.messages.push({
                    user: e.message.user,
                    message: e.message.message
                });
            });
    },
    methods: {
        fetchMessages() {
            axios.get('/messages').then(response => {
                this.messages = response.data;
            });
        },
        sendMessage() {
            axios.post('/messages', {
                user: 'User',
                message: this.message
            }).then(response => {
                this.message = '';
            });
        }
    }
}
</script>
