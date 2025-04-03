<script setup>
import Layout from './Layout/Main.vue'
import { Head  } from '@inertiajs/vue3'
defineOptions({ layout: Layout })
defineProps({ products: Object })

const headers = [
    { title: 'Name', align: 'start', key: 'name', width:'45%' },
    { title: 'Category', align: 'start', key: 'category' },
    { title: 'Date', align: 'start', key: 'date', width:'20%' },
]
const seriesExpenses = [{
    name: "Expenses",
    data: [10, 41, 35, 51, 49, 62, 69, 91, 148]
}]
const chartOptions = {
    chart: {
    height: 350,
    type: 'line',
    zoom: {
        enabled: false
    }
    },
    dataLabels: {
        enabled: false
    },
    stroke: {
        curve: 'straight'
    },
    grid: {
    row: {
        colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
        opacity: 0.5
    },
    },
    xaxis: {
        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep'],
    }
}
const seriesProfits = [{
    name: "Profits",
    data: [10, 41, 35, 51, 49, 65, 40, 60, 50]
}]
const seriesSales = [{
    name: "Sales",
    data: [10, 50, 45, 75, 80, 100, 60, 20, 100]
}]
const barSeries = [
    {
        name: 'Q1 Budget',
        group: 'budget',
        data: [44000, 55000, 41000, 67000, 22000, 43000]
    },
    {
        name: 'Q1 Actual',
        group: 'actual',
        data: [48000, 50000, 40000, 65000, 25000, 40000]
    },
    {
        name: 'Q2 Budget',
        group: 'budget',
        data: [13000, 36000, 20000, 8000, 13000, 27000]
    },
    {
        name: 'Q2 Actual',
        group: 'actual',
        data: [20000, 40000, 25000, 10000, 12000, 28000]
    }
]

const barChartOptions = {
    chart: {
    type: 'bar',
    height: 350,
    stacked: true,
    },
    stroke: {
    width: 1,
    colors: ['#fff']
    },
    dataLabels: {
    formatter: (val) => {
        return val / 1000 + 'K'
    }
    },
    plotOptions: {
    bar: {
        horizontal: false
    }
    },
    xaxis: {
    categories: [
        'Online advertising',
        'Sales Training',
        'Print advertising',
        'Catalogs',
        'Meetings',
        'Public relations'
    ]
    },
    fill: {
    opacity: 1
    },
    colors: ['#80c7fd', '#008FFB', '#80f1cb', '#00E396'],
    yaxis: {
    labels: {
        formatter: (val) => {
        return val / 1000 + 'K'
        }
    }
    },
    legend: {
    position: 'top',
    horizontalAlign: 'left'
    }
}
</script>
<template>
    <Head title="Dashboard" />
    <v-container fluid>
        <v-card>  
            <v-container fluid>
                <v-card-title>Dashboard</v-card-title>
                <div class="d-flex justify-center">
                    
                    <v-card class="ma-2 pa-2" title="Expenses">
                        <apexchart width="500" :options="chartOptions" :series="seriesExpenses"></apexchart> 
                    </v-card>

                    <v-card class="ma-2 pa-2" title="Profits">
                        <apexchart width="500" :options="chartOptions" :series="seriesProfits"></apexchart> 
                    </v-card>

                    <v-card class="ma-2 pa-2" title="Sales">
                        <apexchart width="500" :options="chartOptions" :series="seriesSales"></apexchart> 
                    </v-card>
        
                </div>
                <div class="d-flex justify-center">
                        <v-card class="mx-2 my-2">
                            <v-container>
                                <v-card-title>Budget</v-card-title>
                                <apexchart width="790" type="bar" :options="barChartOptions" :series="barSeries"></apexchart> 
                            </v-container>
                        </v-card>
                
                        <v-card class="mx-4 my-2"  width="800">
                            <v-data-table
                                :headers="headers"
                                :items="products"
                                items-per-page="10"
                                item-value="name"
                                fixed-header
                            ></v-data-table>
                        </v-card>
                  
                </div>
            </v-container>
        </v-card>
    </v-container>
</template>