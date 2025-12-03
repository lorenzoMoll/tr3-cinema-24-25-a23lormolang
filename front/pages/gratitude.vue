<template>
    <div class="min-h-screen bg-light-main dark:bg-dark-main py-12">
        <div class="max-w-3xl mx-auto px-4">
            <div class="bg-light-secondary dark:bg-dark-secondary rounded-xl shadow-lg p-6 md:p-8">
                <!-- Header -->
                <div class="text-center mb-8">
                    <h1 class="text-3xl font-bold text-dark-main dark:text-light-main mb-4">
                        Gràcies per la teva compra!
                    </h1>
                    <p class="text-dark-main dark:text-light-main">
                        Hem enviat els detalls de la teva reserva al correu electrònic proporcionat.
                    </p>
                </div>

                <!-- Ticket Information -->
                <div class="border-t border-light-tertiary dark:border-dark-tertiary pt-6 mb-8">
                    <h2 class="text-xl font-semibold text-dark-main dark:text-light-main mb-4">
                        Detalls de la teva reserva
                    </h2>

                    <div class="bg-light-quaternary dark:bg-dark-tertiary rounded-lg p-4 mb-6">
                        <div class="space-y-3 text-dark-main dark:text-light-main">
                            <!-- Reservation Code -->
                            <div class="flex justify-between items-center">
                                <span>Codi de reserva:</span>
                                <span class="font-medium">{{ reservation.id }}</span>
                            </div>

                            <!-- User Information -->
                            <div class="flex justify-between items-center">
                                <span>Nom:</span>
                                <span class="font-medium">{{ reservation.user?.name }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span>Email:</span>
                                <span class="font-medium">{{ reservation.user?.email }}</span>
                            </div>

                            <!-- Movie Information -->
                            <div class="flex justify-between items-center">
                                <span>Pel·lícula:</span>
                                <span class="font-medium">{{ reservation.screening?.movie?.title }}</span>
                            </div>

                            <!-- Session Information -->
                            <div class="flex justify-between items-center">
                                <span>Sessió:</span>
                                <span class="font-medium">
                                    {{ formatDate(reservation.screening?.date) }} a les {{ reservation.screening?.time
                                    }}
                                </span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span>Duració:</span>
                                <span class="font-medium">{{ reservation.screening?.movie?.duration }} minuts</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span>Sala:</span>
                                <span class="font-medium">{{ reservation.screening?.room?.name }}</span>
                            </div>

                            <!-- Ticket Information -->
                            <div class="pt-4 border-t border-light-tertiary dark:border-dark-tertiary">
                                <h3 class="font-semibold mb-3">Les teves entrades:</h3>
                                <div v-for="ticket in reservation.tickets" :key="ticket.id"
                                    class="bg-light-main dark:bg-dark-main p-3 rounded mb-2 md:mx-[80px]">
                                    <div class="flex justify-between items-center">
                                        <span>Butaca:</span>
                                        <span class="font-medium">Fila {{ ticket.seat.row }} · Seient {{
                                            ticket.seat.number }}</span>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <span>Tipus:</span>
                                        <span class="font-medium capitalize">{{ ticket.seat.type }}</span>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <span>Preu:</span>
                                        <span class="font-medium text-primary-500">{{ ticket.price }}€</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Total Price -->
                            <div
                                class="flex justify-between items-center text-lg pt-4 border-t border-light-tertiary dark:border-dark-tertiary">
                                <span class="font-bold">Total pagat:</span>
                                <span class="font-bold text-primary-500">{{ calculateTotal }}€</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <button @click="navigateTo('/')" class="font-bold bg-gradient-to-r from-primary-400 to-tertiary-600 
                    hover:from-primary-600 hover:to-tertiary-800 dark:from-purple-600 dark:to-indigo-600 
                    dark:hover:from-purple-700 dark:hover:to-indigo-700 text-dark-main dark:text-light-main 
                    cursor-pointer px-6 py-3 rounded-lg transition-opacity hover:opacity-90">
                        Tornar a l'inici
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted, computed } from 'vue'
import { useRouter, useRoute } from 'vue-router'

const route = useRoute()
const router = useRouter()

const reservation = ref({
    id: '',
    user: {
        name: '',
        email: ''
    },
    screening: {
        movie: {
            title: '',
            duration: 0
        },
        date: '',
        time: '',
        room: { name: '' }
    },
    tickets: []
})

// Fetch reservation details
const fetchReservation = async () => {
    try {
        const rawReservation = decodeURIComponent(route.query.reservation);
        reservation.value = JSON.parse(rawReservation);
    } catch (error) {
        console.error('Error fetching reservation:', error)
    }
}

const calculateTotal = computed(() => {
    if (!reservation.value.tickets || reservation.value.tickets.length === 0) return 0;

    return reservation.value.tickets.reduce((total, ticket) => {
        return total + parseFloat(ticket.price);
    }, 0).toFixed(2);
})

const formatDate = (dateString) => {
    if (!dateString) return '';
    return new Date(dateString).toLocaleDateString('ca-ES', {
        weekday: 'short', day: 'numeric', month: 'long'
    });
}

onMounted(fetchReservation);
</script>