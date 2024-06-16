<template>
    <DashboardLayout>
        <nav class="mb-5">
            <div class="flex flex-col sm:flex-row justify-end">
                <div class="sm:mt-0 mt-4 text-center sm:text-right">
                    <label for="dateFrom" class="mr-2">From:</label>
                    <input type="date" id="dateFrom" name="dateFrom" class="mr-4" v-model="dateFrom"
                           @change="reloadChart">

                    <label for="dateTo" class="mr-2">To:</label>
                    <input type="date" id="dateTo" name="dateTo" class="" v-model="dateTo" @change="reloadChart">
                </div>
            </div>
        </nav>

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
                        v-if="itemChartIsLoaded"
                        :options="itemChartOptions"
                        :data="itemChartData"
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
    name: "DashboardIndex",
    components: {DashboardLayout, Bar},
    data() {
        return {
            dateFrom: '',
            dateTo: '',
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
                        label: 'Number of Requests by user',
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
                        label: 'Number of Requests by Item',
                        backgroundColor: '#f87979',
                        data: [] // Number of requests will be set here
                    }
                ]
            }
        };
    },
    mounted() {
        this.reloadChart();
        this.reloadIntervalId = setInterval(this.reloadChart, 30000);
    },
    beforeDestroy() {
        if (this.reloadIntervalId) {
            clearInterval(this.reloadIntervalId);
        }
    },
    methods: {
        async reloadChart() {
            if (this.dateFrom === '' || this.dateTo === '') {
                return;
            }
            await this.fetchUserRequests();
            await this.fetchItemRequests();
        },
        async fetchUserRequests() {
            try {
                let chartUserRequestRoute = route('charts.userRequests');
                let queryParams = "?dateFrom=" + this.dateFrom + "&dateTo=" + this.dateTo;
                chartUserRequestRoute += queryParams;
                const response = await fetch(chartUserRequestRoute);
                const data = await response.json();
                // Replace the entire labels and datasets array
                this.userChartData = {
                    ...this.userChartData,
                    labels: data.map(user => user.name),
                    datasets: [
                        {
                            ...this.userChartData.datasets[0],
                            data: data.map(user => user.stock_requests_count)
                        }
                    ]
                };
                this.userChartIsLoaded = true;
            } catch (error) {
                console.error("Failed to fetch user requests data:", error);
            }
        },

        async fetchItemRequests() {
            try {
                let chartItemRequestRoute = route('charts.itemRequests');
                let queryParams = "?dateFrom=" + this.dateFrom + "&dateTo=" + this.dateTo;
                chartItemRequestRoute += queryParams;
                const response = await fetch(chartItemRequestRoute);
                const data = await response.json();
                // Replace the entire labels and datasets array
                this.itemChartData = {
                    ...this.itemChartData,
                    labels: data.map(item => item.name),
                    datasets: [
                        {
                            ...this.itemChartData.datasets[0],
                            data: data.map(item => item.stock_requests_count)
                        }
                    ]
                };
                this.itemChartIsLoaded = true;
            } catch (error) {
                console.error("Failed to fetch item requests data:", error);
            }
        }
    }
};
</script>
