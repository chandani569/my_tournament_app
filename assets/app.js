import './styles/app.css';
import { createApp } from 'vue';
import TournamentForm from './components/TournamentForm.vue';

const app = createApp({
    components: { TournamentForm },
});

app.mount('#app');