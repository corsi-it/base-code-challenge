<template>
    <DashboardLayout>
        <div class="flex gap-5">
            <!-- Left Column for the first chart -->
            <div class="w-1/2 p-6 bg-white">
                <h3 class="text-lg font-bold mb-4">User Stock Requests</h3>
                <div class="h-72"> <!-- Tailwind class for fixed height -->
                    <Bar
                        id="users-chart"
                        v-if="userChartIsLoaded"
                        :options="userChartOptions"
                        :data="userChartData"
                    />
                </div>
            </div>
            <div class="w-1/2 p-6 bg-white">
                <h3 class="text-lg font-bold mb-4">Item Stock Requests</h3>
                <div class="h-72"> <!-- Tailwind class for fixed height -->
                    <Bar
                        id="users-chart"
                        v-if="userChartIsLoaded"
                        :options="userChartOptions"
                        :data="userChartData"
                    />
                </div>
            </div>
        </div>
    </DashboardLayout>
</template>

<script>
import DashboardLayout from "../../Layouts/DashboardLayout.vue";
import {Bar} from 'vue-chartjs';
import {Chart as ChartJS, Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale} from 'chart.js'

ChartJS.register(Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale)


export default {
    name: "Dashboard",
    components: {DashboardLayout, Bar},
    data() {
        return {
            userChartIsLoaded: false,
            userChartOptions: {
                responsive: true,
                maintainAspectRatio: false,
                indexAxis: 'y', // This will make the chart horizontal
            },
            userChartData: {
                labels: [],
                datasets: [
                    {
                        label: 'Number of Requests',
                        backgroundColor: '#f87979',
                        data: [] // Number of requests will be set here
                    }
                ]
            },
            itemChartIsLoaded: false,
            itemChartOptions: {
                responsive: true,
                maintainAspectRatio: false,
                indexAxis: 'y', // This will make the chart horizontal
            },
            itemChartData: {
                labels: [],
                datasets: [
                    {
                        label: 'Number of Requests',
                        backgroundColor: '#f87979',
                        data: [] // Number of requests will be set here
                    }
                ]
            }
        };
    },
    mounted() {
        this.fetchUserRequests();
        this.fetchItemRequests();
    },
    methods: {
        async fetchUserRequests() {
            try {
                let chartUserRequestRoute = route('charts.userRequests');
                const response = await fetch(chartUserRequestRoute);
                const data = await response.json();
                this.userChartData.labels = data.map(user => user.name);
                this.userChartData.datasets[0].data = data.map(user => user.stock_requests_count);
                this.userChartIsLoaded = true;
            } catch (error) {
                console.error("Failed to fetch user requests data:", error);
            }
        },
        async fetchItemRequests() {
            try {
                let chartItemRequestRoute = route('charts.itemRequests');
                const response = await fetch(chartItemRequestRoute);
                const data = await response.json();
                this.itemChartData.labels = data.map(item => item.name);
                this.itemChartData.datasets[0].data = data.map(item => item.stock_requests_count);
                this.itemChartIsLoaded = true;
            } catch (error) {
                console.error("Failed to fetch item requests data:", error);
            }
        }
    }
};
</script>
